<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AlbumController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\ImageManipulationController;

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
   Route::get('/{album}',[AlbumController::class,'show'])->name('album.show');
   Route::delete('/{album}',[AlbumController::class,'destroy'])->name('album.destroy');
   Route::put('/{album}',[AlbumController::class,'update'])->name('album.update');
});

Route::group(['prefix'=>'imagem'], function(){
    Route::get('/',[ImageManipulationController::class,'index'])->name('imagem.index');
    Route::get('/',[ImageManipulationController::class,'show'])->name('imagem.show');
    Route::get('/por-album/{album}',[ImageManipulationController::class,'porAlbum'])->name('imagem.index');
    Route::post('/resize',[ImageManipulationController::class,'resize'])->name('imagem.resize');
    Route::delete('/{imagem}',[ImageManipulationController::class,'destroy'])->name('imagem.show');
 });
