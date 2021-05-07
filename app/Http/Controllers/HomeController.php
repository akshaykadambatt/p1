<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Action;
use View;
use Response;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function textPost(Request $request)
    {
        $postContent = 'This is the post content. Enjoy!';
        $html = View::make('userlayout.component-post', ['text'=>$postContent,'user'=>'username'])->render();
        return Response::json($html);
    }

    public function getPosts(Request $request)
    {
        $posts = Post::with('user')->latest('created_at')->take($request->num)->get();
        $html='';
        $sentPosts = array();
        for ($i=0;$i<count($posts);$i++) {
            array_push($sentPosts, $posts[$i]->id);
        }
        Session::put('sentPosts', $sentPosts);
        Session::put('lastRefreshedTime', Carbon::now()->toDateTimeString());
        return View::make('userlayout.component-post', [
            "posts" => $posts,
            "new" => 0
            // 'count'=>$i,
            // 'id'=> $posts[$i]->id,
            // 'user_id'=> $posts[$i]->user_id,
            // 'message'=> $posts[$i]->message,
            // 'type'=> $posts[$i]->type,
            // 'properties'=> $posts[$i]->properties,
            // 'created_at'=> $posts[$i]->created_at,
            // 'user'=> $posts[$i]->user,
            // 'new'=> 0
            ])->render();
    }

    public function getNewPosts(Request $request)
    {
        $posts = Post::with('user')->take($request->num)->where('created_at', '>=', Session::get('lastRefreshedTime'))->whereNotIn('id', Session::get('sentPosts'))->latest('created_at')->get();
        $html='';
        $sentPosts = Session::get('sentPosts');
        for ($i=0;$i<count($posts);$i++) {
            array_push($sentPosts, $posts[$i]->id);
        }
        Session::put('sentPosts', $sentPosts);
        return View::make('userlayout.component-post', [
                "posts" => $posts,
                "new" => 1
                // 'count'=>$i,
                // 'id'=> $posts[$i]->id,
                // 'user_id'=> $posts[$i]->user_id,
                // 'message'=> $posts[$i]->message,
                // 'type'=> $posts[$i]->type,
                // 'properties'=> $posts[$i]->properties,
                // 'created_at'=> $posts[$i]->created_at,
                // 'user'=> $posts[$i]->user,
                // 'new'=> 0
                ])->render();
    }

    public function storeTextPost(Request $request)
    {
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->message = $request->txt;
        $post->type = $request->type;
        $post->properties = '';
        $post->save();
        return Post::with('user')->get();
    }

    public function postAction(Request $request)
    {
        $properties=Post::where('id', $request->post)->get('properties')[0]->properties;
        $actionEntry = Action::where('identifier', Auth::user()->id.$request->post)->first();
        if ($properties=='') {
            $properties=[];
            $properties["dislike"]=0;
            $properties["like"]=0;
            Post::where('id', $request->post)->update(array('properties' => json_encode($properties)));
            $properties=Post::where('id', $request->post)->get('properties')[0]->properties;
        }
        if ( $actionEntry===null ) {
            $action = new Action;
            $action->identifier=Auth::user()->id.$request->post;
            $action->user_id=Auth::user()->id;
            $action->post_id=$request->post;
            $action->save();
            $actionEntry = Action::where('identifier', Auth::user()->id.$request->post)->first();
        }
        if ($request->action == 0 && $actionEntry->liked == 0) {
            
            if($actionEntry->disliked == 1){$properties["dislike"]-=1;$this->undislikePost($properties,$actionEntry, $request);}
            return $this->likePost($properties,$actionEntry, $request);

        }elseif ($request->action == 0 && $actionEntry->liked == 1) {
            return $this->unlikePost($properties,$actionEntry, $request);

        } elseif ($request->action == 1 && $actionEntry->disliked == 0) {
            
            if($actionEntry->liked == 1){$properties["like"]-=1;$this->unlikePost($properties,$actionEntry, $request);}
            return $this->dislikePost($properties,$actionEntry, $request);
        } elseif ($request->action == 1 && $actionEntry->disliked == 1) {
            return $this->undislikePost($properties,$actionEntry, $request);
        }
    }

    public function likePost($properties,$actionEntry, $request){
        $properties["like"]+=1;
        Post::where('id', $request->post)->update(array('properties' => json_encode($properties)));
        Action::where('identifier', Auth::user()->id.$request->post)->update(array('liked' => 1));
        $properties["liked"]=true;
        return $properties;
    }

    public function unlikePost($properties,$actionEntry, $request){
        $properties["like"]-=1;
        Post::where('id', $request->post)->update(array('properties' => json_encode($properties)));
        Action::where('identifier', Auth::user()->id.$request->post)->update(array('liked' => 0));
        $properties["liked"]=false;
        return $properties;
    }

    public function dislikePost($properties,$actionEntry, $request){
        $properties["dislike"]+=1;
        Post::where('id', $request->post)->update(array('properties' => json_encode($properties)));
        Action::where('identifier', Auth::user()->id.$request->post)->update(array('disliked' => 1));
        $properties["disliked"]=true;
        return $properties;
    }

    public function undislikePost($properties,$actionEntry, $request){
        $properties["dislike"]-=1;
        Post::where('id', $request->post)->update(array('properties' => json_encode($properties)));
        Action::where('identifier', Auth::user()->id.$request->post)->update(array('disliked' => 0));
        $properties["disliked"]=false;
        return $properties;
    }

    

}
