<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PrintModel extends Model
{

    protected $fillable = [
        'name',
        'description',
        'cost',
        'credits',
        'private',
        'approved',
        'folder',
    ];

    protected $hidden = [
        'folder'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
