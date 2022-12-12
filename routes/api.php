<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CodeCheckController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// $router->get('/',function()
// return response()-jason('wel')
// });
// Route::group([
// 'prefix'=>'auth'
// ],function(){
// Route::post('login','AuthController@login'):
// Route::post('register','AuthController@register');
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('login','AuthController@login'):
// Route::post('register','AuthController@register');

Route::post('/register', [AuthController::class, 'register']);  
Route::post('/login', [AuthController::class, 'login']);
Route::post('/passwordReset', [CodeCheckController::class, 'passwordReset']);
Route::post('/ResetPasswordOpt', [AuthController::class, 'PasswordResetOpt']);
Route::post('/codecheck', [CodeCheckControler::class, 'codecheck']);
Route::post('/forgetPassword', [AuthController::class, 'forgetPassword']);




