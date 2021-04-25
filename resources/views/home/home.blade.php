@extends("userlayout.app")
@section('content_home')
<div class="container maintabs one active">
    <div class="post border-div"> Fuck twitter, free speech starts here. </div>
    <div class="post border-div"> Welcome @php print_r(Auth::user()->name); @endphp</div>
</div>
@endsection
@include('home.search')
@include('home.plus')
@include('home.star')
@include('home.profile')
@yield('home.content_2')