<?php

namespace App\Http\Controllers\API;

use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // Get all posts
    public function index()
    {
        $posts = Post::with('media', 'author.media', 'category', 'tags', 'comments')->get();

        return response()->json($posts);
    }

    // Get a single post
    public function show($id)
    {
        $post = Post::with('media', 'author.media', 'category', 'tags', 'comments')->find($id);

        return response()->json($post);
    }
}
