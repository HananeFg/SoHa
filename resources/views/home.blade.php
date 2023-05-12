
@extends('layout')

@section('content')
<img src="{{ asset('upload\2.png') }}" Class="LOGO">
<div class="role">

 <div class="rectangle">
    <a href="{{ route('users.index', ['role' => 'admin']) }}">
         <h1>Admin</h1>
     </a>
</div>


 <div class="rectangle">
    <a href="{{ route('users.index', ['role' => 'caissier']) }}">
         <h1>Caissier</h1>
     </a>
 
 </div>

 <div class="rectangle">
    <a href="{{ route('users.index', ['role' => 'serveur']) }}">
         <h1>Servant</h1>
      </a>
 </div>

 </div>
@endsection

