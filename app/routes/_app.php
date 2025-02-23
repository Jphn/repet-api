<?php

app()->get('/', function () {
    response()->json(['message' => 'Bem vindo ao repet']);
});

app()->group('/users', function () {
    app()->apiResource('/', 'UsersController');
    app()->post('/login', 'UsersController@login');
    app()->post('/token', 'UsersController@token');
});

app()->group('/models', function () {
    app()->apiResource('/', 'PrintModelsController');
});
