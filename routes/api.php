<?php

use App\Models\Post;
use App\Models\User;
use App\Http\Controllers\PostsApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/posts/new', function (Request $request) {
    return $request->user()->posts()->create($request->only(['title', 'content']));
});

Route::get('/posts', function (Request $request) {
    return Post::with('user')->get();
});

//Route::get('/posts', [PostsApiController::class, 'index']);

//Route::post('/posts', [PostsApiController::class, 'store']);

//Route::put('/posts/{post}', [PostsApiController::class, 'update']);

//Route::delete('/posts/{post}', [PostsApiController::class, 'destroy']);

//Route::get('/content-reverse', [PostsApiController::class, 'reverseContent']);
