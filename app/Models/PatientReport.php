<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientReport extends Model
{
    use HasFactory;
    protected $table = 'patient_reports';

    protected $fillable = ['patient_id', 'symptoms', 'predicted_disease'];

    protected $casts = [
        'symptoms' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id'); // 'patient_id' is the foreign key
    }

}
