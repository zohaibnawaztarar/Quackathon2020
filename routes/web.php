<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/virusSim', function () {
    return view('virusSim');
});

Route::get('/login', function () {
    return view('login');
});

//standard route group
Route::group(['middleware' => ['web']], function () {
    Route::post('/register',[
        'uses' => 'UserController@postRegister',
        'as' => 'register'
    ]);

    Route::post('login', [
        'uses' => 'UserController@postLogin',
        'as' => 'login'
    ]);

    Route::get('/logout',[
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);
});
