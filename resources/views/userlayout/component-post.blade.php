<div class="post border-div @php echo ($new==1)? 'new':'old' @endphp" data-count={{$count}} >
    <div class="post-inner">
        <div class="user">
            <div class="user-inner">
            
                <div class="avatar border-div"></div>
                <div class="avatar-desc"><div class="avatar-name-desc">{{$user->name}}</div><div class="avatar-sub-desc">{{$created_at}}</div></div>
            </div>
        </div>
        <div class="content">
        {{$message}}</div>
    </div>
    <div class="actions">
        <div class="action-item like">
<span class="material-icons material-icons-outlined">
favorite_border
</span>
</div>
        <div class="action-item like"><span class="material-icons material-icons-outlined">
notes
</span></div>
        <div class="action-item like"><span class="material-icons material-icons-outlined">
add_circle_outline
</span></div>
    </div>
</div>
