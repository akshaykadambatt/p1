<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use View;
use Response;
use Session;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function textPost(Request $request){
        $postContent = 'This is the post content. Enjoy!';
        $html = View::make('userlayout.component-post',['text'=>$postContent,'user'=>'username'])->render();
        return Response::json($html);
    }

    public function getPosts(Request $request){
        $posts = Post::with('user')->latest('created_at')->take($request->num)->get();
        $html='';
        $sentPosts = array();
            for($i=0;$i<count($posts);$i++){
                $html .= View::make('userlayout.component-post',[
                    'count'=>$i,
                    'id'=> $posts[$i]->id,
                    'user_id'=> $posts[$i]->user_id,
                    'message'=> $posts[$i]->message,
                    'type'=> $posts[$i]->type,
                    'properties'=> $posts[$i]->properties,
                    'created_at'=> $posts[$i]->created_at,
                    'user'=> $posts[$i]->user,
                    'new'=> 0
                    ])->render();
                array_push($sentPosts,$posts[$i]->id);
            }
            Session::put('sentPosts',$sentPosts);
            Session::put('lastRefreshedTime',Carbon::now()->toDateTimeString());
            return $html;
    }

    public function getNewPosts(Request $request){
        $posts = Post::with('user')->take($request->num)->where('created_at', '>=', Session::get('lastRefreshedTime'))->whereNotIn('id',Session::get('sentPosts'))->latest('created_at')->get();
        $html='';
        $sentPosts = Session::get('sentPosts');
            for($i=0;$i<count($posts);$i++){
            $html .= View::make('userlayout.component-post',[
                'count'=>$i,
                'id'=> $posts[$i]->id,
                'user_id'=> $posts[$i]->user_id,
                'message'=> $posts[$i]->message,
                'type'=> $posts[$i]->type,
                'properties'=> $posts[$i]->properties,
                'created_at'=> $posts[$i]->created_at,
                'user'=> $posts[$i]->user,
                'new'=> 1
                ])->render();
                array_push($sentPosts,$posts[$i]->id);
            }
            Session::put('sentPosts',$sentPosts);
            return $html;
    }

    public function storeTextPost(Request $request){
        $post = new Post;
        $post->user_id = $request->user_id;
        $post->message = $request->txt;
        $post->type = $request->type;
        $post->properties = '';
        $post->save();
        return Post::with('user')->get();
    }
}