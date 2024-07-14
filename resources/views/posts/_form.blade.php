@csrf 

<p>
    <label class="uppercase text-gray-700 text-xs">Imagem Principal da Noticia</label>
    <span class="text-xs text-red-600">@error('image') {{ $message }} @enderror</span>
</p>

<p>
    <input type="file" name="image" class="rounded border-gray-200 w-full mb-4">
</p>

<p>
    <label class="uppercase text-gray-700 text-xs">Imagens da Noticia</label>
    <span class="text-xs text-red-600">@error('image') {{ $message }} @enderror</span>
</p>

<p>
    <input type="file" name="images[]" class="rounded border-gray-200 w-full mb-4" multiple>
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

<p>
    <label class="uppercase text-gray-700 text-xs">Adicinar video</label>
    <span class="text-xs text-red-600">@error('video') {{ $message }} @enderror</span>
</p>

<p>
    <input type="file" name="video" class="rounded border-gray-200 w-full mb-4">
</p>

<div class="flex justify-between items-center">

  <a href="{{ route('posts.index') }}" class="text-indigo-600">Voltar</a>

  <input type="submit" value="Enviar" class="bg-gray-800 text-white rounded px-4 py-2">

</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Resumable JS -->
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

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

<script type="text/javascript">
    let browseFile = $('#browseFile');
    let resumable = new Resumable({
        target: '{{ route('posts.store') }}',
        query:{_token:'{{ csrf_token() }}'} ,// CSRF token
        fileType: ['mp4'],
        headers: {
            'Accept' : 'application/json'
        },
        testChunks: false,
        throttleProgressCallbacks: 1,
    });

    resumable.assignBrowse(browseFile[0]);

    resumable.on('fileAdded', function (file) { // trigger when file picked
        showProgress();
        resumable.upload() // to actually start uploading.
    });

    resumable.on('fileProgress', function (file) { // trigger when file progress update
        updateProgress(Math.floor(file.progress() * 100));
    });

    resumable.on('fileSuccess', function (file) { // trigger when file upload complete
        $('#successModal').modal('show');
    });

    resumable.on('fileError', function (file) { // trigger when file upload complete
        $('#errorModal').modal('show');
    });

    $('#concluidoBtn').on('click', function() {
        window.location.href = '{{ route('posts.index') }}';
    });            

    $('#concluidoBtnError').on('click', function() {
        
    });

    let progress = $('.progress');
    function showProgress() {
        progress.find('.progress-bar').css('width', '0%');
        progress.find('.progress-bar').html('0%');
        progress.find('.progress-bar').removeClass('bg-success');
        progress.show();
    }

    function updateProgress(value) {
        progress.find('.progress-bar').css('width', `${value}%`)
        progress.find('.progress-bar').html(`${value}%`)
    }

    function hideProgress() {
        progress.hide();
    }
</script>