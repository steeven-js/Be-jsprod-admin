<?php

namespace App\Http\Controllers\Api;

use Spatie\Tags\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    // Récupérer tous les tags
    public function index()
    {
        $tags = Tag::all();

        return response()->json($tags);
    }

    // Récupérer un tag
    public function show($id)
    {
        $tag = Tag::find($id);

        return response()->json($tag);
    }
}
