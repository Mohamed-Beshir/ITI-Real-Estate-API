<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;
    protected $fillable =["user_id","title","city","district","street","type","description","status","area","beds","baths"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
