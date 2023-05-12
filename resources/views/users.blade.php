@extends('layout')

@section('content')
<img src="{{ asset('upload\2.png') }}" Class="LOGO">
<div class="role">
  @foreach ($users as $user)
    <div class="rectangle">
        <a href="{{ route('users.login', ['name' => $user->name]) }}">
      <h1>{{ $user->name }}</h1>
        </a>
    </div>
    @if($loop->iteration % 3 == 0)
      </div><div class="role">
    @endif
  @endforeach
</div>
@endsection
    
{{-- {{ route('users.login', ['name' => $user->name]) }} --}}