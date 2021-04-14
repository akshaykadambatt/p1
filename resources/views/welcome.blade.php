@extends("layout.app")
@section('content')
<div class="container">
            <a href="#" class="text-sm text-gray-700 underline">Home</a>
            @auth
            <a href="#" class="text-sm text-gray-700 underline">Homeeeee</a>
            @endauth
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            @endif
            @endauth
        </div>
    @endif
        <form name="login" class="login" name="loginForm" id="loginbtn">
            <input name="email" placeholder="handle"/>
            <input name="password" type="text" placeholder="password"/>
            <button name="login" class="button" type="submit">go</button>
        </form>
        <form class="register" name="registerForm" id="registerbtn">
            <input name="name" placeholder="handle"/>
            <input name="email" placeholder="handle"/>
            <input name="password" type="password" placeholder="password"/>
            <input name="password_confirmation" type="password" placeholder="password"/>
            <button class="button" type="submit">go</button>
        </form>
</div> 
    </body>
</html>
@endsection
