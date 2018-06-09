<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/admin', 'AdminController@admin')    
    ->middleware('is_admin')    
    ->name('admin');

// <-- Socios -->
    
Route::get('/admin/socios', 'UserController@index')->name('users.index');

Route::get('/admin/socios/nuevo', 'UserController@create')->name('users.create');

Route::post('/admin/socios', 'UserController@store');

Route::get('/admin/socios/{id}', 'UserController@show')->name('users.show');

Route::get('/admin/socios/{user}/editar', 'UserController@edit')->name('users.edit');

Route::put('/admin/socios/{user}', 'UserController@update');

Route::delete('/admin/socios/{user}', 'UserController@delete')->name('users.delete');

// <-- Profesores -->
    
Route::get('/admin/profesores', 'TrainerController@index')->name('trainers.index');

Route::get('/admin/profesores/nuevo', 'TrainerController@create')->name('trainers.create');

Route::post('/admin/profesores', 'TrainerController@store');

Route::get('/admin/profesores/{id}', 'TrainerController@show')->name('trainers.show');

Route::get('/admin/profesores/{id}/editar', 'TrainerController@edit')->name('trainers.edit');

Route::put('/admin/profesores/{trainer}', 'TrainerController@update');

Route::delete('/admin/profesores/{trainer}', 'TrainerController@delete')->name('trainers.delete');

// <-- Servicios -->
    
Route::get('/admin/servicios', 'ServiceController@index')->name('services.index');

Route::get('/admin/servicios/nuevo', 'ServiceController@create')->name('services.create');

Route::post('/admin/servicios', 'ServiceController@store');

Route::get('/admin/servicios/{id}', 'ServiceController@show')->name('services.show');

Route::get('/admin/servicios/{id}/editar', 'ServiceController@edit')->name('services.edit');

Route::put('/admin/servicios/{service}', 'ServiceController@update');

Route::delete('/admin/servicios/{service}', 'ServiceController@delete')->name('services.delete');

// <-- Control -->
    
Route::get('/admin/control/', 'ControlController@inicio')->name('control.caja.inicio');

Route::get('/admin/control/caja/inicio', 'ControlController@inicio')->name('control.caja.inicio');

Route::get('/admin/control/caja/ingresos', 'ControlController@ingresos')->name('control.caja.ingresos');

Route::post('/admin/control/caja/ingresos', 'ControlController@historial_ingresos');

Route::post('/admin/control/caja/ingresos/{nombre}', 'ControlController@historial_ingreso');

Route::get('/admin/control/caja/cierre/', 'ControlController@cierre')->name('control.caja.cierre');

Route::post('/admin/control/', 'ControlController@store');

Route::get('/admin/control/caja/retiros', 'ControlController@retiros')->name('control.caja.retiros');

Route::post('/admin/control/caja/retiros', 'ControlController@historial_retiros');

// Control.Gastos

Route::get('/admin/control/gastos/limpieza', 'ControlController@gastos')->name('control.gastos.limpieza');

Route::get('/admin/control/gastos/servicios', 'ControlController@gastos')->name('control.gastos.servicios');

Route::post('/admin/control/gastos/limpieza', 'ControlController@historial_gastos');

Route::post('/admin/control/gastos/servicios', 'ControlController@historial_gastos');

// Control.Sueldos

Route::get('/admin/control/sueldos/profesores', 'ControlController@sueldos')->name('control.sueldos.profesores');

Route::get('/admin/control/sueldos/otros', 'ControlController@sueldos')->name('control.sueldos.otros');

Route::post('/admin/control/sueldos/profesores', 'ControlController@historial_sueldos_all');

Route::post('/admin/control/sueldos/otros', 'ControlController@historial_sueldos_all');


Route::get('/admin/control/sueldos/profesores/{nombre}', 'ControlController@historial_sueldos_one')->name('control.sueldos.profesor');

Route::get('/admin/control/sueldos/otros', 'ControlController@historial_sueldos_one')->name('control.sueldos.otros');

//Route::post('/admin/control/sueldos/profesores/{nombre}', 'ControlController@historial_sueldo');

//Route::post('/admin/control/sueldos/otros', 'ControlController@historial_sueldos');

// nande (prueba commit)
