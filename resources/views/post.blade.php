@extends('template')
@section('title','Post')
@section('description','Página de artículos')
@section('content')

<div class="container">
  <div class="row menu_principal">
    <div class="titulo_principal col-2 d-flex flex-column justify-content-center">
        <h1 class="text-3xl mt-4 text-break">{{$post->title}}</h1>
        <p class="leading-loose text-lg text-gray-700 text-break">
          {!! nl2br($post->body) !!}
        </p>

        <div class="bg-gray-800 py-2 rounded">
          <a href="{{ route('home') }}" class="btn btn-outline-dark">Voltar</a>
        </div>
    </div>

    <div class="imagem_principal col-6">
        <div class="row box">
            <div class="col-2 padding">
                <a href="{{ route('post', $post->id) }}">
                    <img class="img_principal" src="{{ asset('./images/choquei.png') }}" alt="Logo" style="">
                </a>
            </div>
            <div class="col-10"></div>
            <div class="col-12 padding">
                <img src="{{ asset('.' . $post->image) }}" alt="Imagem Principal" class="img-fluid">
            </div>
            <div class="col-12 title_image">
                <h5 class="text-break text-truncate">{{ $post->title }}</h5>
            </div>
        </div>
    </div>
  </div>
</div>

  {{-- <div class="bg-gray-800 py-2 rounded">
    <a href="{{ route('home') }}" class="btn btn-outline-light">Voltar</a>
  </div>
  <div class="row">
    <div class="col-4 d-flex flex-column justify-content-center">
      <span class="text-xs uppercase text-gray-700 bg-gray-400 rounded-full px-2 py-1 absolute top-4 right-4">{{$post->created_at->format('d-m-Y H:i')}}</span>
      <div class="max-w-md">
        <h1 class="text-3xl text-white mt-4 text-break">{{$post->title}}</h1>
        <p class="leading-loose text-lg text-gray-700 text-break">
          {!! nl2br($post->body) !!}
        </p>
      </div>
    </div>
    <div class="col-4 d-flex justify-content-center align-items-center">
      <img class="max-w-md card-img-top" src="{{$post['image']}}" alt="Imagem do Post">
    </div>
  </div> --}}
</div>
@endsection
