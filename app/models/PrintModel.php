<?php

namespace App\Models;

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
}
