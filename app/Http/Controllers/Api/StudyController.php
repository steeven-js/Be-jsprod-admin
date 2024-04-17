<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog\Study;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog\Category;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer la liste des études
        $studies = Study::with('author', 'category', 'media')
            ->orderBy('created_at', 'desc')
            ->where('published_at', '!=', null)
            ->get();

        $categories = Category::all();

        // Retourner la liste des études
        return response()->json([
            'studies' => $studies,
            'categories' => $categories
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Réccupérer l'étude
        $study = Study::with('author', 'category', 'media')
            ->where('published_at', '!=', null)
            ->find($id);

        // Retourner l'étude
        return response()->json($study);
    }
}
