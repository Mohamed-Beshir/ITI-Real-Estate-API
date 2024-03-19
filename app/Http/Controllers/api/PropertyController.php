<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PropertyRequest;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderBy = $request->input('order_by');

        if($orderBy == 'Highest_area') {
            $properties = Property::orderBy('area', "desc")->get();
        } else if ($orderBy == 'Lowest_area') {
            $properties = Property::orderBy('area', "asc")->get();
        }else {
            $properties = Property::all();
        }

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
        // $validatedData['user_id'] = $user->id;

        // Create the property
        $property = Property::create($validatedData);

        // Return the created property
        return $property;
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return $property;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyRequest $request, Property $property)
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
    public function destroy(Property $property)
    {
        $user = Auth::user();

        if ($property->user_id !== $user->id) {
            return response()->json(['error' => 'You are not authorized to delete this property.'], 403);
        }

        $property->delete();
        return response()->json(['message' => 'Property deleted successfully']);
    }

    // public function search(Request $request)
    // {
    //     $city = $request->input('city');
    //     $district = $request->input('district');
    //     $propertyType = $request->input('propertyType');
    //     $status = $request->input('status');
    //     $area = $request->input('area');
    //     $beds = $request->input('beds');
    //     $baths = $request->input('baths');
    //     $price = $request->input('price');

    //     $query = Property::query();

    //     if ($city) {
    //         $query->where('city', 'like', "%$city%");
    //     }

    //     if ($district) {
    //         $query->where('district', 'like', "%$district%");
    //     }

    //     if ($propertyType) {
    //         $query->where('type', 'like', "%$propertyType%");
    //     }

    //     if ($status) {
    //         $query->where('status', $status);
    //     }

    //     if ($area) {
    //         $query->where('area', '>', $area);
    //     }        

    //     if ($beds) {
    //         $query->where('beds', $beds);
    //     }

    //     if ($baths) {
    //         $query->where('baths', $baths);
    //     }

    //     if ($price) {
    //         $query->whereHas('sales', function ($salesQuery) use ($price) {
    //             $salesQuery->where('price', '>=', $price);
    //         })->orWhereHas('rents', function ($rentsQuery) use ($price) {
    //             $rentsQuery->where('price', '>=', $price);
    //         });
    //     }

    //     $properties = $query->get();
    
    //     return response()->json($properties);
    // }

    public function search(Request $request)
{
    $city = $request->input('city');
    $district = $request->input('district');
    $propertyType = $request->input('propertyType');
    $status = $request->input('status');
    $area = $request->input('area');
    $beds = $request->input('beds');
    $baths = $request->input('baths');
    $price = $request->input('price');

    $query = Property::query();

    // Apply price condition
    if ($price) {
        $query->where(function ($subQuery) use ($price) {
            $subQuery->whereHas('sales', function ($salesQuery) use ($price) {
                $salesQuery->where('price', '>=', $price);
            })->orWhereHas('rents', function ($rentsQuery) use ($price) {
                $rentsQuery->where('price', '>=', $price);
            });
        });
    }

    // Apply other filters
    if ($city) {
        $query->where('city', 'like', "%$city%");
    }

    if ($district) {
        $query->where('district', 'like', "%$district%");
    }

    if ($propertyType) {
        $query->where('type', 'like', "%$propertyType%");
    }

    if ($status) {
        $query->where('status', $status);
    }

    if ($area) {
        $query->where('area', '>', $area);
    }        

    if ($beds) {
        $query->where('beds', $beds);
    }

    if ($baths) {
        $query->where('baths', $baths);
    }

    // Get the properties matching the criteria
    $properties = $query->get();

    return response()->json($properties);
}

}
