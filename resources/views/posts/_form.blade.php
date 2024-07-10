@csrf 

<p>
    <label class="uppercase text-gray-700 text-xs">Imagem da Noticia</label>
    <span class="text-xs text-red-600">@error('image') {{ $message }} @enderror</span>
</p>

<p>
    <input type="file" name="image" class="rounded border-gray-200 w-full mb-4">
</p>

<p>
    <label class="uppercase text-gray-700 text-xs">Título</label>
    <span class="text-xs text-red-600">@error('title') {{ $message }} @enderror</span>
</p>

<p>
    <input type="text" name="title" class="rounded border-gray-200 w-full mb-4" value="{{ old('title', $post->title) }}">
</p>

<p>
    <label class="uppercase text-gray-700 text-xs">Sub Titulo</label>
    <span class="text-xs text-red-600">@error('slug') {{ $message }} @enderror</span>
</p>

<p>
    <input type="text" name="slug" class="rounded border-gray-200 w-full mb-4" value="{{ old('slug', $post->slug) }}">
</p>

<p>
    <label class="uppercase text-gray-700 text-xs">Conteúdo da Notícia</label>
    <span class="text-xs text-red-600">@error('body') {{ $message }} @enderror</span>
</p>

<p>
    <textarea class="rounded border-gray-200 w-full mb-4" id="mytextarea" name="body" rows="15">{{ old('body', $post->body) }}</textarea>
</p>

<div class="flex justify-between items-center">

  <a href="{{ route('posts.index') }}" class="text-indigo-600">Voltar</a>

  <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2">

</div>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/yif52dkl8qftmxphntxceoce40ortglrm07rw60srkkeihtl/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
</script>