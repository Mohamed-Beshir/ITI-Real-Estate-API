<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Rent_offer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\Rent_offerRequest;
use App\Http\Requests\Rent_offerUpdateRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Rent_offerResource;
use Illuminate\Support\Facades\DB;


class Rent_offerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $offer = Rent_offer::all();
        // return Rent_offerResource::collection($offer);
        $rentsOffers = DB::table('rents_offers')
                    ->select(
                        'rents_offers.offered_price',
                        'rents_offers.message',
                        'users.email as buyer_email',
                        'properties.title',
                        'rents_offers.status',
                        'users.name as buyer_name',
                        'rents_offers.id'
                    )
                    ->join('users', 'rents_offers.buyer_id', '=', 'users.id')
                    ->join('properties', 'rents_offers.property_rent_id', '=', 'properties.id')
                    ->get();

    return response()->json(['rentsOffers' => $rentsOffers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Rent_offerRequest $request)
    {


        $validatedRequest = $request->validated();
        Rent_offer::create($validatedRequest);

        // $validatedRequest = $request->validate([
        //     'buyer_id' => 'required|numeric',
        //     'property_rent_id' => 'required|numeric|unique:rents_offers',
        //     'offered_price' => 'required|numeric',
        //     'message' => 'string'
        // ]);

        // $validatedRequest = Validator::make($request->all(), [
        //     'buyer_id' => 'required|numeric',
        //     'property_rent_id' => 'required|numeric|unique:rents_offers',
        //     'offered_price' => 'required|numeric',
        //     'message' => 'string'
        // ]);
        // if($validatedRequest->fails()){
        //     $errors = $validatedRequest->errors()->all();
        //     return response()->json(['errors' => $errors], 422);
        // }

        // Rent_offer::create($request->all());

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
        return new Rent_offerResource($offer);
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

        $validatedRequest = $request->validated();


        // $validatedRequest = Validator::make($request->all(), [
        //     'property_rent_id' => ['numeric',Rule::unique('rents_offers')->ignore($offer->id),],
        //     'offered_price' => 'required|numeric',
        //     'message' => 'string',
        //     'status' => 'string'
        // ]);
        // if($validatedRequest->fails()){
        //     $errors = $validatedRequest->errors()->all();
        //     return response()->json(['errors' => $errors], 422);
        // }

        $offer->update($request->all());
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
