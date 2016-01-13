<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return redirect()->route('inicio');
});

// Authentication


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', 'Auth\AuthController@getLogin')->name('login');
        Route::post('/login', 'Auth\AuthController@postLogin')->name('login');
        Route::get('/logout', 'Auth\AuthController@getLogout')->name('logout');
    });

    Route::get('/home', 'MainController@index')->name('inicio');

    Route::group(['prefix' => 'grupos'], function () {
        Route::get('/', 'GrupoController@index')->name('grupos');
        Route::get('/nuevo', 'GrupoController@nuevo')->name('grupos_nuevo');
        Route::get('/editar/{id}', 'GrupoController@editar')->name('grupos_editar');
        Route::post('/', 'GrupoController@guardar')->name('grupos_guardar');

        //Api
        Route::group(['prefix' => 'api'], function () {
          Route::resource('/', 'ApiGrupoController', ['only' => ['index', 'show']]);
          Route::get('/hijos/{padre_id}', 'GrupoController@hijos')->name('grupos_hijos');
        });
    });

    Route::group(['prefix' => 'productos'], function () {
        Route::get('/', 'ProductoController@index')->name('productos');
        Route::get('/nuevo', 'ProductoController@nuevo')->name('productos_nuevo');
        Route::get('/getdata', 'ProductoController@getdata')->name('productos_getdata');
        Route::get('/editar/{id}', 'ProductoController@editar')->name('productos_editar');
        Route::post('/', 'ProductoController@guardar')->name('productos_guardar');

        //Api
        Route::group(['prefix' => 'api'], function () {
          Route::resource('/', 'ApiProductoController', ['only' => ['index', 'show']]);
          Route::get('/existe/{codigo}', 'ProductoController@existe')->name('productos_existe');
        });
    });

    Route::group(['prefix' => 'clientes'], function () {
        Route::get('/', 'UserController@index')->name('clientes');
        Route::get('/getdata', 'UserController@getdata')->name('clientes_getdata');
        Route::get('/nuevo', 'UserController@nuevo')->name('clientes_nuevo');
        Route::get('/editar/{id}', 'UserController@editar')->name('clientes_editar');
        Route::post('/', 'UserController@guardar')->name('clientes_guardar');

        //Api
        Route::group(['prefix' => 'api'], function () {
          Route::resource('/', 'ApiUserController', ['only' => ['index', 'show']]);
        });
    });

    Route::group(['prefix' => 'vendedores'], function () {
        Route::get('/getdata', 'VendedorController@getdata')->name('vendedores_getdata');        
    });

    Route::group(['prefix' => 'proveedores'], function () {
        Route::get('/', 'ProveedorController@index')->name('proveedores');
        Route::get('/nuevo', 'ProveedorController@nuevo')->name('proveedores_nuevo');
        Route::get('/editar/{id}', 'ProveedorController@editar')->name('proveedores_editar');
        Route::post('/', 'ProveedorController@guardar')->name('proveedores_guardar');

        //Api
        Route::group(['prefix' => 'api'], function () {
          Route::resource('/', 'ApiProveedorController', ['only' => ['index', 'show']]);
        });
    });

    Route::group(['prefix' => 'entradas'], function () {
        Route::get('/', 'EntradaController@index')->name('entradas');
        Route::get('/nuevo', 'EntradaController@nuevo')->name('entradas_nuevo');
        Route::post('/', 'EntradaController@guardar')->name('entradas_guardar');

        //Api
        Route::group(['prefix' => 'api'], function () {
            Route::post('/agregar', 'ApiEntradaController@postAdd')->name('entradas_post_add');
            Route::post('/flete', 'ApiEntradaController@postFlete')->name('entradas_post_flete');
            Route::get('/detalle/{id}', 'ApiEntradaController@getDetalle')->name('entradas_detalle');
            Route::get('/detalle/eliminar/{id}', 'ApiEntradaController@getDelDetalle')->name('entradas_eliminar_detalle');
            Route::get('/', 'ApiEntradaController@getAll')->name('entradas_api');
            Route::get('/{fecha_inicial}/{fecha_final}/{proveedor}', 'ApiEntradaController@search')->name('entradas_busqueda');
        });
    });

    Route::group(['prefix' => 'facturas'], function () {
        Route::get('/', 'FacturaController@index')->name('facturas');
        Route::get('/nuevo', 'FacturaController@nuevo')->name('facturas_nuevo');
        Route::post('/', 'FacturaController@guardar')->name('facturas_guardar');

        //Api
        Route::group(['prefix' => 'api'], function () {
            Route::post('/agregar', 'ApiFacturaController@postAdd')->name('facturas_post_add');
            Route::get('/detalle/{id}', 'ApiFacturaController@getDetalle')->name('facturas_detalle');
            Route::get('/detalle/eliminar/{id}', 'ApiFacturaController@getDelDetalle')->name('facturas_eliminar_detalle');
            Route::get('/', 'ApiFacturaController@getAll')->name('facturas_api');
        });
    });

    Route::group(['prefix' => 'informes'], function () {
        Route::get('/entradas', 'InformeController@entradasIndex')->name('informes_entradas');
    });

    Route::group(['prefix' => 'colores'], function () {
        //Api
        Route::group(['prefix' => 'api'], function () {
          Route::resource('/', 'ApiColoresController', ['only' => ['index', 'show']]);
        });
    });

    Route::group(['prefix' => 'ciudades'], function () {
        //Api
        Route::group(['prefix' => 'api'], function () {
          Route::get('/{estado_id}', 'ApiCiudadController@index')->name('ciudades');
        });
    });

});
