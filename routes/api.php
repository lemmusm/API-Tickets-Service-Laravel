<?php

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
Route::resource('usuarios', 'UsuarioController');
// route resource para tickets
Route::resource('tickets', 'TicketController');

// get data ticket filter for dashboard
Route::get('lastTickets/filtertickets', 'TicketController@filtertickets');
Route::get('graphs/gtickets', 'TicketController@gtickets');
Route::get('graphs/gservicios', 'TicketController@gservicios');
Route::get('graphs/gticketsareas', 'TicketController@gticketsareas');
Route::get('graphs/totaltickets', 'TicketController@totaltickets');
// Get data cutrimestres
Route::get('cuatrimestre/statusbydates', 'TicketController@statusbydates');
