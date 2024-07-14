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
use FFMpeg\Format\Video\X264;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;


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
            'title' => 'required',
            'slug' => 'required |unique:posts,slug,' . $post->id,
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $imagePath = '/images/' . $name;
        } else {
            $imagePath = $post->image;
        }

        $post->update([
           'image' => $imagePath, 
           'title' => $request->title,
           'slug' => $request->slug,
           'body' => $request->body
        ]);

        return redirect()->route('posts.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required',
            'slug' => 'required |unique:posts,slug',
            'body' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $imagePath = '/images/' . $name;
        } else {
            $imagePath = null;
        }

        DB::beginTransaction();

        try {
        $post = $request->user()->posts()->create([
           'image' => $imagePath, 
           'title' => $request->title,
           'slug' => $request->slug,
           'body' => $request->body
        ]);

        $this->uploadLargeFiles($request, $post->id);

        event(new PostCreated($post));

        DB::commit();

        return redirect()->route('posts.index');
        } catch (\Exception $e) {
            DB::rollBack();
        
            dd($e);
            // Excluir a imagem salva em caso de falha
            if ($imagePath) {
                @unlink(public_path($imagePath));
            }
    
            // Registrar o erro para depuração
            Log::error('Erro ao criar post: ' . $e->getMessage());
    
            // return redirect()->route('posts.index')->with('error', 'Ocorreu um erro ao criar o post. Tente novamente.');
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
        $post->delete();
        return back();
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
