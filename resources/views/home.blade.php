
@extends('layout')

@section('content')
<img src="{{ asset('upload\2.png') }}" Class="LOGO">
<div class="role">

 <div class="rectangle">
    <a href="{{ route('users.names', ['role' => 'admin']) }}" style="text-decoration: none;">
         <h1>Admin</h1>
     </a>
</div>


 <div class="rectangle">
    <a href="{{ route('users.names', ['role' => 'caissier']) }}" style="text-decoration: none;">
         <h1>Caissier</h1>
     </a>
 
 </div>

 <div class="rectangle">
    <a href="{{ route('users.names', ['role' => 'serveur']) }}"style="text-decoration: none;">
         <h1>Servant</h1>
      </a>
 </div>

 </div>
@endsection

