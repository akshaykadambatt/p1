@php
$count = 0;
@endphp
@foreach($posts as $post)
@php
$action = $likes = $dislikes = $plussed = 0;
if(isset($post->action[0])){
    if($post->action[0]->liked == 1){
        $action = 1;
    }elseif($post->action[0]->disliked == 1){
        $action = 2;
    }
    if($post->action[0]->plussed == 1){
        $plussed = 1;
    }
}
if($post->properties!=''){
    if(isset($post->properties["like"])){$likes = $post->properties["like"];}else{$likes = 0;}
    if(isset($post->properties["dislike"])){$dislikes = $post->properties["dislike"];}else{$dislikes = 0;}
    
}
@endphp
<div class="post border-div @php echo ($new==1)? 'new':'old' @endphp" data-count={{$count}}>
    <div class="post-inner">
        <div class="user">
            <div class="user-inner">
           
                <div class="avatar border-div"></div>
                <div class="avatar-desc">
                    <div class="avatar-name-desc">{{$post->user->name}}</div>
                    <div class="avatar-sub-desc">{{$post->created_at}}</div>
                </div>
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="M16 12c0-1.656 1.344-3 3-3s3 1.344 3 3-1.344 3-3 3-3-1.344-3-3zm1 0c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2zm-8 0c0-1.656 1.344-3 3-3s3 1.344 3 3-1.344 3-3 3-3-1.344-3-3zm1 0c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2zm-8 0c0-1.656 1.344-3 3-3s3 1.344 3 3-1.344 3-3 3-3-1.344-3-3zm1 0c0-1.104.896-2 2-2s2 .896 2 2-.896 2-2 2-2-.896-2-2z"/></svg>
            </div>
        </div>
        <div class="content" onclick="openPost('frombody',event);">
            {{$post->message}}</div>
    </div>
    <div class="actions" data-id={{$post->id}}>
    
        <div class="action-item like {{(($action == 1)? 'activated':'')}}" onclick="action(0, event);">

        <!--<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="M23.245 4l-11.245 14.374-11.219-14.374-.781.619 12 15.381 12-15.391-.755-.609z"/></svg>-->
        <svg width="3.8436mm" height="2.363mm" version="1.1" viewBox="0 0 3.8436 2.363" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">

 <g transform="translate(-1.5796 -2.2392)">
  <path d="m1.7112 4.4706 1.7903-2.0998 1.7903 2.0998v0" fill="none" stroke="#ffffff" stroke-dashoffset="7.8" stroke-linecap="round" stroke-linejoin="round" stroke-width=".26312" style="paint-order:markers fill stroke"/>
 </g>
</svg>

<span class="like-count"> {{$likes}} </span>
        </div>
        <div class="action-item dislike {{(($action == 2)? 'activated':'')}}" onclick="action(1, event);">

        <!--<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#fff"  fill-rule="evenodd" clip-rule="evenodd"><path d="M23.245 20l-11.245-14.374-11.219 14.374-.781-.619 12-15.381 12 15.391-.755.609z"/></svg>-->

        <svg width="3.8436mm" height="2.363mm" version="1.1" viewBox="0 0 3.8436 2.363" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">

 <g transform="translate(-1.5796 -2.2392)">
  <path d="m1.7112 2.3707 1.7903 2.0998 1.7903-2.0998v0" fill="none" stroke="#ffffff" stroke-dashoffset="7.8" stroke-linecap="round" stroke-linejoin="round" stroke-width=".26312" style="paint-order:markers fill stroke"/>
 </g>
</svg>
 <span class="dislike-count"> {{$dislikes}} </span>
        </div>
        <div class="action-item like"  onclick="openPost('frombutton',event);">

        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" /><path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z"/></svg>

        </div>
        <div class="action-item like {{($plussed == 1)? 'activated':''}}" onclick="action(2, event);">

        <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="M11.5 0c6.347 0 11.5 5.153 11.5 11.5s-5.153 11.5-11.5 11.5-11.5-5.153-11.5-11.5 5.153-11.5 11.5-11.5zm0 1c5.795 0 10.5 4.705 10.5 10.5s-4.705 10.5-10.5 10.5-10.5-4.705-10.5-10.5 4.705-10.5 10.5-10.5zm.5 10h6v1h-6v6h-1v-6h-6v-1h6v-6h1v6z"/></svg>

        <!--<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="#fff" fill-rule="evenodd" clip-rule="evenodd"><path d="M11 11v-11h1v11h11v1h-11v11h-1v-11h-11v-1h11z"/></svg>-->
        
        </div>
    </div>
</div>
@php
$count++;
@endphp
@endforeach