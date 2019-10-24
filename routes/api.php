<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', 'CategoryController@indexJson');


Route::get('/teste', 'CategoryController@testeDeAsync');

Route::resource('/products', 'ProductController');
