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
// DEPARTAMENTOS
// route resource para departamentos
Route::resource('departamentos', 'DepartamentoController');
// get data ticket filter for dashboard
Route::get('completeDepartamentos', 'DepartamentoController@getCompleteDepartamentos');
// USUARIOS
// route resource para usuarios
Route::resource('usuarios', 'UsuarioController');
// Get complete user data
Route::get('usuarios/getCompleteUser/{id}', 'UsuarioController@getCompleteUser');
// TICKETS
// route resource para tickets
Route::resource('tickets', 'TicketController');
// get data ticket filter for dashboard
Route::get('lastTickets/filtertickets', 'TicketController@filtertickets');
// Grafica tickets
Route::get('estadisticas/infoTickets', 'TicketController@infoTickets');
// Trae total de tickets
Route::get('estadisticas/totaltickets', 'TicketController@totaltickets');
// Get data from range date cutrimestres
Route::get('estadisticas/indicadores', 'TicketController@indicadores');
// ROLES
// Get data from roles
Route::resource('roles', 'RolesController');
// UBICACIONES
// route resource para tickets
Route::resource('ubicaciones', 'UbicacionController');
//SERVICIOS
// route resource para tickets
Route::resource('servicios', 'ServicioController');
