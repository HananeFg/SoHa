<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Category</title>
  <link rel="stylesheet" href="{{asset('Css/admin.css')}}">
  <link rel="stylesheet" href="{{asset('Css/ajout.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
    <div class="back-button">
      <a href="{{ route("categories.index") }}">        
        <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
      </a>
    </div>
    <div class="logo">
      <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">

    </div>
  </div>
    <!-- Sidebar -->
    <div class="sidebar">
      <button class="sidebar-button" onclick="toggleActive(this)">Dashboard</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Products</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Categories</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Sales</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Clients</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Rapports</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Users</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Tables</button>
      <button class="sidebar-button" onclick="toggleActive(this)">Settings</button>
    </div>
    <div class="content">
  <div class="container">
    <div class="">
      <h3 class="text-secondary">
        <i class="fas fa-pen-to-square"></i> Modifier la categorie <u>{{ $category->title }}</u>
      </h3>
    </div>
    <hr>
    <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data">
      @csrf
      @method("PUT")
      <div class="form-group inline">
        <div class="form-element">
          <label for="name">Name:</label>
          <input type="text" id="name" name="title" placeholder="category name" value="{{ $category->title }}" required>
        </div>
      </div>
      <div class="form-group description">
        <label >Description:</label>
        <textarea id="description" name="slug" placeholder="Description"  required>{{ $category->slug }}</textarea>
      </div>
      <div class="form-group inline">
        <div class="form-element">
          <label for="image">Upload Image:</label>
          <div class="upload-btn">
            <label for="file-upload">Choose File</label>
            <input type="file" id="file-upload" name="image" accept="image/*" value="{{ $category->image }}" >
          </div>
        </div>
      </div>
      <input type="hidden" name="category" value="{{ $category->id }}">
      <div class="form-group fix">
        <input type="submit" value="Modifier">
    </div>
  </form>
  

    @if (session('success'))
        <div class="alert alert-success">
            <strong style="color: rgb(23, 146, 52)">Added successfully!</strong> {{ session('success') }}
        </div>
    @endif
</div>
    </div>
    <script src="{{ asset('JS/admin.js') }}"></script>

</body>
</html>