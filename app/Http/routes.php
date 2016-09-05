<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return redirect('index');
});


// Authentication routes...
//Route::get('auth/login', 'Auth\AuthController@getLogin');
//Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Registration routes...
//Route::get('auth/register', 'Auth\AuthController@getRegister');
//Route::post('auth/register', 'Auth\AuthController@postRegister');

/*Password Reset*/
// Password reset link request routes...
Route::get('forgot', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::post('pass_recover', 'Auth\PasswordController@postEmail');
Route::post('pass_recover_auth', 'Auth\PasswordControllerAdmin@postEmail');
// Password reset routes...
Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset','Auth\PasswordController@postReset');

Route::get('login','FrontController@login');
//Route::get('forgot','FrontController@forgot');
Route::get('sitios','FrontController@checkSites');
Route::get('setSite/{id_site?}','FrontController@setSite');
Route::get('home','FrontController@index');
Route::get('file','FrontController@index');
Route::get('admin/file','FrontController@index');
Route::get('noticias/{id?}','FrontController@noticias');
Route::get('contacto','FrontController@contacto');
Route::get('micuenta','FrontController@cuenta');
Route::get('forgot_send/{email?}','FrontController@forgot_send');

Route::get('finanzas/{mes_sel?}/{year_sel?}', 'FrontController@finanzas');
Route::get('calendario/{mes_sel?}/{year_sel?}', 'FrontController@calendario');
Route::get('misitio','FrontController@miSitio');
Route::get('noticia_show/{id?}','NoticiaController@show');
Route::get('edit_info/{id?}','FrontController@edit_info');
Route::get('pagos_show','FrontController@pagos_show');
Route::put('update_info_user/{id?}','FrontController@update_info_user');
Route::get('edit_react/{id?}','UsuarioController@edit_react');
Route::post('change_pass/{id?}', 'FrontController@changePass');

Route::get('admin/checkEmail/{email?}','UsuarioController@checkEmail');
Route::post('admin/reactivar/{id?}','UsuarioController@reactivar');
Route::post('admin/asignar/{id?}','UsuarioController@asignar');
Route::get('admin/home','FrontController@admin');
Route::get('admin/administracion','FrontController@admin_modulo');
Route::get('admin/calendario/{mes_sel?}/{year_sel?}', 'FrontController@calendario');
Route::get('admin/finanzas/{mes_sel?}/{year_sel?}', 'FrontController@finanzas');
Route::get('admin/noticias','FrontController@noticias');
Route::get('admin/contenidos','FrontController@contenidos');
Route::get('admin/noticia_show/{id?}','NoticiaController@show');
Route::get('admin/usuarios/','FrontController@usuarios');
Route::get('admin/usuarios/search/{id?}','UsuarioController@search');
Route::post('admin/change_pass/{id?}', 'FrontController@changePass');
Route::resource('admin/cuotas','CuotasController');

Route::get('admin/usuarios/sort/{sort?}','UsuarioController@sort');
Route::get('admin/usuarios/sort_usr/{sort?}','UsuarioController@sort_usr');
Route::get('admin/usuarios/add/{id?}','UsuarioController@add');
Route::resource('admin/usuario/','UsuarioController');
Route::get('detalle_pagos/{id?}','PagosController@detalle');
Route::get('load','UsuarioController@loadData');
Route::post('sendPago/{id_pago?}','PagosController@sendPago');
Route::get('getUser/{id?}','UsuarioController@getUser');

Route::get('sendEmail/{id?}/{tipo?}','MailController@sendEmail');
Route::get('sendEmailMsg/{id?}','MailController@sendEmailMsg');
Route::get('eventos/{id?}','CalendarioController@edit');
Route::get('eventos_create','CalendarioController@store');

Route::resource('mail','MailController@contact');
Route::resource('sitio','SitesController');
Route::resource('sections','SectionsController');
Route::resource('noticia','NoticiaController');
Route::resource('utiles','UtilesController');
Route::resource('usuario','UsuarioController');
Route::resource('log','LogController');
Route::resource('pagos','PagosController');
Route::resource('egresos','EgresosController');
Route::resource('saldos','SaldosController');
Route::resource('cuotas','CuotasController');
Route::resource('eventos','CalendarioController');
Route::resource('documentos','DocumentosController');
Route::resource('credenciales','PaypalCredentialsController');

Route::get('logout','LogController@logout');
Route::get('controlador','PruebaController@index');
Route::get('name/{nombre}','PruebaController@nombre');
Route::resource('objeto','ObjetoController');  //php artisan make:controller ObjetoController


Route::get('prueba', function(){
	return "Hola desde routes.php";
});

Route::get('nombre/{nombre}', function($nombre){
	return "Mi nombre es ".$nombre;
});

Route::get('edad/{edad}', function($edad){
	return "Mi edad es ".$edad;
});

Route::get('edad2/{edad?}', function($edad = 20){
	return "Mi edad es ".$edad;
});

// Paypal

//Enviamos a PayPal

Route::get('pago/{type?}', array(
	'as' => 'pago',
	'uses' => 'PaypalController@postPayment',
));

// Paypal redirecciona a esta ruta
Route::get('payment/status', array(
	'as' => 'payment.status',
	'uses' => 'PaypalController@getPaymentStatus',
));
