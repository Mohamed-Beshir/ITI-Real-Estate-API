<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Rent_offer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\Rent_offerRequest;
use App\Http\Requests\Rent_offerUpdateRequest;

class Rent_offerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offer = Rent_offer::all();
        return $offer;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(/* Rent_offerRequest */ Request  $request)
    {
        
        
        // $validatedRequest = $request->validated();
        // Rent_offer::create($validatedRequest);

        // $validatedRequest = $request->validate([
        //     'buyer_id' => 'required|numeric',
        //     'property_rent_id' => 'required|numeric|unique:rents_offers',
        //     'offered_price' => 'required|numeric',
        //     'message' => 'string'
        // ]);

        $validatedRequest = Validator::make($request->all(), [
            'buyer_id' => 'required|numeric',
            'property_rent_id' => 'required|numeric|unique:rents_offers',
            'offered_price' => 'required|numeric',
            'message' => 'string'
        ]);
        if($validatedRequest->fails()){
            $errors = $validatedRequest->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }

        Rent_offer::create($request->all());

        // Rent_offer::create([
        //     'buyer_id' => $request->buyer_id,
        //     'property_rent_id' => $request->property_rent_id,
        //     'offered_price' => $request->offered_price,
        //     'message' => $request->message
        // ]);
    
        return response()->json(['message' => 'Data saved successfully'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rent_offer $offer)
    {
        return $offer;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(/* Rent_offerUpdateRequest */ Request   $request, Rent_offer $offer)
    {
        // $validatedRequest = $request->validate([
        //     'offered_price' => 'required|numeric',
        //     'message' => 'string',
        // ]);

        // $validatedRequest = $request->validated();
        // return $rent_offer->update($validatedRequest);


        $validatedRequest = Validator::make($request->all(), [
            'offered_price' => 'required|numeric',
            'message' => 'string'
        ]);
        if($validatedRequest->fails()){
            $errors = $validatedRequest->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
        $rent_offer->update($request->all());
        return response()->json(['message' => 'Data updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rent_offer $offer)
    {
        $offer->delete();
        return 'Delete';
    }
}
