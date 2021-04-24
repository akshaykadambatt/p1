@section('content_2')
<div class="container">
       <div class="post border-div"> Welcome @php print_r(Auth::user()->name); @endphp</div>
</div> 
    </body>
</html>
@endsection
