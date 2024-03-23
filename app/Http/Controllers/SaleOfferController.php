<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale_offer;
use Illuminate\Support\Facades\Response;


class SaleOfferController extends Controller
{
    public function acceptOffer($id)
    {
        $offer = Sale_offer::findOrFail($id);
        $offer->status = 'accepted';
        $offer->save();

        return Response::json(['message' => 'Offer accepted successfully']);
    }

    /**
     * Reject the specified sales offer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectOffer($id)
    {
        $offer = Sale_offer::findOrFail($id);
        $offer->status = 'rejected';
        $offer->save();

        return Response::json(['message' => 'Offer rejected successfully']);
    }
}
