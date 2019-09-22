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
// Route Front
Route::get('/', function () {
    return view('front.index');
})->name('inicio');

// Authentication Routes...
Auth::routes();

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ],
    function () {

        //Dashboard
        //Route::get('/', 'DashboardController@index')->name('dashboard');

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //Usuarios
        Route::resource('usuarios', 'UserController', [
            'parameters' => [
                'usuarios' => 'user',
            ]
        ]);

        //Route::get('usuarios/perfil', 'UserController@userProfile')->name('perfil');
    }
);
