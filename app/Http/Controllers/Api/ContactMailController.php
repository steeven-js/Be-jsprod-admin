<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactMailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'company' => 'required|string',
            'email' => 'required|email',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'message' => 'nullable|string',
            'phoneNumber' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        // Création d'un nouveau contact de messagerie
        $contactMail = ContactMail::create([
            'company' => $validatedData['company'],
            'email' => $validatedData['email'],
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'message' => $validatedData['message'],
            'phoneNumber' => $validatedData['phoneNumber'],
            'website' => $validatedData['website'],
        ]);

        // Retourne les informations du nouveau contact de messagerie au format JSON
        return response()->json($contactMail, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
