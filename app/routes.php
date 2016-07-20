<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//filtro rutas
//Entrust::routeNeedsRole('ListaOpex', 'superadmin', Redirect::to('/'));
Route::get('/crear-rol','UsuarioController@CrearRoles');

//LOGIN
Route::get('/login','UsuarioController@getLogin');
Route::get('/','UsuarioController@getLogin');
Route::post('/','UsuarioController@postLogin');

/************ RUTA CMA ***************/

//INDEX
Route::group(array('before' => 'auth'), function()
{
    Route::group(array('prefix' => 'admin'), function(){
        Route::get('/home','UsuarioController@Home');

        //ADMINISTRACIÓN
        Route::get('/administracion/lista','AdministracionController@ListarAdministracion');
        Route::get('/administracion/crear', 'AdministracionController@GetCrearAdministracion');
        Route::post('/admnistracion/crear', 'AdministracionController@PostCrearAdministracion');
        Route::any('/administracion/crud', 'AdministracionController@CrudAdministracion');

        //login logout
        Route::get('/LoginUsuario','UsuarioController@LoginUsuarioGet');
        Route::get('/auth/logout','UsuarioController@CerrarSesionGet');

        //Roles
        Route::get('/asignarol/{id}','UsuarioController@AsignarRolGet');
        Route::post('/asignarol','UsuarioController@AsignarRolPost');
        Route::get('/CrearRoles','UsuarioController@CrearRoles');
        Route::get('/searchuser', 'UsuarioController@getUsuarioList');

        //recaudación
        Route::get('/recaudaciones/lista', 'RecaudacionController@ListaRecaudaciones');
        Route::any('/recaudaciones/crear', 'RecaudacionController@CrudRecaudaciones');
        Route::any('/recaudaciones/edit', 'RecaudacionController@CrudRecaudaciones');

        //sucursales
        Route::get('/sucursales/lista', 'SucursalesController@ListaSucursales');
        Route::any('/sucursales/crear', 'SucursalesController@CrudSucursales');
        Route::any('/sucursales/edit', 'SucursalesController@CrudSucursales');

        //Gastos
        Route::get('/gastos/lista/{recaudacion_id}', 'GastosController@ListaGastos');
        Route::any('/gastos/{recaudacion_id}/crear', 'GastosController@CrudGastos');
        Route::any('/gastos/{recaudacion_id}/edit', 'GastosController@CrudGastos');

        //Proveedores
        Route::get('/proveedores/lista', 'ProveedorController@ListaProveedores');
        Route::any('/proveedores/crear', 'ProveedorController@CrudProveedores');
        Route::any('/proveedores/edit', 'ProveedorController@CrudProveedores');

        //Productos
        Route::get('/productos/lista', 'ProductosController@ListaProductos');
        Route::any('/productos/crear', 'ProductosController@CrudProductos');
        Route::any('/productos/edit', 'ProductosController@CrudProductos');
    });
});




