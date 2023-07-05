<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'patient_code',
        'first_name',
        'middle_name',
        'last_name',
        'contact',
        'email',
        'address',
        'birthdate',
        'age',
        'status'
    ];

    use HasFactory;
}
