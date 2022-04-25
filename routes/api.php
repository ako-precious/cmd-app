<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ChangePasswordController;
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


 Route::group([
    'middleware' => ['XSS'],
    'prefix' => 'v1'
    ], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('resetpasswordlink', [PasswordResetRequestController::class, 'sendEmail']);
    Route::post('resetPassword', [ChangePasswordController::class, 'passwordReset']);
    
});

Route::group([
    "middleware" => ['auth:sanctum'],
    'prefix' => 'v1'
], function () {
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    

});


Route::middleware('auth:sanctum')->get('/v1/user', function (Request $request) {
    return $request->user();
});
