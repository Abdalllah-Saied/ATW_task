<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\StatsController;
use App\Http\Controllers\API\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::post('login',[UserController::class,'loginUser']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);

});

// Post Routes
//Route::middleware('auth:sanctum')->group(function () {
//    Route::get('/posts', [PostController::class, 'index']);
//    Route::post('/posts', [PostController::class, 'store']);
//    Route::get('/posts/{post}', [PostController::class, 'show']);
//    Route::put('/posts/{post}', [PostController::class, 'update']);
//    Route::delete('/posts/{post}', [PostController::class, 'destroy']);
//    Route::get('/deleted-posts', [PostController::class, 'deletedPosts']);
//    Route::put('/restore-deleted-post/{id}', [PostController::class, 'restoreDeletedPost']);
//});

// Stats Route
Route::middleware('auth:sanctum')->get('/stats', [StatsController::class, 'stats']);


// Job Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/run-daily-job', function () {
        dispatch(new \App\Jobs\ForceDeleteSoftDeletedPosts());
        return response()->json(['message' => 'Daily job dispatched successfully']);
    });

    Route::post('/run-hourly-job', function () {
        dispatch(new \App\Jobs\MakeHttpRequestAndLogResponse());
        return response()->json(['message' => 'Hourly job dispatched successfully']);
    });
});
