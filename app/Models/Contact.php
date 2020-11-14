<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName', 'lastName', 'email', 'locality', 'population', 'area', 'phone', 'details'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
