<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrintModel extends Model
{
    public function generateFolderName()
    {
        $this->folder = time() . '_' . $this->name . '_' . bin2hex(random_bytes(8));
    }

    protected $fillable = [
        'name',
        'description',
        'cost',
        'credits',
        'private',
        'approved',
        'folder',
    ];

    protected $attributes = [
        'private' => false
    ];

    protected $hidden = [
        'folder',
        'user_id',
        'user'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'private' => 'boolean'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
