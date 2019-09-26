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

        Route::get('/', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //Administradores
        Route::resource('administradores', 'AdministratorController', [
            'except' => ['show'],
            'parameters' => [
                'administradores' => 'user',
            ],
        ]);

        //Editar Datos Administrador
        Route::match(['put', 'patch'], 'admin/change_UserStatus/{id}', 'AdministratorController@changeUserStatus')->name('admin.editAdminStatus');
        Route::get('mi-perfil', 'ShowAdminProfile')->name('admin.profile');
        Route::get('editar-perfil', 'AdministratorController@editAdminProfile')->name('admin.editProfile');
        Route::match(['put', 'patch'], 'admin/edit_profile/{user}', 'AdministratorController@updateAdminProfile')->name('admin.updateAdminProfile');




        //Categorias
        Route::resource('categorias', 'CategoryController', [
            'except' => ['show'],
            'parameters' => [
                'categorias' => 'category',
            ],
        ]);
        Route::match(['put', 'patch'], 'admin/change_CategoryStatus/{id}', 'CategoryController@changeCategoryStatus')->name('admin.category.changeStatus');

        //Productos
        Route::resource('productos', 'ProductController', [
            // 'except' => ['show'],
            'parameters' => [
                'productos' => 'product',
            ],
        ]);
    }
);
