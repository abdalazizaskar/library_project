<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['name' => 'Library App API', 'version' => 'v1', 'docs' => '/api/v1/books'];
});

Route::get('/health', fn () => response()->json(['status' => 'ok']));
