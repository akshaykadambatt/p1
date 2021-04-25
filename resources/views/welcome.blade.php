@extends("layout.app")
@section('content')
<div class="container">
            <a href="#" class="text-sm text-gray-700 underline">Home</a>
            @auth
            <form name="logout" class="logout" method="post" action="/logout" name="logoutForm" id="logoutbtn">
            @csrf
            <button name="logout" class="button" type="submit">logout</button>
        </form>
            @endauth
        <form name="login" class="login" action="/login" name="loginForm" id="loginbtn">
            @csrf
            <input name="email" placeholder="handle" autocomplete = "username"/>
            <input name="password" type="text" placeholder="password" autocomplete="current-password"/>
            <button name="login" class="button" type="submit">go</button>
        </form>
        <form class="register" name="registerForm" id="registerbtn">
            <input name="name" placeholder="name"/>
            <input name="email" placeholder="handle" autocomplete="username"/>
            <input name="password" type="password" placeholder="password" autocomplete="new-password"/>
            <input name="password_confirmation" type="password" placeholder="password" autocomplete="new-password"/>
            <button class="button" type="submit">go</button>
        </form>
</div> 
    </body>
</html>
@endsection
