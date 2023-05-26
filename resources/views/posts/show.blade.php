@extends('layout')

@section('content')

    <h1> {{ $data['title']}} </h1>
    <p> {{ $author }} </p>

@endsection

<div class="container">
    <form  method="POST" action="{{ route('ajoutArticle.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group inline">
        <div class="form-element">
          <label for="name">Name:</label>
          <input type="text" id="name" name="title" placeholder="add table name" required>
        </div>
        <div class="form-element">
          <label for="category">Status:</label>
          <select id="category" name="category_id" required>
            <option value="">Select a status</option>
        @foreach ($tables as $table)
            <option value="{{ $tables->id }}">{{ $tables->status }}</option>
        @endforeach
          </select>
        </div>
      </div>
    
      <div class="form-group fix" >
        <input type="submit" value="Save">
      </div>
    
    </form>
    @if (session('success'))
    <div class="alert alert-success">
        <strong style="color: rgb(23, 146, 52)">Ajoutée avec Success!</strong> {{ session('success') }}
    </div>
    @endif
  </div>