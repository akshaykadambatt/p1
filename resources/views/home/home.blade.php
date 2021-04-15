@extends("userlayout.app")
@section('content')
<div class="container">
            
        Welcome @php print_r(Auth::user()->name); @endphp
    @include('userlayout.navfooter')
</div> 
    </body>
</html>
@endsection
