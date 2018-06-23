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

// <-- Servicios -->
    
Route::get('/admin/servicios', 'ServiceController@index')->name('services.index');

Route::get('/admin/servicios/nuevo', 'ServiceController@create')->name('services.create');

Route::post('/admin/servicios', 'ServiceController@store');

Route::get('/admin/servicios/{id}/editar', 'ServiceController@edit')->name('services.edit');

Route::put('/admin/servicios/{service}', 'ServiceController@update');

Route::delete('/admin/servicios/{service}', 'ServiceController@delete')->name('services.delete');

// <-- Productos -->
    
Route::get('/admin/productos', 'ProductController@index')->name('products.index');

Route::post('/admin/productos/filtro', 'ProductController@filter');

Route::get('/admin/productos/nuevo', 'ProductController@create')->name('products.create');

Route::post('/admin/productos', 'ProductController@store');

Route::get('/admin/productos/{id}/editar', 'ProductController@edit')->name('products.edit');

Route::put('/admin/productos/{product}', 'ProductController@update');

Route::delete('/admin/productos/{product}', 'ProductController@delete')->name('products.delete');

// <-- Categorias de productos -->
    
Route::get('/admin/categorias', 'ProductCategoryController@index')->name('categories.index');

Route::get('/admin/categorias/nueva', 'ProductCategoryController@create')->name('categories.create');

Route::post('/admin/categorias', 'ProductCategoryController@store');

Route::get('/admin/categorias/{id}/editar', 'ProductCategoryController@edit')->name('categories.edit');

Route::put('/admin/categorias/{category}', 'ProductCategoryController@update');

Route::delete('/admin/categorias/{category}', 'ProductCategoryController@delete')->name('categories.delete');

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

Route::get('/admin/control/gastos/mercaderias', 'ControlController@gastos')->name('control.gastos.mercaderias');

Route::post('/admin/control/gastos/limpieza', 'ControlController@historial_gastos');

Route::post('/admin/control/gastos/servicios', 'ControlController@historial_gastos');

Route::post('/admin/control/gastos/mercaderias', 'ControlController@historial_gastos');

// Control.Ingresos

Route::get('/admin/control/ingresos/productos', 'ControlController@ordenes')->name('control.ingresos.productos');

Route::get('/admin/control/ingresos/servicios', 'ControlController@ordenes')->name('control.ingresos.servicios');

Route::post('/admin/control/ingresos/productos', 'ControlController@store_orden');

Route::post('/admin/control/ingresos/servicios', 'ControlController@store_orden');
//---DESCUENTO en ORDEN---//
Route::post('/admin/control/productos/descuento/{id_order}', 'ControlController@descuento_orden');
Route::post('/admin/control/servicios/descuento/{id_order}', 'ControlController@descuento_orden');
//-----------FIN----------//
//---CERRAR ORDEN---//
Route::post('/admin/control/productos/cerrar/{id_order}', 'ControlController@cerrar_orden');
Route::post('/admin/control/servicios/cerrar/{id_order}', 'ControlController@cerrar_orden');
//-----------FIN----------//
Route::get('/admin/control/ingresos/productos/{id_order}', 'ControlController@subordenes')->name('control.ingresos.productos.agregar');

Route::get('/admin/control/ingresos/servicios/{id_order}', 'ControlController@subordenes')->name('control.ingresos.servicios.agregar');

Route::post('/admin/control/ingresos/productos/{id_order}', 'ControlController@store_suborden');

Route::post('/admin/control/ingresos/servicios/{id_order}', 'ControlController@store_suborden');

// Control.Sueldos

Route::get('/admin/control/sueldos/empleados', 'ControlController@sueldos')->name('control.sueldos.empleados');

Route::post('/admin/control/sueldos/empleados', 'ControlController@historial_sueldos_all');

Route::get('/admin/control/sueldos/empleados/{nombre}', 'ControlController@historial_sueldos_one')->name('control.sueldos.empleado');

Route::post('/admin/control/sueldos/empleados/{nombre}', 'ControlController@historial_sueldo');

// <-- Usuarios -->
    
Route::get('/admin/{type}s', 'UserController@index')->name('users.index');

Route::get('/admin/{type}s/nuevo', 'UserController@create')->name('users.create');

Route::post('/admin/{type}s', 'UserController@store');

Route::get('/admin/{type}s/{nombre}', 'UserController@show')->name('users.show'); // ID por USER

Route::get('/admin/{type}s/{nombre}/editar', 'UserController@edit')->name('users.edit');

Route::put('/admin/{type}s/{user}', 'UserController@update')->name('users.update');

Route::delete('/admin/{type}s/{user}', 'UserController@delete')->name('users.delete');