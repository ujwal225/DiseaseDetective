<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use mysql_xdevapi\Table;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'patients';
    protected $fillable = ['user_id','date_of_birth','gender','address'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
