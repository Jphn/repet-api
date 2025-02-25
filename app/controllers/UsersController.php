<?php

namespace App\Controllers;

class UsersController extends Controller
{
    public function index()
    {
        return response()->json(
            (!auth()->user()
                ? auth()->errors()
                : auth()->user()->get()),
            !auth()->user() ? 406 : 200
        );
    }

    public function store()
    {
        if (!$data = request()->validate([
            'display_name' => 'string|min:3',
            'username' => 'username',
            'email' => 'email',
            'password' => 'string|min:8',
            'phone' => 'phone|min:14|max:14',
            'birthdate' => 'date',
            'registration' => 'optional|number|min:14|max:14',
        ])) {
            return response()->json(request()->errors(), 406);
        }

        $success = auth()->register($data);

        if (!$success) {
            return response()->json(auth()->errors(), 406);
        }

        return response()->json([
            'message' => 'User successfully created!',
        ], 201);
    }

    public function login()
    {
        if (!$data = request()->validate([
            'email' => 'email',
            'password' => 'string|min:8',
        ])) {
            return response()->json(request()->errors(), 406);
        }

        $success = auth()->login($data);

        if (!$success || auth()->user()->deleted_at) {
            return response()->json([
                'error' => 'Email or password is incorrect! Please try again.',
            ], 401);
        }

        return response()->json(auth()->user()->tokens(), 202);
    }
}
