<?php

use App\Http\Controllers\Frontend\Api\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix'=>'v1','middleware'=>['checkapiheader','cors']],function(){
    Route::post('auth/registration',[IndexController::class,'index']);
    Route::get('session',[IndexController::class,'index2']);


    // Route::post('auth/login',[IndexController::class,'login']);
});
