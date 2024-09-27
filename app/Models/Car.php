<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'year',
        'price',
        'status',
        'description',
        'front_view_image',
        'back_view_image',
        'left_view_image',
        'right_view_image',
        'interior_view_image'
    ];
}
