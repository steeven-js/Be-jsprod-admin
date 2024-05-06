<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMail;
use Illuminate\Http\Request;

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
        $this->validate($request, [
            'budget' => 'required|array|size:2',
            'budget.*' => 'required|numeric',
            'compnany' => 'required|min:8',
            'email' => 'required|email|unique:contact_mails,email',
            'firstName' => 'required|min:2',
            'lastName' => 'required|min:2',
            'message' => 'required|min:8',
            'phoneNumber' => 'required|min:8',
            'services' => 'required|array',
            'services.*' => 'required|in:Technology,Marketing,Design,Photography,Art',
            'website' => 'required|url',
        ]);

        // Création d'un nouveau contact mail
        $contactMail = ContactMail::create([
            'budget_min' => $request->budget[0],
            'budget_max' => $request->budget[1],
            'compnany' => $request->compnany,
            'email' => $request->email,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'message' => $request->message,
            'phoneNumber' => $request->phoneNumber,
            'website' => $request->website,
        ]);

        // Attachement des services au contact mail
        $contactMail->services()->attach($request->services);

        // Retourne les informations du nouveau contact mail en format JSON
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
