<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use View;
use Response;

class HomeController extends Controller
{
    public function textPost(Request $request){
        $postContent = 'This is the post content. Enjoy!';
        $html = View::make('userlayout.component-post',['text'=>$postContent,'user'=>'username'])->render();

        return Response::json($html);
        // return Response::json(['html' => $html]);
    }
}