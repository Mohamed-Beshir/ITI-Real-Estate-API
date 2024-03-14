<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Rent_offer;

class Rent_payment extends Model
{
    protected $fillable = ['rents_offer_id', 'transaction_id', 'status'];
    protected $table = 'rents_payments';
    use HasFactory;

    // public function property_rent()
    // {
    //     return $this->belongsTo(Property_rent::class);
    // }

    // public function rent_payment()
    // {
    //     return $this->belongsTo(Rent_payment::class);
    // }
}
