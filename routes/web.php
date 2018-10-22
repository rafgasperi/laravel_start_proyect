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

Route::get('/', array('as' => 'home', function()
{
    if(!Sentinel::check())
    {
        return view('login');
    }
    else
    {
        return redirect('dashboard');
    }

}));

Route::post('/login', array('as' => 'login','uses' => 'Auth\LoginController@login'));

Route::get('/recuperar_contrasena', array('as' => 'password_recovery', function()
{
    return view('sentinel.users.resend');
}));

Route::get('/logout', array('as' => 'sentinel.logout', function()
{
    Sentinel::logout();
    return redirect('/');
}));


Route::group(array('middleware' => 'sentinel.auth'), function() {

    Route::get('/dashboard', array('as' => 'dashboard','uses' => 'Controller@dashboard'));

    Route::group(array('prefix' => 'user'), function() {

        /* LISTA DE USUARIOS */
        Route::get('/', array('as' => 'user.index','uses' => 'UserController@index'))->middleware('hasAccess');
        /* CREACION USUARIOS */
        Route::get('/create', array('as' => 'user.create','uses' => 'UserController@create'))->middleware('hasAccess');
        /* CREANDO USUARIOS */
        Route::post('/', array('as' => 'user.store','uses' => 'UserController@store'))->middleware('hasAccess');
        /* DETALLE USUARIOS */
        Route::get('/{id}', array('as' => 'user.show','uses' => 'UserController@show'))->middleware('hasAccess');
        /* VER PERFIL USUARIO */
        Route::get('/{id}/profile', array('as' => 'user.perfil','uses' => 'UserController@perfil'))->middleware('hasAccess');
        /* EDICION USUARIOS */
        Route::get('/{id}/edit/', array('as' => 'user.edit','uses' => 'UserController@edit'))->middleware('hasAccess');
        /* EDITANDO USUARIOS */
        Route::put('/{id}/update', array('as' => 'user.update','uses' => 'UserController@update'))->middleware('hasAccess');
        /* ELIMINANDO USUARIOS */
        Route::delete('/{id}', array('as' => 'user.destroy','uses' => 'UserController@destroy'))->middleware('hasAccess');
        /* CAMBIAR CONTRASENA USUARIO */
        Route::put('{id}/change_password', array('as'=> 'user.change_password','uses'=>'UserController@updatePassword'))->middleware('hasAccess');
        /* SUBIR FOTO DE PERFIL */
        Route::put('{id}/subir_foto', array('as'=> 'user.subir_foto','uses'=>'UserController@subirFotoPerfil'))->middleware('hasAccess');
        /* ACTUALIZAR PERMISOS */
        Route::put('{id}/actualizar_permisos', array('as'=> 'user.permisos','uses'=>'UserController@actualizarPermisos'))->middleware('hasAccess');

    });

    Route::group(array('prefix' => 'role'), function() {

        /* LISTA DE ROLES */
        Route::get('/', array('as' => 'role.index','uses' => 'RolController@index'))->middleware('hasAccess');
        /* CREACION ROLES */
        Route::get('/create', array('as' => 'role.create','uses' => 'RolController@create'))->middleware('hasAccess');
        /* CREANDO ROLES */
        Route::post('/', array('as' => 'role.store','uses' => 'RolController@store'))->middleware('hasAccess');
        /* DETALLE ROLES */
        Route::get('/{id}', array('as' => 'role.show','uses' => 'RolController@show'))->middleware('hasAccess');
        /* EDICION ROLES */
        Route::get('/{id}/edit/', array('as' => 'role.edit','uses' => 'RolController@edit'))->middleware('hasAccess');
        /* EDITANDO ROLES */
        Route::put('/{id}/update', array('as' => 'role.update','uses' => 'RolController@update'))->middleware('hasAccess');
        /* ELIMINANDO ROLES */
        Route::delete('/{id}', array('as' => 'role.destroy','uses' => 'RolController@destroy'))->middleware('hasAccess');

    });
});