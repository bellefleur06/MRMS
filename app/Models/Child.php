<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = 'child';

    protected $fillable = [
        'mothers_name',
        'last_name',
        'first_name',
        'middle_name',
        'gender',
        'birthdate',
        'weight',
        'height'
    ];

    use HasFactory;
}
