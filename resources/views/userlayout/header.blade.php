<div class="navbar">
<div class="logo">logo</div>
<div class="menu">@auth
            <form name="logout" class="logout" method="post" action="/logout" name="logoutForm" id="logoutbtn">
            @csrf
            <button name="logout" class="button" type="submit">logout</button>
        </form>
            @endauth</div>
</div>