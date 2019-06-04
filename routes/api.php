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

// USUARIOS
    // route resource para usuarios
    Route::resource('usuarios', 'UsuarioController');
    // Get filter user data
    Route::get('usuarios/filterdata/{id}', 'UsuarioController@getFilterUserData');
    // Actualización de displayName y photoURL
    Route::put('usuarios/updateDisplayName/{id}', 'UsuarioController@updateDisplayName');

// TICKETS
    // route resource para tickets
    Route::resource('tickets', 'TicketController');
    // get data ticket filter for dashboard
    Route::get('lastTickets/filtertickets', 'TicketController@filtertickets');
    // Grafica tickets
    Route::get('estadisticas/statistics', 'TicketController@statistics');
    // Route::get('graphs/gtickets', 'TicketController@gtickets');
    // // Grafica servicios
    // Route::get('graphs/gservicios', 'TicketController@gservicios');
    // // Grafica tickets por área
    // Route::get('graphs/gticketsareas', 'TicketController@gticketsareas');
    // Trae total de tickets
    Route::get('graphs/totaltickets', 'TicketController@totaltickets');
    // Get data from range date cutrimestres
    Route::get('cuatrimestre/statusbydates', 'TicketController@statusbydates');

// ROLES
    // Get data from roles
    Route::resource('roles', 'RolesController');
    // Get filter roles
    Route::get('rol/filterrol', 'RolesController@filterrol');
