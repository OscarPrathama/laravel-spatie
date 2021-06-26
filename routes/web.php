<?php

// use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::get('products/export', 'ProductController@exportToExcel')->name('products.export');
    Route::get('products/api', 'ProductController@productAPI')->name('products.api');
    Route::resource('products', ProductController::class);
    Route::get('posts/api', 'PostController@postsAPI')->name('posts.api');
    Route::resource('posts', PostController::class);
});
