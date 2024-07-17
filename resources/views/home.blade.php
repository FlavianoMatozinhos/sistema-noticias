@extends('template')

@section('title', 'home')

@section('description', 'Página principal de mi web')

@section('content')
<div class="container mt-5 mb-5 home">
    <div class="row menu_principal">
        <h1 class="text-white">Ultimas noticias</h1>
        @if($latestPost != null)
            <div class="titulo_principal col-2 d-flex flex-column justify-content-center">
                <h2 class="text-break">
                    <strong>{{ $latestPost->title }}</strong>
                </h2>
                <p class="text-break">{{ $latestPost->slug }}</p>

                <div class="bg-gray-800 py-2 rounded">
                    <a href="{{ route('post', $latestPost->id) }}" class="btn btn-outline-dark">Saiba Mais</a>
                </div>
            </div>

            <div class="imagem_principal col-6">
                <div class="row box">
                    <div class="col-2 padding">
                        <a href="{{ route('post', $latestPost->id) }}">
                            <img class="img_principal" src="{{ asset('./images/choquei.png') }}" alt="Logo" style="">
                        </a>
                    </div>
                    <div class="col-10"></div>
                    <div class="col-12 padding">
                        <img src="{{ asset('storage/' . $latestPost->main_image) }}" alt="Imagem Principal" class="img-fluid">
                    </div>
                    <div class="col-12 title_image">
                        <h5 class="text-break text-truncate">{{ $latestPost->title }}</h5>
                    </div>
                </div>
            </div>
        @else
            <p>Nenhuma noticia encontrada</p>
        @endif
    </div>

    <div class="container border_radius padding">
        <div class="mt-3">
            <div class="noticias mt-4 mb-4 d-flex align-items-center justify-content-between">
                <div class="col-3 text-left">
                    <label class="text-white">Pesquise uma noticia</label>
                    <input id="search-input" class="form-control" type="search" placeholder="Search" aria-label="Search">
                </div>
                <div class="col-7 text-left">
                    <h1 class="text-white">+ Notícias</h1>
                </div>
            </div>
            
            @if($posts != null)
                <div class="container">
                    <div class="row" id="posts-container">
                        @foreach ($posts as $post)
                            <div class="col-4 d-flex flex-wrap justify-content-center mb-4 post-item" data-title="{{ $post->title }}">
                                <div class="row box w-100 mb-4">
                                    <div class="col-2 p-0">
                                        <img class="img_principal" src="{{ asset('./images/choquei.png') }}" alt="Logo">
                                    </div>
                                    <div class="col-10"></div>
                                    <div class="col-12 p-0">
                                        <a href="{{ route('post', $post->id) }}">
                                            <img src="{{ asset('storage/' . $post->main_image) }}" alt="{{ $post->title }}" style="width: 370px;height: 300px;">
                                        </a>
                                    </div>
                                    <div class="col-12 title_image">
                                        <h4 class="card-title text-truncate">{{ $post->title }}</h4>
                                        <div class="bg-gray-800 py-2 rounded">
                                            <a href="{{ route('post', $post->id) }}" class="btn btn-outline-dark">Saiba Mais</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $posts->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            @else
                <p>Nenhuma noticia encontrada</p>
            @endif
        </div>
    </div>
</div>
@endsection
