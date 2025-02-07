<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/posts', function (Request $request) {


    $post = Post::create([
        'title' => $request->title,
    ]);

    return response()->json(['message' => 'post created', 'post' => $post], 201);
});  // Create an article
Route::get('/posts', function () {
    $posts = Post::all();
    return response()->json($posts);
});  // Create an article
