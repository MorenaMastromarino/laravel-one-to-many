@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>{{$post->title}}</h1>
  <p>{{$post->content}}</p>

  <div class="row">
    <a class="btn btn-info mr-3" href="{{route('admin.posts.edit', $post)}}">EDIT</a>
    <form onsubmit="return confirm('Vuoi eliminare il post {{$post->title}}?')"
       action="{{route('admin.posts.destroy', $post)}}" method="POST">
      @csrf
      @method('DELETE')
        <button type="submit" class="btn btn-danger">DELETE</button>
    </form>

  </div>
</div>
@endsection


@section('title')
  | {{$post->title}}
@endsection
