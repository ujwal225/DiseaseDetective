<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';
    protected $fillable = ['patient_id', 'doctor_id', 'appointment_date', 'appointment_time', 'status', 'note'];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function token(): HasOne
    {
        return $this->hasOne(Token::class);
    }
}
