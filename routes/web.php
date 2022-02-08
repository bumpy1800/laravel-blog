<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('main');

//로그인 관련 라우팅
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');

//name()으로 라우트이름앞에 register.을 붙히고 prefix()로 URL앞에 /register/를 붙힌다
//회원가입 관련 라우팅
Route::name('register.')->prefix('register')->group(function () {
    Route::get('/create', [RegisterController::class, 'create'])->name('create');
    Route::post('/', [RegisterController::class, 'store'])->name('store');
});

//middleware()으로 group()안에 있는 모든 라우팅에게 middleware()안에 인증을 적용한다
//name()으로 라우트이름앞에 register.을 붙히고 prefix()로 URL앞에 /register/를 붙힌다
//내정보 관련 라우팅
Route::middleware(['auth'])->name('userinfo.')->prefix('userinfo')->group(function () {
    Route::get('/', [UserController::class, 'show'])->name('show');
    Route::get('/picDelete', [UserController::class, 'picDelete'])->name('picDelete');
    Route::delete('/{id}/delete', [UserController::class, 'delete'])->name('delete');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::PATCH('/{id}', [UserController::class, 'update'])->name('update');
});

//비번찾기 관련 라우팅
Route::get('/forgot-password', [UserController::class, 'forgotPasswordNotice'])->name('forgot-password');
Route::get('/forgot-password/{token}', [UserController::class, 'changePassword'])->name('changePassword');
Route::post('/forgot-password', [UserController::class, 'forgotPasswordValidate'])->name('forgot-password');
Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('update-password');

//포스팅 관련 라우팅(auth미들웨어를 컨트롤러에서 설정함)
Route::resource('/posts', PostController::class);
Route::post('/uploads', [PostController::class, 'uploadImage'])->name('posts.upload'); //ckeditor 이미지업로드
Route::get('/search', [PostController::class, 'search'])->name('posts.search');

//댓글 대댓글 관련 라우팅
Route::middleware(['auth', 'verified'])->name('comment.')->prefix('comment')->group(function () {
    Route::post('/', [CommentController::class, 'store'])->name('store');
    Route::PATCH('/{comment}', [CommentController::class, 'update'])->name('update');
    Route::delete('/{comment}/delete', [CommentController::class, 'delete'])->name('delete');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
