<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>update client</title>
  <link rel="stylesheet" href="{{asset('Css/ajout.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="navbar"  padding-bottom: 0px; padding-top: 0px;>
    <div class="back-button">
      <a href="{{ route("clients.index") }}">        
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
        <i class="fas fa-plus"></i> Modifier le client <u>{{ $client->name }}</u>
      </h3>
    </div>
    <hr>
    <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="POST">
        @csrf
        @method("PUT")
        <div class="form-group inline flex-col">
          <div class="flex-row">
            <div class="form-element">
                <label for="name">Nom:</label>
                <input type="text" id="name" name="name" value="{{ $client->name }}"  required>
            </div>
            <div class="form-element">
                <label for="name">Email:</label>
                <input type="email" id="email" name="email" value="{{ $client->email }}"  required>
            </div>
          </div>
            <br>
          <div class="flex-row">
            <div class="form-element">
                <label for="name">Tel:</label>
                <input type="tel" id="tel" name="tel" value="{{ $client->tel }}"  required>
            </div>
            <div class="form-element">
                <label for="name">Adresse:</label>
                <input type="text" id="address" name="address" value="{{ $client->address }}"  required>
            </div>
          </div>  
           
        </div>
        <input type="hidden" name="client" value="{{ $client->id }}">
        <div class="form-group fix">
            <input type="submit" value="Modifier">
        </div>
    </form>

    @if (session('success'))
        <div class="alert alert-success">
            <strong style="color: rgb(23, 146, 52)">success!</strong> {{ session('success') }}
        </div>
    @endif
</div>
</body>
</html>