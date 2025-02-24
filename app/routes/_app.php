<?php

use App\Middleware\AuthMiddleware;

app()->get('/', function () {
    response()->json(['message' => 'Bem vindo ao repet']);
});

app()->group('/users', function () {
    app()->apiResource('/', 'UsersController');
    app()->post('/login', 'UsersController@login');
    app()->post('/token', 'UsersController@token');
});

app()->group(
    '/models',
    function () {
        app()->get('/', 'PrintModelsController@index');
        app()->group('/', [
            'middleware' => AuthMiddleware::class,
            function () {
                app()->post('/', 'PrintModelsController@store');
                app()->post('/{id}/images', 'PrintModelsController@uploadImages');
                app()->get('/{id}', 'PrintModelsController@show');
                app()->put('/{id}', 'PrintModelsController@update');
                app()->delete('/{id}', 'PrintModelsController@destroy');
            }
        ]);
    }
);
