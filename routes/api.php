<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\TaskGetController;
use App\Http\Controllers\Task\TaskPostController;
use App\Http\Controllers\Task\TaskDeleteController;
use App\Http\Controllers\Category\CategoriesGetController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::prefix('categories')->group(function(){
    Route::get('/', [CategoriesGetController::class, '__invoke']);
});
Route::prefix('tasks')->group(function(){
    Route::post('/', [TaskPostController::class, '__invoke']);
    Route::get('/', [TaskGetController::class, '__invoke']);
    Route::delete('/{id}', [TaskDeleteController::class, '__invoke'])->whereUuid('id');
});