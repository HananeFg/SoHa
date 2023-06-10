
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Users</title>
  <link rel="stylesheet" href="{{asset('Css/admin.css')}}">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

  <style>
    /* Add some basic styling for the table */
    table {
        margin-left: 5%;
        margin-right: 5%;
        width: 90%;
        border-collapse: collapse;
    }
    
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    th {
        background-color: #f2f2f2;
    }

    .add-sale-button {
        margin-top: 20px;
    }

    /* Example custom styles for pagination */
    .pagination {
      display: flex;
      justify-content: center;
    }

    .pagination li {
      margin: 0 5px;
      list-style-type: none;
    }

    .pagination a {
      padding: 5px 10px;
      text-decoration: none;
      color: #333;
      background-color: #f2f2f2;
      border-radius: 4px;
    }

    .pagination .active a {
      background-color: #666;
      color: #fff;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      background-color: #000066;
      color: #fff;

      width: 100%;
      z-index: 999; /* Add a higher z-index to ensure the navbar appears on top of other elements */
    }
    .navbar::after {
      content: "";
      display: table;
      clear: both;
    }
    .navbar .logo {
      font-size: 24px;
      font-weight: bold;
      float: right;
    }
    .navbar .back-button {
      font-size: 18px;
      float: left;
    }

    .add-button {
      position: absolute;
      bottom: 5px;
      right: 5%;
      padding: 10px 20px;
      background-color: #4caf50;
      color: white;
      border: none;
      /* border-radius: 4px; */
      cursor: pointer;
    }

    .contain{
      
      justify-content: space-between;
    }

    h3 {
     
      margin-left: 5%;
    }
    .icon {
      
      font-size: 50px;
      margin-bottom: 5px;
      margin-right: 5%;
    } 
    .title {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: center;
    }

  </style>
</head>
<body>
  <div class="navbar">
    <div class="back-button">
        <a href="{{ route("admin") }}">        
            <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
        </a>
    </div>
    <div class="logo">
        <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">
    </div>
  </div>
  <br><br><br>
  <!-- Sidebar -->
  <div class="sidebar">
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-chart-line fa-x2"></i>Dashboard</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-burger fa-x2"></i>Products</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-list fa-x2"></i>Categories</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-cash-register fa-x2"></i>Sales</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-users fa-x2"></i>Clients</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-file fa-x2"></i>Rapports</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-user fa-x2"></i>Users</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-table fa-x2"></i>Tables</button>
    <button class="sidebar-button" onclick="toggleActive(this)"><i class="fas fa-gear fa-x2"></i>Settings</button>
  </div>
  <div class="content">
    <div class="title">
      <h3 class="text-secondary">
        <i class="fas fa-user fa-x2"></i> users
      </h3>
      <div class="icon">
        <a href="{{ route("utilisateurs.create") }}" class="ml-auto">
            <i class="fas fa-square-plus fa-x2" ></i>
        </a>
      </div>
    </div>
  
  
  <table>
    <tr>
        <th>id</th>
        <th>Nom et prénom</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
    @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
              <form action="{{route('utilisateurs.destroy', $user->id)}}" onsubmit="return confirm('Voulez vous vraiment supprimer l\'article du {{ $user->name }} ?');" method="post">

                  {{ csrf_field() }} {{ method_field('DELETE') }}
                  <a href="{{ route('utilisateurs.edit', $user) }}" class="btn btn-warning">
                          <i class="fas fa-edit fa-x2"></i>
                  </a>
                  <button  class="btn btn-danger" type="submit">
                      <i class="fas fa-trash fa-x2"></i>
                  </button>
              </form>
            </td>
        </tr>
    @endforeach
  </table>

<!-- ... -->


        {{ $users->onEachSide(1)->links() }}
      </div>
      <script src="{{ asset('JS/admin.js') }}"></script>
      <script>
        function toggleActive(button) {
            var sidebarButtons = document.getElementsByClassName("sidebar-button");
            for (var i = 0; i < sidebarButtons.length; i++) {
                sidebarButtons[i].classList.remove("active");
            }
            button.classList.add("active");
        }
      </script>
</body>
</html>