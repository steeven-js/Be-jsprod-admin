<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Blog\Category;
use App\Http\Controllers\Controller;

class StudyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer toutes les catégories avec les relation study et studies.media et la pagination
        $categories = Category::with('studies', 'studies.media')->paginate(10);

        return response()->json($categories);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer une catégorie avec les relation study et studies.media
        $category = Category::with('studies', 'studies.media')->find($id);

        return response()->json($category);
    }
}
