<?php

namespace App\Controllers;

class UsersController extends Controller
{
    public function index()
    {
        response()->json([
            'message' => 'UsersController@index output'
        ]);
    }

    public function store()
    {
        $success = auth()->register(request()->body());

        if (!$success)
            return response()->json(auth()->errors(), 406);

        return response()->json([
            'message' => 'User successfully created!'
        ], 201);
    }

    public function login()
    {
        $success = auth()->login(request()->body());

        if (!$success)
            return response()->json([
                'error' => 'Email or password is incorrect! Please try again.'
            ], 401);

        return response()->json(auth()->user()->tokens(), 202);
    }

    public function token()
    {
        dd(auth()->user());
    }
}
