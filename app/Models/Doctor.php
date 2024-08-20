<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'doctors';
    protected $fillable = ['user_id','certificate','experience', 'description', 'specialization', 'location', 'is_approved' ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
