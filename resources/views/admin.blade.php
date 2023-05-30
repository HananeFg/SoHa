<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Management Admin</title>
    <link rel="stylesheet" href="{{asset('Css/admin.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   

</head>
<body>
  <!-- Navbar -->
    <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
        <div class="back-button d-flex flex-row justify-content-center align-item-center ">
         
          <a href="#">        
            <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
          </a>

        </div>
        <div class="back-button logo d-flex flex-row justify-content-center align-item-center " >
          <button type="button" class="btn btn-light" >POS</button>
        </div>
        <div class="logo">
          <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">
  
        </div>
    </div>
    <hr><br><hr>

     <!-- Sidebar -->
    <div class="sidebar">
        <button class="sidebar-button">Dashboard</button>
        <button class="sidebar-button">Products</button>
        <button class="sidebar-button">Categories</button>
        <button class="sidebar-button">Sales</button>
        <button class="sidebar-button">Clients</button>
        <button class="sidebar-button">Rapports</button>
        <button class="sidebar-button">Users</button>
        <button class="sidebar-button">Tables</button>
        <button class="sidebar-button">Settings</button>
    </div>

    <!-- Content area -->
    <div class="content">
        <!-- Content for each page will be dynamically loaded here -->
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('JS/admin.js') }}"></script>
</body>
</html>
