<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    // Récupérer la liste des catégories
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    // Récupérer une catégorie
    public function show($id)
    {
        $category = Category::find($id);

        return response()->json($category);
    }
}
