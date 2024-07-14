@extends('template')
@section('title','Post')
@section('description','Página de artículos')
@section('content')

<div class="container view_notice">
  <div class="title">
    <h1 class="text-3xl text-white mt-4 mb-4 text-break">{{$post->title}}</h1>
  </div>

  <div class="sub-title">
    <h5 class="text-break mb-4 text-white">{{ $post->slug }}</h5>
  </div>

  <div class="data-cadastro">
    <div class="row">
      <div class="col-10">
        <p class="text-white">{{ $post->created_at }}</p>
      </div>

      <div class="col-2">
        <a class="nav-link col" href="https://www.instagram.com" target="_blank">
          <i class="fa-brands fa-instagram"></i>
        </a>
      </div>
    </div>
  </div>

  <hr class="content__divider mb-4" style="border: 0; border-top: 1px solid white;">

  <div class="d-flex justify-content-center align-items-center flex-column" style="width: 100%; margin: 0 auto;">
    <div class="video-container">
      <video-js class="video-js vjs-theme-city my-video-1 resolucao-video-principal" id="my-video-1" width="550" height="auto" controls autoplay="false">    
        <source src="{{ asset('storage/videos/' . $post->video_locale) }}" type="application/x-mpegURL">
      </video-js>
    </div>
    <div>
      <h6 class="leading-loose text-lg text-gray-700 text-white text-break text-left" style="font-size: 20px; margin-top: 50px;">
          {!! nl2br($post->body) !!}
      </h6>
    </div>
    @if ($post->images->count() > 0)
      <div class="mt-4">
          <h4>Imagens da Notícia</h4>
          <div class="row">
              @foreach ($post->images as $image)
                  <div class="col-6 mt-3">
                      <img src="{{ asset('storage/' . $image->path) }}" alt="Imagem {{ $loop->index }}" class="img-fluid">
                  </div>
              @endforeach
          </div>
      </div>
    @endif
  </div>
</div>
@endsection