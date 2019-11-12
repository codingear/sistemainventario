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
// Guest Route
Route::get('/', function () {
    return view('front.index');
})->name('inicio');

// Shop Routes
Route::get('store', 'websiteController@shop')->name('store');
Route::get('inicio', 'websiteController@index')->name('home');


// Authentication Routes...
Auth::routes();

Route::group(
    [
        'prefix' => 'admin', 'namespace' => 'Admin',
        'middleware' => ['auth', 'CheckUserStatus']
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
        Route::match(['put', 'patch'], 'update_avatar', 'AdministratorController@updateAvatarAdministrator')->name('admin.updateAvatar');


        //Categorias
        Route::resource('categorias', 'CategoryController', [
            'except' => ['show'],
            'parameters' => [
                'categorias' => 'category',
            ],
        ]);
        Route::match(['put', 'patch'], 'admin/change_CategoryStatus/{id}', 'CategoryController@changeCategoryStatus')->name('admin.category.changeStatus');
        Route::get('all_categories','CategoryController@getCategories')->name('getcategories');

        //Productos
        Route::resource('productos', 'ProductController', [
            'parameters' => [
                'productos' => 'product',
            ],
        ]);
        Route::match(['put', 'patch'], 'admin/change_ProductStatus/{id}', 'ProductController@changeProductStatus')->name('admin.editProductStatus');
        Route::get('all_productos','ProductController@getProducts')->name('getproducts');

        //proveedores
        Route::resource('proveedores', 'ProviderController', [
            'parameters' => [
                'proveedores' => 'provider',
            ],
        ]);
        Route::get('all_providers','ProviderController@getProviders')->name('getproviders');

        //proveedores
        Route::resource('imagenes', 'ImageController', [
            'parameters' => [
                'imagenes' => 'image',
            ],
        ]);
    }
);
