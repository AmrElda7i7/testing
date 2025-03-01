<?php 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/posts', function (Request $request) {
    $post = Post::create([
        'title' => $request->title,
    ]);

    return response()->json(['message' => 'Post created', 'post' => $post], 201);
});

Route::get('/posts', function () {
    $posts = Post::all();
    return response()->json($posts);
});

// Image Upload Route
Route::post('/upload', function ($request) { // No need to redefine Request
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $path = $request->file('image')->store('public/images'); 
    $url = Storage::url($path);

    return response()->json(['message' => 'Image uploaded successfully', 'url' => $url], 201);
});
