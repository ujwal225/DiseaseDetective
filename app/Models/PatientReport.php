<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientReport extends Model
{
    use HasFactory;
    protected $table = 'patient_reports';

    protected $fillable = ['patient_id', 'symptoms', 'predicted_disease'];

    protected $casts = [
        'symptoms' => 'array',
    ];

}
