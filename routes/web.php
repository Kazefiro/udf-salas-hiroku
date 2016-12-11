<?php

Route::get('/','IndexController@index');

Route::group(['prefix'=>'sala'], function (){
    Route::get('/','SalaController@index');
    Route::get('create','SalaController@create');
    Route::get('edit/{id}','SalaController@edit');
    Route::put('update/{id}','SalaController@update');
    Route::post('store','SalaController@store');
    Route::get('delete/{id}','SalaController@destroy');
    Route::post('/import','SalaController@import');
});

Route::group(['prefix'=>'reserva'], function (){
    Route::get('/','ReservaController@index');
    Route::get('create','ReservaController@create');
    Route::get('edit/{id}','ReservaController@edit');
    Route::put('update/{id}','ReservaController@update');
    Route::post('store','ReservaController@store');
    Route::get('delete/{id}','ReservaController@destroy');
});


Route::group(['prefix'=>'oferta'], function (){
    Route::get('/','OfertaController@index');
    Route::get('/edit/{id}','OfertaController@edit');
    Route::get('/delete/{id}','OfertaController@destroy');
    Route::put('/update/{id}','OfertaController@update');
    Route::post('/import','OfertaController@import');
    Route::get('/export','OfertaController@export');
});

Route::group(['prefix'=>'ensalamento'], function (){
    Route::get('/show/{id}','EnsalamentoController@mostrarOferta');
    Route::get('/matutino','EnsalamentoController@matutino');
    Route::get('/noturno','EnsalamentoController@noturno');
    Route::get('/vespertino','EnsalamentoController@vespertino');
    Route::get('/gerar','EnsalamentoController@gerarEnsalamento');
});



Auth::routes();

