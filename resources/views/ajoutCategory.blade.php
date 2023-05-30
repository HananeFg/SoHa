<!DOCTYPE html>
<html>
<head>
  <title>Add Category</title>
  <link rel="stylesheet" href="{{asset('Css/ajout.css')}}">
</head>
<body>
    <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
      <div class="back-button">
        <a href="#">        
          <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
        </a>
      </div>
      <div class="logo">
        <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">

      </div>
    </div>
 

  <br>
  <hr>
  <div class="container">
    <form  method="POST" action="{{ route('ajoutCategory.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group inline">
        <div class="form-element">
          <label for="name">Name:</label>
          <input type="text" id="name" name="title" placeholder="add your category name" required>
        </div>
      </div>
      <div class="form-group description">
        <textarea id="description" name="slug" placeholder="Description" required></textarea>
      </div>
      <div class="form-group inline">
        <div class="form-element">
          <label for="image">Upload Image:</label>
          <div class="upload-btn">
            <label for="file-upload">Choose File</label>
            <input type="file" id="file-upload" name="image" accept="image/*" >
          </div>
        </div>
      </div>
      
      <div class="form-group fix" >
        <input type="submit" value="Save">
      </div>
      
    </form>
    @if (session('success'))
    <div class="alert alert-success">
        <strong style="color: rgb(35, 198, 76)">Success!</strong> {{ session('success') }}
    </div>
    @endif
  </div>
</body>
</html>
