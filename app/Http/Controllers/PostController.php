<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use App\Jobs\ProcessVideoChunk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->paginate()
        ]);
    }


    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'body' => 'required',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Atualizar imagem principal
            if ($request->hasFile('image')) {
                // Deletar imagem principal anterior
                if ($post->main_image) {
                    $mainImagePath = public_path('storage/' . $post->main_image);
                    if (File::exists($mainImagePath)) {
                        File::delete($mainImagePath);
                    }
                }
    
                // Salvar nova imagem principal
                $mainImagePath = $request->file('image')->store('images', 'public');
                $post->main_image = $mainImagePath;
            }
    
            // Atualizar outras propriedades do post
            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'body' => $request->body,
                'main_image' => $post->main_image, // Atualizar com a nova imagem principal
            ]);
    
            // Atualizar imagens associadas
            if ($request->hasFile('images')) {
                // Deletar imagens anteriores
                foreach ($post->images as $image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
    
                // Salvar novas imagens
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $post->images()->create(['path' => $path]);
                }
            }
    
            // Atualizar vídeo associado, se necessário
            if ($request->hasFile('video')) {
                $this->uploadLargeFiles($request, $post->id);
            }
    
            DB::commit();
    
            return redirect()->route('posts.index')->with('success', 'Post atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Erro ao atualizar post: ' . $e->getMessage());
    
            return redirect()->route('posts.index')->with('error', 'Ocorreu um erro ao atualizar o post. Tente novamente.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'slug' => 'required|unique:posts,slug',
            'body' => 'required',
        ]);
    
        DB::beginTransaction();
    
        try {
            // Upload da imagem principal
            $mainImagePath = $request->file('image')->store('images', 'public');
    
            $post = $request->user()->posts()->create([
                'title' => $request->title,
                'slug' => $request->slug,
                'body' => $request->body,
                'main_image' => $mainImagePath,
            ]);
    
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('images', 'public');
                    $post->images()->create(['path' => $path]);
                }
            }
    
            DB::commit();
    
            $this->uploadLargeFiles($request, $post->id);
    
            event(new PostCreated($post));
    
            return redirect()->route('posts.index');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Erro ao criar post: ' . $e->getMessage());
    
            return redirect()->route('posts.index')->with('error', 'Ocorreu um erro ao criar o post. Tente novamente.');
        }
    }

    
    public function create(Post $post)
    {
        return view('posts.create', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        DB::beginTransaction();
    
        try {
            // Deletar imagem principal
            if ($post->main_image) {
                $mainImagePath = public_path('storage/' . $post->main_image);
                if (File::exists($mainImagePath)) {
                    File::delete($mainImagePath);
                }
            }
    
            // Deletar imagens associadas
            foreach ($post->images as $image) {
                $imagePath = public_path('storage/' . $image->path);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                $image->delete();
            }
    
            // Deletar vídeo associado
            if ($post->video_locale) {
                $videoPath = public_path('storage/videos/' . $post->video_locale);
                if (File::exists($videoPath)) {
                    File::delete($videoPath);
                }
            }
    
            // Deletar post
            $post->delete();
    
            DB::commit();
    
            return back()->with('success', 'Post deletado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Erro ao deletar post: ' . $e->getMessage());
    
            return back()->with('error', 'Ocorreu um erro ao deletar o post. Tente novamente.');
        }
    }

    public function uploadLargeFiles(Request $request, $postId)
    {
        set_time_limit(0);

        $receiver = new FileReceiver('video', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            return response()->json(['message' => 'File not uploaded'], 400);
        }

        $fileReceived = $receiver->receive();

        if ($fileReceived->isFinished()) {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName());
            $fileName .= '_' . md5(time());

            $disk = Storage::disk('public');

            $path = $disk->putFileAs('videos', $file, $fileName);

            unlink($file->getPathname());

            $post = Post::find($postId);

            $post->update([
                'status' => 'processing', 
                'temporary_video' => $fileName,
            ]);

            ProcessVideoChunk::dispatch($path, $fileName, $postId)->onQueue('processing');

            $post->update([
                'status' => 'completed', 
                'temporary_video' => '',
            ]);

            if ($post) {
                $post->update([
                    'video_locale' => $fileName . '.m3u8',
                ]);
            }
        }

        // $handler = $fileReceived->handler();
        // return [
        //     'done' => $handler->getPercentageDone(),
        //     'status' => true
        // ];
    }
}
