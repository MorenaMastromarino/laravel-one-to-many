@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Edit post</h1>
  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
     <ul>
       @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
       @endforeach
     </ul>
    </div>
  @endif

  <form action="{{route('admin.posts.update', $post)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" value="{{old('title', $post->title)}}"
        class="form-control @error('title') is-invalid @enderror" 
        id="title" name="title" placeholder="titolo"
      >
      @error('title')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="content" class="form-label">Contenuto</label>
      <textarea class="form-control @error('content') is-invalid @enderror" 
        id="content" name="content" rows="3"
      >{{old('content', $post->content)}}</textarea>

      @error('content')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>

    <button type="submit" class="btn btn-success">EDIT</button>
    <button type="reset" class="btn btn-secondary">RESET</button>
  </form>
  
</div>
@endsection

@section('title')
  | {{$post->title}}
@endsection