<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AlbumController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function() {
    Route::post('login',[LoginController::class,'login']);
    Route::get('logout',[LoginController::class,'logout'])->middleware('auth:sanctum');
    Route::post('register',[RegisterController::class,'register']);
});

Route::group(['prefix'=>'album'], function(){
   Route::get('/',[AlbumController::class,'index'])->name('album.index');
   Route::post('/',[AlbumController::class,'store'])->name('album.store');
   Route::get('/{id}',[AlbumController::class,'show'])->name('album.show');
   Route::delete('/{id}',[AlbumController::class,'destroy'])->name('album.destroy');
   Route::put('/{id}',[AlbumController::class,'update'])->name('album.update');
});
