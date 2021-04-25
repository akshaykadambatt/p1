@section('content_3')
<div class="container maintabs three">
<div class="create-post">
    <div class="post-heading">Create.</div>
    <form method="post" id="createPost">
      <input class='border-div' name='user_id' type='hidden' value='@php echo(Auth::user()->id); @endphp'/>
      <input class='border-div' name='type' type='hidden' value='1'/>
    <div class="post-box"><textarea required class='border-div' name="txt" cols="30" rows="10"></textarea></div>
    <button type="submit" class="post-submit border-div button-feedback"><div class="spinLoader"><svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    width="30px" height="30px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
 <path fill="#c6c6c6" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z">
   <animateTransform attributeType="xml"
     attributeName="transform"
     type="rotate"
     from="0 25 25"
     to="360 25 25"
     dur="0.96s"
     repeatCount="indefinite"/>
   </path>
 </svg></div>Send</button>
    </form>
    <!-- https://stackoverflow.com/questions/244183/how-to-display-a-loading-screen-while-site-content-loads 
  https://mysql.tutorials24x7.com/blog/guide-to-design-database-for-social-network-system-in-mysql -->
</div>
</div> 
    </body>
</html>
@endsection
