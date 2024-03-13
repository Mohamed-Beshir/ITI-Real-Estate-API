<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Properties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Auth;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Properties::all();
        return $properties;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {
        $user = Auth::user();

        // Validate the request
        $validatedData = $request->validated();

        // Assign the user_id to the property
        $validatedData['user_id'] = $user->id;

        // Create the property
        $property = Properties::create($validatedData);

        // Return the created property
        return $property;
    }

    /**
     * Display the specified resource.
     */
    public function show(Properties $property)
    {
        return $property;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Properties $property)
    {
        $user = Auth::user();

        if ($property->user_id !== $user->id) {
            return response()->json(['error' => 'You are not authorized to update this property.'], 403);
        }

        $property->update($request->validated());
        return $property;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Properties $property)
    {
        $user = Auth::user();

        if ($property->user_id !== $user->id) {
            return response()->json(['error' => 'You are not authorized to delete this property.'], 403);
        }

        $property->delete();
        return response()->json(['message' => 'Property deleted successfully']);
    }
}
