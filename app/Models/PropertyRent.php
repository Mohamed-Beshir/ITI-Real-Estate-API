<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRent extends Model
{
    use HasFactory;

    protected $table = 'property_rents';

    protected $fillable = [
        'property_id', 'lister_id', 'period', 'price', 'updated_price'
    ];
}
