@extends('template')

@section('title','Blog')
@section('description','Blog sobre programación')

@section('content')
<h1 class="titular">Archivo de Posts</h1>

<div class="textCenter">
@foreach ($posts as $post)

<div class="grid">
    <p><a href="{{route('post',$post->slug)}}"><img src="{{$post->image}}" style="width:400px;max-width:100%"></a></p>
    <p class="titular-post">
        <a href="{{route('post',$post->slug)}}">{{$post->title}}</a>
    </p>
   <p><span>{{$post->user->name}}</span></p>
</div>
@endforeach

{{$posts->links()}}

</div>

@endsection

