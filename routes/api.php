<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    // route resource para departamentos
    Route::resource('departamentos', 'DepartamentoController');
    // route resource para usuarios
    Route::resource('usuarios', 'usuarioController');
    // route resource para tickets
    Route::resource('tickets', 'TicketController');