<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent_offer;
use Illuminate\Support\Facades\Response;
use App\Mail\SendMail;
use Mail;


class RentOfferController extends Controller
{
    public function acceptOffer($id)
    {
        $offer = Rent_offer::findOrFail($id);
        $offer->status = 'accepted';
        $offer->save();
        $buyer_name = $offer->buyer->name;
        $buyer_email = $offer->buyer->email;
        $propertyTitle = $offer->propertyRent->property->title;
        $mailData = [
            'title' => 'Mail from BAZAR',
            'body_1' => 'Your offer for ',
            'body_2' => $propertyTitle,
            'body_3' => ' has been accepted.',
            'buyer_name' => $buyer_name,
            'property_title' => $propertyTitle
        ];
        Mail::to($buyer_email)->send(new SendMail($mailData));
        return Response::json(['message' => 'Offer accepted successfully']);
    }


    public function rejectOffer($id)
    {
        $offer = Rent_offer::findOrFail($id);
        $offer->status = 'rejected';
        $offer->save();
        $buyer_name = $offer->buyer->name;
        $buyer_email = $offer->buyer->email;
        $propertyTitle = $offer->propertyRent->property->title;
        $mailData = [
            'title' => 'Mail from BAZAR',
            'body_1' => 'Your offer for ',
            'body_2' => $propertyTitle,
            'body_3' => ' has been rejected.',
            'buyer_name' => $buyer_name,
            'property_title' => $propertyTitle
        ];
        Mail::to($buyer_email)->send(new SendMail($mailData));
        return Response::json(['message' => 'Offer rejected successfully']);
    }
}
