<?php

use App\Http\Controllers\API\AdApiController;
use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\TagApiController;
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

#### Categories
Route::prefix('v1/categories')->group(function (){
    Route::get('list', [CategoryApiController::class, 'list'])->name('categories.list');
    Route::post('create', [CategoryApiController::class, 'create'])->name('categories.create');
    Route::get('details/{id}', [CategoryApiController::class, 'details'])->name('categories.details');
    Route::put('update/{id}', [CategoryApiController::class, 'update'])->name('categories.update');
    Route::delete('delete/{id}', [CategoryApiController::class, 'delete'])->name('categories.delete');
});

#### Tags
Route::prefix('v1/tags')->group(function (){
    Route::get('list', [TagApiController::class, 'list'])->name('tags.list');
    Route::post('create', [TagApiController::class, 'create'])->name('tags.create');
    Route::get('details/{id}', [TagApiController::class, 'details'])->name('tags.details');
    Route::put('update/{id}', [TagApiController::class, 'update'])->name('tags.update');
    Route::delete('delete/{id}', [TagApiController::class, 'delete'])->name('tags.delete');
});

#### Ads
Route::prefix('v1/ads')->group(function (){
    Route::get('list/{advertiser_id}', [AdApiController::class, 'list'])->name('ads.list');
});
