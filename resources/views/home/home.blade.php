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
        
</div> 
    </body>
</html>
@endsection
