<!DOCTYPE html>
<html>
<head>
  <title>Ajout Article</title>
  <link rel="stylesheet" href="{{asset('Css/ajout.css')}}">
</head>
<body>
    <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
      <div class="back-button">
        <a href="#">        
          <img src="C:\Users\Lenovo\Downloads\up-arrow (3).png" alt="logo SoHa" width="50" height="50">
        </a>
      </div>
      <div class="logo">
        <img src="upload/1.png" alt="logo SoHa" width="80" height="50">

      </div>
    </div>
 

  <br>
  <hr>
  <div class="container">
    <form>
      <div class="form-group inline">
        <div class="form-element">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div class="form-element">
          <label for="category">Category:</label>
          <select id="category" name="category" required>
            <option value="">Select a category</option>
            <option value="category1">Category 1</option>
            <option value="category2">Category 2</option>
            <option value="category3">Category 3</option>
          </select>
        </div>
      </div>
      <div class="form-group description">
        <textarea id="description" name="description" placeholder="Description" required></textarea>
      </div>
      <div class="form-group inline">
        <div class="form-element">
          <label for="price">Price:</label>
          <input type="text" id="price" name="price" required>
        </div>
        <div class="form-element">
          <label for="image">Upload Image:</label>
          <div class="upload-btn">
            <label for="file-upload">Choose File</label>
            <input type="file" id="file-upload" name="image" accept="image/*" required>
          </div>
        </div>
      </div>

      <div class="form-group">
        <input type="submit" value="Save">
      </div>
    </form>
  </div>
</body>
</html>
