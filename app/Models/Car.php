<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'production_year',
        'license_plate',
        'color',
        'seats',
        'price',
        'description',
        'status',
        'image',
    ];
}
