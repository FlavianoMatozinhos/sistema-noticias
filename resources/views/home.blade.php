@extends('template')

@section('title', 'home')

@section('description', 'Página principal de mi web')

@section('content')
<div class="container mt-5 mb-5">
  <div class="row">
      <div class="titulo_principal col-2 d-flex flex-column justify-content-center">
          <h1 class="text-light text-break">
              <strong>{{ $latestPost->title }}</strong>
          </h1>
          <p class="text-light text-break">{{ $latestPost->slug }}</p>

          <div class="bg-gray-800 py-2 rounded">
              <a href="{{ route('post', $latestPost->id) }}" class="btn btn-outline-light">Saiba Mais</a>
          </div>
      </div>
      <div class="imagem_principal col-6 d-flex justify-content-center align-items-center">
          <a href="{{ route('post', $latestPost->id) }}">
              <img src="{{ asset('.' . $latestPost->image) }}" alt="Imagem Principal" class="img-fluid">
          </a>
      </div>
  </div>
</div>

    <div class="container border_radius">
        <div class="background mt-3">
            <div class="noticias text-center mt-4">
            <h1 style="">+ Notícias</h1>
            </div>

            <div class="container mt-5">
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <a href="{{ route('post', $post->id) }}">
                                <img src="{{ asset('.' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                            </a>
                            <div class="card-body">
                                <h4 class="card-title text-truncate">{{ $post->title }}</h4>
                                <div class="bg-gray-800 py-2 rounded">
                                    <a href="{{ route('post', $post->id) }}" class="btn btn-outline-black">Saiba Mais</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>

</div>
@endsection
