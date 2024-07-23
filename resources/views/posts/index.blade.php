<x-app-layout>
    <x-slot name="header">
      <div class=" flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>

        <a class="bg-gray-800 text-white rounded px-4 py-2" href=" {{ route('posts.create') }}">Criar Noticia</a>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                   <table class="mb-4">
                        @foreach($posts as $post)
                         <tr class="border-b border-gray-200 text-sm">
                           <td class="px-6 py-4"><img style="width:75px" src="{{ $post->image }}" class="img-thumbnail"></td>
                           <td class="px-6 py-4">{{ $post->title }}</td>
                           <td class="px-6 py-4">
                                <a href="{{route('posts.edit', $post) }}" class="text-indigo-600">Editar</a>
                           </td> 
                           <td class="px-6 py-4">
                                <form action="{{route('posts.destroy', $post) }}" method="POST">
                                    @csrf 
                                    @method('DELETE')
                                    <input 
                                        type="submit" 
                                        value="Eliminar"
                                        class="bg-gray-800 text-white rounded px-4 py-2"
                                        onclick="return confirm('Estás seguro de eliminar el post? Esta acción es irreversible')" 
                                        >
                                </form>
                           </td> 
                        </tr>
                        @endforeach
                   </table>

                   {{ $posts->links() }}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
