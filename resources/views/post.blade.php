@extends('template')
@section('title','Post')
@section('description','Página de artículos')
@section('content')

<div class="bg-gray-900 px-20 py-16 mb-8 relative overflow-hidden container">
  <div class="bg-gray-800 py-2 rounded">
    <a href="{{ route('home') }}" class="btn btn-outline-light">Voltar</a>
  </div>
  <div class="row">
    <div class="col-7 d-flex flex-column justify-content-center">
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
  </div>
</div>
@endsection
