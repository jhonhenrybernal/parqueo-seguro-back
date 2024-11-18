<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $table = 'parkings';

    // Campos que pueden ser llenados en la base de datos
    protected $fillable = [
        'name',
        'legal_representative',
        'address',
        'is_covered',
        'levels',
        'spaces',
        'image',
        'total_cars',
        'total_bikes',
        'total_combined',
    ];

    // Decodificar automáticamente el JSON de spaces
    protected $casts = [
        'spaces' => 'array',
    ];
}
