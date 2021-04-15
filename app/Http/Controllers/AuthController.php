<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\AuthenticateLoginAttempt;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
// use Laravel\Fortify\Http\Requests\LoginRequest;
use App\Providers\FortifyServiceProvider;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
class AuthController extends Controller
{
    public function register(Request $request){
        return ((new CreateNewUser)->create($request->all()));
    }
}