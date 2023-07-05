<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenatal extends Model
{
    protected $table = 'prenatal';

    protected $fillable = [
        'patient_code',
        'patient_name',
        'prenatal_schedule',
        'nurse_midwife',
        'blood_pressure',
        'weight',
        'tummy_size',
        'status',
        'remarks'
    ];

    use HasFactory;
}
