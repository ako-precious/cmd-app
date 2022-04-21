<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
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

// Route::get('/posts', [PostController::class, 'index']);
// Route::post('/posts', [PostController::class, 'store']);
// Route::get('/posts/{$id}', [PostController::class, 'show']);


Route::post('/v1/register', [AuthController::class, 'register']);


Route::group(["middleware" => ['auth:sanctum']], function () {
    Route::resource('v1/posts', PostController::class);
    Route::resource('v1/categories', CategoryController::class);
    Route::post('/v1/logout', [AuthController::class, 'logout']);
    

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
