<!DOCTYPE html>
<html>
<head>
  <title>Add Article</title>
  <link rel="stylesheet" href="{{asset('Css/admin.css')}}">

  <link rel="stylesheet" href="{{asset('Css/ajout.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
    <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
      <div class="back-button">
        <a href="{{ route("products.index") }}">        
          <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
        </a>
      </div>
      <div class="logo">
        <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">

      </div>
    </div>
 

  <br>
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
        <i class="fas fa-plus"></i>Ajouter un article
      </h3>
    </div>
    <hr>
    <form  method="POST" action="{{ route('ajoutArticle.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group inline">
        <div class="form-element">
          <label for="name">Name:</label>
          <input type="text" id="name" name="title" placeholder="add your product name" required>
        </div>
        <div class="form-element">
          <label for="category">Category:</label>
          <select id="category" name="category_id" required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group description">
        <textarea id="description" name="slug" placeholder="Description" required></textarea>
      </div>
      <div class="form-group inline">
        <div class="form-element">
          <label for="price">Price:</label>
          <input type="text" id="price" name="unit_price" required value="00.00">
        </div>
        <div class="form-element">
          <label for="TVA">TVA:</label>
          <input type="text" id="price" name="TVA" required value="00.00">
        </div>
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
        <strong style="color: rgb(23, 146, 52)">Ajoutée avec Success!</strong> {{ session('success') }}
    </div>
    @endif
  </div>
</div>
</body>
</html>
