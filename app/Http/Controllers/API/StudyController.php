<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog\Study;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer la liste des études
        $studies = Study::with('author', 'category', 'media')->get();

        // Retourner la liste des études
        return response()->json($studies);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Réccupérer l'étude
        $study = Study::find($id);

        // Retourner l'étude
        return response()->json($study);
    }
}
