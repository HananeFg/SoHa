
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('Css/login.css')}}">
    <title>Document</title>
</head>
<body>
  
  
     <img src="{{ asset('upload\2.png') }}" Class="LOGO">
        <div class="container">
           
            <div class="login-form">
        <div class="login">  
          
        
            <form method="post" action="{{ route('users.submit') }}">
              @csrf
              <p><input type="text" name="name" value=" {{ implode(',', $users->pluck('name')->toArray()) }}"placeholder="Username or Email"></p>
              <p><input type="password" id="passwordInput" name="password" value="" placeholder="Password"></p>
              <p class="remember_me">
                <label>
                  <input type="checkbox" name="remember_me" id="remember_me">
                  Remember me
                </label>
              </p>
              <p class="submit" "><input type="submit" name="commit" value="Login"></p>
                  @if($errors->has('message'))
                    <div class="alert alert-danger">
                       <p style="color: red" >{{ $errors->first('message') }} <p>
                   </div>
                  @endif
               
            </form>
          </div> 
          
        
       
</div>

  <div class="password-input">
    
    <div class="buttons">
      <div class="row">
        <button class="num-btn" onclick="insertCharacter('1')">1</button>
        <button class="num-btn" onclick="insertCharacter('2')">2</button>
        <button class="num-btn" onclick="insertCharacter('3')">3</button>
      </div>
      <div class="row">
        <button class="num-btn" onclick="insertCharacter('4')">4</button>
        <button class="num-btn" onclick="insertCharacter('5')">5</button>
        <button class="num-btn" onclick="insertCharacter('6')">6</button>
      </div>
      <div class="row">
        <button class="num-btn" onclick="insertCharacter('7')">7</button>
        <button class="num-btn" onclick="insertCharacter('8')">8</button>
        <button class="num-btn" onclick="insertCharacter('9')">9</button>
      </div>
      <div class="row">
        <button class="num-btn" onclick="insertCharacter('#')">#</button>
        <button class="num-btn" onclick="insertCharacter('0')">0</button>
        <button class="num-btn" onclick="insertCharacter('*')">*</button>
    
      </div>
    </div>
  </div>
</div>
 <div class="login-help">
            <p>Forgot your password? <a href="#">Click here</a>.</p>
          </div>


          <script>
            function insertCharacter(character) {
                var passwordInput = document.getElementById('passwordInput');
                passwordInput.value += character;
            }
        </script>
</body>
</html>
