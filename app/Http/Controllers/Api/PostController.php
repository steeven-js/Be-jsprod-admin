<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog\Post;
use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    // Get all posts with their relationships and paginate them
    public function index()
    {
        $posts = Post::with('media', 'author.media', 'category', 'tags', 'comments')
            ->orderBy('created_at', 'desc')
            ->where('published_at', '!=', null)
            ->paginate(8);

        $categories = Category::all();

        return response()->json([
            'posts' => $posts,
            'categories' => $categories
        ]);
    }


    // Get a single post
    public function show($id)
    {
        $post = Post::with('media', 'author.media', 'category', 'tags', 'comments')
            ->where('published_at', '!=', null)
            ->find($id);

        return response()->json($post);
    }
}
