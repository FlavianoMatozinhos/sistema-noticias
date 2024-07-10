@extends('template')
@section('title','Post')
@section('description','Página de artículos')
@section('content')

<p class="py-16">
  <a href="{{ route('home') }}">Voltar</a>
</p>

<div class="bg-gray-900 px-20 py-16 mb-8 relative overflow-hidden">
  <span class="text-xs uppercase text-gray-700 bg-gray-400 rounded-full px-2 py-1"> {{$post->created_at->format('d-m-Y H:i')}}</span>
  <h1 class="text-3xl text-white mt-4">{{$post->title}}</h1>
  <img class="absolute -right-20 -bottom-20 opacity-20" src="{{$post['image']}}">
</div>
<div class="container mx-auto"> 
    <div class="mx-auto">

      <p class="leading-loose text-lg text-gray-700">
        {!! nl2br($post->body) !!}
      </p>

    </div>
</div>
@endsection
