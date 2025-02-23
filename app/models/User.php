<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'display_name',
        'username',
        'email',
        'phone',
        'birthdate',
        'registration',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * @var array
     */
    protected $hidden = [
        'password',
        'email_verification_token',
        'email_verification_expires'
    ];

    /**
     * Indicates if the model should be timestamped.
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        // 'email_verification_expires' => 'datetime',
        'birthdate' => 'date',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'points' => 0,
    ];

    public function printModels(): HasMany
    {
        return $this->hasMany(PrintModel::class);
    }
}
