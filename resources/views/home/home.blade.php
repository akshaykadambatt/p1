@extends("userlayout.app")
@section('content')
<div class="container">
       <div class="post border-div"> Welcome @php print_r(Auth::user()->name); @endphp</div>
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.component-post')
    @include('userlayout.navfooter')
</div> 
    </body>
</html>
@endsection
