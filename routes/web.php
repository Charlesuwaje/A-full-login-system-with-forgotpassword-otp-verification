<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\crudcontroller;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CodeCheckController;


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

Route::get('/', function () {
    return view('welcome');
});
// users
Route::get('workers-list',[crudcontroller::class,'index']);
Route::get('add-worker',[crudcontroller::class,'addworker']);
Route::post('save-worker',[crudcontroller::class,'saveWorker'])->name('save-worker');
Route::get('edit-worker/{id}',[crudcontroller::class,'editworker']);
Route::post('update-worker',[crudcontroller::class,'updateworker']);
route::get('delete-worker/{id}',[crudcontroller::class,'deleteworker']);
route::get('home',[crudcontroller::class,'Home']);

// login details
// Route::post('/forgetPassword',  AuthController::class);
// Route::post('/codecheck', CodeCheckController::class);
// Route::post('/passwordReset', CodeCheckController::class);

// Route::resource('edit-worker/{id}',[crudcontroller::class,'editworker']);
// Route::Post('saveworker',[crudcontroller::class,'savestudent']); 

