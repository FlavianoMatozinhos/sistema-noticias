@extends('template')

@section('title', 'home')

@section('description', 'Página principal de mi web')

@section('content')
  <div class="container mt-5 mb-5">
    <div class="titulo_principal">
        <h1 class="text-light">
            <strong>{{ $latestPost->title }}</strong>
        </h1>
        <p class="text-light">{{ $latestPost->slug }}</p>
    </div>
    <div class="imagem_principal pt-4">
      <a href="{{ route('post', $latestPost->id) }}">
        <img src="{{ asset('.' . $latestPost->image) }}" alt="Imagem Principal">
      </a>
    </div>
  </div>

  <div class="noticias text-center">
    <h1 class="text-light">+ Notícias</h1>
  </div>

  <div class="d-flex justify-content-center mt-4">
    <div class="gallery js-flickity">
        @foreach ($posts as $post)
          <div class="gallery-cell">
              <div class="imagem_col">
                  <a href="{{ route('post', $post->id) }}">
                      <img src="{{ asset('.' . $post->image) }}" alt="Imagem Noticia 1">
                  </a>
              </div>
              <div class="titulo_col">
                  <h4>{{ $post->title }}</h4>
                  <p class="saiba_mais">Saiba Mais...</p>
              </div>
          </div>
        @endforeach
    </div>
  </div>
@endsection
