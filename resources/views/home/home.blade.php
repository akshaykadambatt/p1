@extends("userlayout.app")
@section('content_home')
<div class="container maintabs one active">
    <div class="user-wall-head">
        
        <div class="post border-div"><div class="post-heading">Welcome @php echo(strtok(Auth::user()->name,' ')); @endphp.</div>
        <br>Fuck twitter, free speech starts here.<br><br></div>
    </div>
</div>
@endsection
@include('home.search')
@include('home.plus')
@include('home.star')
@include('home.profile')
@yield('home.content_2')