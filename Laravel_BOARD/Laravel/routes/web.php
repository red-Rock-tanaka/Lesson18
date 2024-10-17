<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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


// Route::get('hello',function(){
//     echo 'Hello Would!!';
// });

Route::get('hello',[PostsController::class,'hello']);

Route::get('index', [PostsController::class, 'index']);

Route::get('/create-form', [PostsController::class, 'createForm']);

Route::post('post/create', [PostsController::class, 'create'])->name('post.create');

Route::get('post/{id}/update-form', [PostsController::class, 'updateForm']);

Route::post('post/update', [PostsController::class, 'update'])->name('post.update');

Route::get('post/{id}/delete', [PostsController::class, 'delete'])->name('post.delete');

Auth::routes();

Route::get('/home', function(){
    return view('auth.login');
})->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts/search', [PostsController::class, 'search'])->name('posts.search');
