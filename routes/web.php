<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
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

/* 
Verb	    URI	                    Action	    Route Name
GET	        /photos	                index	    photos.index
GET	        /photos/create	        create	    photos.create
POST	    /photos	                store	    photos.store
GET	        /photos/{photo}	        show	    photos.show
GET	        /photos/{photo}/edit	edit	    photos.edit
PUT/PATCH	/photos/{photo}	        update	    photos.update 
*/

// Route::resource(['photos' => 'photoController']); 하게되면 위에 처럼 route:list가 적용된다(Route:resource의 활용)

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('main');
})->name('main');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('/register/create', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/userinfo', [UserController::class, 'show'])->name('userinfo.show');
Route::get('/userinfo/picDelete', [UserController::class, 'picDelete'])->name('userinfo.picDelete');
Route::get('/userinfo/{id}/delete', [UserController::class, 'delete'])->name('userinfo.delete');
Route::post('/userinfo', [UserController::class, 'store'])->name('userinfo.store');
Route::PATCH('/userinfo/{id}', [UserController::class, 'update'])->name('userinfo.update');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
