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
Route::post('/upload', function (Request $request) { // Ensure Request is used correctly
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $path = $request->file('image')->store('public/images'); 
    $url = Storage::url($path);

    return response()->json(['message' => 'Image uploaded successfully', 'url' => $url], 201);
});



Route::get('/images/{filename}', function ($filename) {
    $disk = Storage::disk(env('FILESYSTEM_DISK', 'public')); // Use configured storage disk

    if (!$disk->exists("images/{$filename}")) {
        return response()->json(['error' => 'Image not found'], 404);
    }

    return response()->json(['url' => $disk->url("images/{$filename}")]);
});

