<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //takes a request obj and posts a new user to the DB
    public function postRegister(Request $request)
    {
        //get the vars from the request
        $email = $request['reg_email'];
        $name = $request['name'];
        $password = bcrypt($request['reg_password']); //hash the password with bcrypt

        //create new user and set attributes
        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;

        $user->save(); //save to DB

        //log new user in
        Auth::login($user);

        return redirect('welcome');
    }

    public function postLogin(Request $request)
    {
        //attempt to log user in
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
            return redirect('welcome');
        }
        return redirect()->route('login');
    }

    //log user out & redirect
    public function getLogout()
    {
        Auth::logout();
        return redirect('login');
    }
}
