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
        $posts = Post::all();

        return response()->json($posts);
    }
}
