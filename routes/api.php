<?php

use App\Http\Controllers\Apis\ProductController;
use App\Http\Controllers\Apis\SubcategoryController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'products'],function(){
    Route::get('/',[ProductController::class,'index']);
    Route::get('/create',[ProductController::class,'create']);
    Route::get('/edit/{id}',[ProductController::class,'edit']);
    Route::post('/store',[ProductController::class,'store']);
    Route::post('/update/{id}',[ProductController::class,'update']);
    Route::post('/destroy/{id}',[ProductController::class,'destroy']);
});

Route::group(['prefix'=>'subcategories'],function(){
    Route::get('/',[SubcategoryController::class,'index']);
    Route::get('/create',[SubcategoryController::class,'create']);
    Route::get('/edit/{id}',[SubcategoryController::class,'edit']);
    Route::post('/store',[SubcategoryController::class,'store']);
    Route::post('/update/{id}',[SubcategoryController::class,'update']);
    Route::post('/destroy/{id}',[SubcategoryController::class,'destroy']);
});