<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property_rent;
use App\Models\Rent_payment;

class Rent_offer extends Model
{
    protected $fillable = ['buyer_id', 'property_rent_id', 'offered_price', 'message', 'status'];
    protected $table = 'rents_offers';
    use HasFactory;

    public function property_rent()
    {
        return $this->belongsTo(Property_rent::class);
    }

    public function rent_payment()
    {
        return $this->belongsTo(Rent_payment::class);
    }
}
