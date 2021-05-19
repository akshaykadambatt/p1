@extends("userlayout.app")
@section('content_home')
<div class="container maintabs one active">
    <div class="user-wall-head">
        <div class="post border-div">
        <br>
            <div class="post-heading">Welcome @php echo(strtok(Auth::user()->name,' ')); @endphp.</div>
            <br>Fuck twitter, free speech starts here.<br><br>
            @auth
            <form name="logout" class="logout" method="post" action="/logout" name="logoutForm" id="logoutbtn">
                @csrf
                <button name="logout" class="" type="submit">Logout</button>
            </form>
            @endauth
            <br>
        </div>
    </div>
</div>
@endsection
@include('home.search')
@include('home.plus')
@include('home.star')
@include('home.profile')
@yield('home.content_2')