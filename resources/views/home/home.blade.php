@extends("userlayout.app")
@section('content_home')

       <div class="post border-div"> Welcome @php print_r(Auth::user()->name); @endphp</div>
    

@include('userlayout.navfooter')
 
@endsection
@include('home.search')
@include('home.plus')
@include('home.star')
@include('home.profile')
@yield('home.content_2')