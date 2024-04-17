<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // Get all posts with their relationships and paginate them
    public function index()
    {
        $posts = Post::with('media', 'author.media', 'category', 'tags', 'comments')
            ->orderBy('created_at', 'desc')
            ->where('status', 'published')
            ->paginate(8);

        return response()->json($posts);
    }


    // Get a single post
    public function show($id)
    {
        $post = Post::with('media', 'author.media', 'category', 'tags', 'comments')
            ->where('status', 'published')
            ->find($id);

        return response()->json($post);
    }
}
