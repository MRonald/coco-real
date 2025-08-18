<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'user_id',
        'document',
        'history',
        'nature',
        'value',
        'competence',
        'due_date',
        'nf_issue',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
