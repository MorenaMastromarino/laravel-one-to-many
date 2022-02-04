@extends('layouts.admin')

@section('content')
<div class="container">
  <h1>Crea nuovo post</h1>
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

  <form action="{{route('admin.posts.store')}}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Titolo</label>
      <input type="text" value="{{old('title')}}"
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
      >{{old('content')}}</textarea>

      @error('content')
        <div class="invalid-feedback">
          {{$message}}
        </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">Categoria</label>
      <select name="category_id" id="category_id" class="form-control">
        <option>Seleziona la categoria</option>
        @foreach ($categories as $category)
          <option @if ($category->id == old('category_id')) selected @endif value="{{$category->id}}">
            {{$category->name}}
          </option>            
        @endforeach

      </select>
    </div>

    <button type="submit" class="btn btn-success">CREA</button>
    <button type="reset" class="btn btn-secondary">RESET</button>
  </form>
  
</div>
@endsection

@section('title')
  | Nuovo post
@endsection