<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
    protected $table = 'immunization';

    protected $fillable = [
        'name',
        'age',
        'immunization_type',
        'immunization_date',
        'remarks',
    ];

    use HasFactory;
}
