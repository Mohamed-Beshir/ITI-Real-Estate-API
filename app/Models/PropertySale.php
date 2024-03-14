<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySale extends Model
{
    use HasFactory;

    protected $table = 'property_sales';

    protected $fillable = [
        'property_id', 'lister_id', 'price', 'updated_price'
    ];
}
