<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Table</title>
  {{-- <link rel="stylesheet" href="{{asset('Css/admin.css')}}"> --}}

  <link rel="stylesheet" href="{{asset('Css/ajout.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
    <div class="back-button">
      <a href="{{ route('utilisateurs.index') }}">        
        <img src="{{ asset('upload\up-arrow.png') }}" alt="logo Soha" width="50" height="50">
      </a>
    </div>
    <div class="logo">
      <img src="{{ asset('upload\1.png') }}" alt="logo SoHa" width="50" height="50" style="padding-right: 15px">

    </div>
  </div>

  
  <div class="container">
    <div class="">
      <h3 class="text-secondary">
        <i class="fas fa-plus"></i> Update  <u>{{ $user->name }}</u>'s informations
      </h3>
    </div>
    <hr>

    <form method="POST" action="{{ route('utilisateurs.update', ['user' => $user->id]) }}" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-group inline">
            <div class="form-element">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="" value="{{ $user->name }}" required>
            </div>
            <div class="form-element">
              <label for="name">email:</label>
              <input type="text" id="email" name="email" placeholder="" value="{{ $user->email }}" required>
            </div>
            <div class="form-element">
              <label for="name">Password:</label>
              <input type="password" id="password" name="password" placeholder="" value="{{ $user->password }}" required>
              <i class="far fa-eye" id="togglePassword"></i>
            </div>
            <div class="form-element">
              <label for="name">login:</label>
              <input type="text" id="login" name="login" placeholder="" value="{{ $user->login }}" required>
            </div>
            <div class="form-element">
                <label for="status">Role:</label>
                <select id="role" name="role"  required>
                    <option value="{{ $user->role }}">Choisir un role</option>
                    <option value="admin">Admin</option>
                    <option value="serveur">Serveur</option>
                    <option value="caissier">Caissier</option>
                </select>
            </div>
        </div>
        <input type="hidden" name="user" value="{{ $user->id }}">
        <div class="form-group fix">
            <input type="submit" value="Modifier">
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            <strong style="color: rgb(23, 146, 52)">Success!</strong> {{ session('success') }}
        </div>
    @endif
</div>
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);

      // Change the eye icon based on the password visibility
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
  });
</script>

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