@extends('template')
@section('title','Post')
@section('description','Página de artículos')
@section('content')

<style>
  body {
    background-color: white;
    overflow-x: hidden;
  }

  h1, h5, h6, p {
    color: #464646;
  }

  .i {
    position: relative;
    display: block;
    width: 500px;
    height: 300px;
    overflow: hidden;
    border-radius: 5px;
  }

  .i:before, .i:after {
    content: '⥪';
    position: absolute;
    top: 50%;
    left: 1rem;
    z-index: 2;
    width: 2rem;
    height: 2rem;
    background: dodgerblue;
    color: white;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    pointer-events: none;
  }

  .i:after {
    content: '⥭';
    left: auto;
    right: 1rem;
  }

  /* I haven't found a way for IE and Edge to let me style inputs that way */
  .input {
    appearance: none;
    -ms-appearance: none;
    -webkit-appearance: none;
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    border-radius: 5px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    transform: translateX(100%);
    transition: transform ease-in-out 400ms;
    z-index: 1;
  }

  .input:focus {
    outline: none;
  }

  .input:after {
    content: attr(title);
    position: absolute;
    top: 1rem;
    left: 1rem;
    background-color: rgba(0,0,0,0.4);
    color: white;
    padding: .5rem;
    font-size: 1rem;
    border-radius: 5px;
  }

  .input:not(checked):before {
    cursor: pointer;
    content: '';
    position: absolute;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    top: 50%;
    left: calc(-100% + 1rem);
  }

  .input:checked:before {
    display: none;
    left: 1rem;
  }

  .input:checked {
    transform: translateX(0);
    pointer-event: none;
    z-index: 0;
    box-shadow: -5px 10px 20px -15px rgba(0,0,0,1);
  }

  .input:checked + .input:before {
    left: -3rem;
  }

  .input:checked + .input ~ .input:before {
    display: none;
  }
</style>

<div class="container view_notice">
  <div class="title">
    <h1 class="text-3xl mt-4 mb-4 text-break">{{$post->title}}</h1>
  </div>

  <div class="sub-title">
    <h5 class="text-break mb-4">{{ $post->slug }}</h5>
  </div>

  <div class="data-cadastro">
    <div class="row">
      <div class="col-10">
        <p>{{ $post->created_at->format('d/m/Y h:m') }}</p>
      </div>

      <div class="col-2">
        <a class="nav-link col" href="https://www.instagram.com/choqueiconca/" target="_blank">
          <i class="fa-brands fa-instagram"></i>
        </a>
      </div>
    </div>
  </div>

  <hr class="content__divider mb-4" style="border: 0; border-top: 1px solid white;">

  <div class="d-flex justify-content-center align-items-center flex-column" style="width: 100%; margin: 0 auto;">
    <div class="video-container">
      @if ($post->video_locale != null)
        <video-js class="video-js vjs-theme-city my-video-1 resolucao-video-principal" id="my-video-1" width="550" height="auto" controls autoplay="false">    
          <source src="{{ asset('storage/videos/' . $post->video_locale) }}" type="application/x-mpegURL">
        </video-js>
      @else
        <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}" style="width: 370px;height: 300px;">
      @endif
    </div>
    <div class="post-content">
      <h6 class="leading-loose text-lg text-gray-700 text-white text-break text-left" style="font-size: 20px; margin-top: 50px; line-height: 1.5;">
          {!! nl2br($post->body) !!}
      </h6>
    </div>

    {{-- @if ($post->images->count() > 0)
      <div class="mt-4">
          <h4>Imagens da Notícia</h4>
          <div class="row">
              @foreach ($post->images as $image)
                  <div class="col-6 mb-5" style="height: 250px">
                      <img src="{{ asset('storage/' . $image->path) }}" alt="Imagem {{ $loop->index }}" class="img-fluid" style="height: 100%; border-radius: 10px">
                  </div>
              @endforeach
          </div>
      </div>
    @endif --}}

    <i class="mb-5 i">
      @foreach ($post->images as $image)
        <input class="input" checked type="radio" name="s" style="background-image: url('{{ asset('storage/' . $image->path) }}');" title="Imagem {{ $loop->index }}">
      @endforeach
    </i>

  </div>
</div>


@endsection