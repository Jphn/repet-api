<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Base Model
 * ---
 * The base model provides a space to set attributes
 * that are common to all models
 */
class Model extends \Leaf\Model
{
    use SoftDeletes;

    // You can define methods here that would be used
    // throughout your model classes
    // public function someMethod() {}
}
