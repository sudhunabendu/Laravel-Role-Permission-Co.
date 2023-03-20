<?php

use App\Http\Controllers\Administrator\IndexController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/', function () {
//     });

//     Route::get('/users', function () {
//         // handle the admin user list
//     });
// });


Route::get('/',[IndexController::class, 'index'])->name('dashboard');
Route::post('/postlogin',[IndexController::class, 'login'])->name('post.login');
Route::get('/login',[IndexController::class, 'createLogin'])->name('login');
Route::get('/role',[IndexController::class, 'createRole'])->name('create.role');
Route::post('/make_role',[IndexController::class, 'makeRole'])->name('store.role');
// Route::get('/logout',[IndexController::class, 'logout'])->name('logout');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');



// Route::group(function () {
//     Route::prefix('/')->group(function () {
//         Route::get('dashboard', [IndexController::class, 'index'])->name('admin.dashboard');
//         // Route::get('/settings', [IndexController::class, 'settings'])->name('admin.settings');
//     });
// });


