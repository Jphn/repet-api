<?php

namespace App\Middleware;

use Leaf\Middleware;

class AuthMiddleware extends Middleware
{
    public function call()
    {
        if (!auth()->user() || auth()->user()->deleted_at) {
            $response = !auth()->user() && auth()->errors() !== []
                ? auth()->errors()
                : ['error' => 'Invalid access token!'];

            return response()->exit($response, 401);
        }
    }
}
