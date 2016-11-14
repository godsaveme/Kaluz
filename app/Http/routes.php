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

\Debugbar::disable();

Route::get('/', 'Layout\LayoutController@index');

Route::get('/login', function () {
    return view('login');
});

Route::group(['middleware' => ['role','cashier']], function () {
    Route::get('/VEROLE', function () {
        return 'se ve el role';
    });
});

 
Route::get('/test', function() {
    event(new \Salesfly\Events\SomeEvent());
    return 'event fired';
});

Route::get('/vista-redis', function() {
   return view('test');
});

Route::get('status', function(){
    return response('holi', 422)
        ->header('Content-Type', 'text/html; charset=UTF-8');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::group(['middleware' => 'role'], function () {
    Route::get('users/create', ['as' => 'user_create', 'uses' => 'Auth\AuthController@indexU']);
    Route::get('users/edit/{id?}', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@indexU']);
    Route::get('users/form-create', ['as' => 'user_form_create', 'uses' => 'Auth\AuthController@form_create']);
    Route::get('users/form-edit', ['as' => 'user_form_edit', 'uses' => 'Auth\AuthController@form_edit']);
    Route::get('users', ['as' => 'user', 'uses' => 'Auth\AuthController@indexU']);
});
    Route::get('api/users/all', ['as' => 'user_all', 'uses' => 'Auth\AuthController@all']);
    Route::get('api/users/paginate/', ['as' => 'user_paginate', 'uses' => 'Auth\AuthController@paginate']);

    Route::post('api/users/create', ['as' => 'user_create', 'uses' => 'Auth\AuthController@postRegister']);
    Route::put('api/users/edit', ['as' => 'user_edit', 'uses' => 'Auth\AuthController@edit']);
    Route::post('api/users/destroy', ['as' => 'user_destroy', 'uses' => 'Auth\AuthController@destroy']);
    Route::get('api/users/search/{q?}', ['as' => 'user_search', 'uses' => 'Auth\AuthController@search']);
    Route::get('api/users/find/{id}', ['as' => 'user_find', 'uses' => 'Auth\AuthController@find']);
    Route::get('api/users/stores', ['as' => 'user_stores_select', 'uses' => 'Auth\AuthController@store_select']);
    Route::get('api/users/disableuser/{id}', ['as' => 'user_disabled', 'uses' => 'Auth\AuthController@disableuser']);
    Route::post('api/users/changePass', 'Auth\AuthController@changePass');
//END

//PERSONS ROUTES
    Route::get('persons', ['as' => 'person', 'uses' => 'PersonsController@index']);
    Route::get('persons/create', ['as' => 'person_create', 'uses' => 'PersonsController@index']);
    Route::get('persons/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PersonsController@index']);
    Route::get('persons/form-create', ['as' => 'person_form_create', 'uses' => 'PersonsController@form_create']);
    Route::get('persons/form-edit', ['as' => 'person_form_edit', 'uses' => 'PersonsController@form_edit']);
    Route::get('api/persons/all', ['as' => 'person_all', 'uses' => 'PersonsController@all']);
    Route::get('api/persons/paginate/', ['as' => 'person_paginate', 'uses' => 'PersonsController@paginatep']);
    Route::post('api/persons/create', ['as' => 'person_create', 'uses' => 'PersonsController@create']);
    Route::put('api/persons/edit', ['as' => 'person_edit', 'uses' => 'PersonsController@edit']);
    Route::post('api/persons/destroy', ['as' => 'person_destroy', 'uses' => 'PersonsController@destroy']);
    Route::get('api/persons/search/{q?}', ['as' => 'person_search', 'uses' => 'PersonsController@search']);
    Route::get('api/persons/find/{id}', ['as' => 'person_find', 'uses' => 'PersonsController@find']);
//END PERSONS ROUTES

Route::group(['middleware' => 'role-cashier'], function () {
//CUSTOMERS ROUTES
    Route::get('customers',['as'=>'person','uses'=>'CustomersController@index']);
    Route::get('customers/create',['as'=>'person_create','uses'=>'CustomersController@index']);
    Route::get('customers/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CustomersController@index']);
    Route::get('customers/form-create',['as'=>'person_form_create','uses'=>'CustomersController@form_create']);
    Route::get('customers/form-edit',['as'=>'person_form_edit','uses'=>'CustomersController@form_edit']);
    Route::get('api/customers/all',['as'=>'person_all', 'uses'=>'CustomersController@all']);
    Route::get('api/customers/paginate/',['as' => 'person_paginate', 'uses' => 'CustomersController@paginatep']);
    Route::post('api/customers/create',['as'=>'person_create', 'uses'=>'CustomersController@create']);
    Route::put('api/customers/edit',['as'=>'person_edit', 'uses'=>'CustomersController@edit']);
    Route::post('api/customers/destroy',['as'=>'person_destroy', 'uses'=>'CustomersController@destroy']);
    Route::get('api/customers/search/{q?}',['as'=>'person_search', 'uses'=>'CustomersController@search']);
    Route::get('api/customers/find/{id}',['as'=>'person_find', 'uses'=>'CustomersController@find']);
    Route::get('api/customersVenta/search/{q?}',['as'=>'person_search', 'uses'=>'CustomersController@searchVenta']);
    Route::get('api/ComprobarDatos/find/{q?}',['as'=>'person_search', 'uses'=>'CustomersController@ComprobarDatos']);
//END CUSTOMERS ROUTES
});
Route::group(['middleware' => 'role-asistant'], function () {
//PRODUCTS ROUTES
    Route::get('products', ['as' => 'product', 'uses' => 'ProductsController@index']);
    Route::get('products/create', ['as' => 'product_create', 'uses' => 'ProductsController@index']);
    Route::get('products/edit/{id?}', ['as' => 'product_edit', 'uses' => 'ProductsController@index']);
    Route::get('products/form-create', ['as' => 'product_form_create', 'uses' => 'ProductsController@form_create']);
    Route::get('products/form-edit', ['as' => 'product_form_edit', 'uses' => 'ProductsController@form_edit']);
});
    Route::get('api/products/all', ['as' => 'product_all', 'uses' => 'ProductsController@all']);
    Route::get('api/products/paginate/', ['as' => 'product_paginate', 'uses' => 'ProductsController@paginate']);
    Route::get('api/products/pag', ['as' => 'prod_pag', 'uses' => 'ProductsController@pag']);
    Route::get('api/consultCodigo/find/{id}', ['as' => 'prod_pag', 'uses' => 'ProductsController@consultCodigo']);
    Route::post('api/products/create', ['as' => 'product_create', 'uses' => 'ProductsController@create']);
    Route::put('api/products/edit', ['as' => 'product_edit', 'uses' => 'ProductsController@edit']);
    Route::post('api/products/destroy', ['as' => 'product_destroy', 'uses' => 'ProductsController@destroy']);
    Route::get('api/products/disableprod/{id}', ['as' => 'product_disabled', 'uses' => 'ProductsController@disableprod']);



Route::get('api/products/search/{q?}',['as'=>'product_search', 'uses'=>'ProductsController@search']);
Route::get('api/productName/search/{q?}',['as'=>'product_search', 'uses'=>'ProductsController@searchProducts']);
Route::get('api/productaddVariant/search/{q?}',['as'=>'product_search', 'uses'=>'ProductsController@searchProductAddVariant']);

Route::get('api/products/find/{id}',['as'=>'person_find', 'uses'=>'ProductsController@find']);
Route::get('api/products/brands',['as' => 'products_brands_select','uses' => 'ProductsController@brands_select']);
Route::get('api/products/materials',['as' => 'products_materials_select','uses' => 'ProductsController@materials_select']);
Route::get('api/products/types',['as' => 'products_types_select','uses' => 'ProductsController@types_select']);
Route::get('api/products/stations',['as' => 'products_stations_select','uses' => 'ProductsController@stations_select']);
Route::get('products/show/{id?}',['as' => 'products_show_by_id','uses' => 'ProductsController@index']);
Route::get('products/view-show','ProductsController@show');
Route::get('api/products/autocomplit/','ProductsController@autocomplit');
Route::get('api/products/autocomplit2/','ProductsController@getAutocomplit2');
Route::get('api/products/select','ProductsController@selectProducts');

Route::get('api/products/validar/{text}','ProductsController@validarNombre');
Route::get('api/consultaProductos/selectall/{codigo?}/{marca?}/{linea?}/{busColor?}/{busTaco?}/{busTalla?}/{busMate?}','ProductsController@consultaProductos');

Route::post('api/products/actualizarDsctoGeneral','ProductsController@actualizarDsctoGeneral');
//Route::post('api/products/actualizarDsctoGeneral','ProductsController@actualizarDsctoVar');



//---------------------
Route::get('api/productsSearchsku/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@searchsku']);
Route::get('api/products/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@misDatos']);
Route::get('api/productslalal/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@misDatos2']);
Route::get('api/productsVariantes/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@misDatosVariantes']);
Route::get('api/productsFavoritos/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@favoritos']);
Route::get('api/variantsAllInventary/misDatos/{store?}/{were?}/{q?}',['as'=>'person_find', 'uses'=>'ProductsController@variantsAllInventary']);
//---------------------
 
//END PRODUCTS ROUTES

//VARIANTS ROUTES
Route::get('api/variants/variant/{id}',['as' => 'variant_byproduct_id', 'uses' => 'VariantsController@variant']);
Route::get('api/variants/variants/{id}',['as' => 'variants_byproduct_id', 'uses' => 'VariantsController@variants']);
Route::get('api/variants/autocomplit/{sku}','VariantsController@traer_por_Sku');
Route::get('api/variants/Paginar_por_Variante','VariantsController@Paginar_por_Variante');
Route::get('api/variants/paginatep/{id}/{var}','VariantsController@paginatep');
Route::get('api/variants/selectTalla/{id}/{taco}','VariantsController@selectTalla');
Route::get('api/variants/selectStocksTalla/{id}/{taco}/{alma}','VariantsController@selectStocksTalla');
Route::get('api/variants/selectStocksTallaSinTaco/{id}/{alma}','VariantsController@selectStocksTallaSinTaco');

Route::get('api/variantname/search/{q?}',['as' => 'variant_byproduct_id', 'uses' => 'VariantsController@searchCodigo']);

Route::post('api/variants/actualizarDsctoVar','VariantsController@actualizarDsctoVar');


//END VARIANTS ROUTES

//Presentations routes
Route::get('api/presentations/findVariant/{id}','PresentationsController@findVariant');
Route::get('api/presentations/all',['as'=>'presentation_all', 'uses'=>'PresentationsController@all']);
Route::get('api/presentations_base/all',['as'=>'presentation_base_all', 'uses'=>'PresentationsController@all_base']);
Route::get('api/presentations/all_by_base/{id}',['as'=>'presentation_by_base_all', 'uses'=>'PresentationsController@all_by_base']);
Route::post('api/presentations/create',['as'=>'presentation_create', 'uses'=>'PresentationsController@create']);
//End prese routes
//byforeingKey(uri,fx,id

//detpres routes
Route::get('api/detpres/all','DetPresController@all');
//end detpres routes

//equiv routes
Route::get('api/equiv/all','EquivController@all');
Route::get('api/equiv/traer/{id}','EquivController@equivalencias');
//end equiv routes

Route::group(['middleware' => 'role'], function () {
//STORE ROUTES
    Route::get('stores', ['as' => 'store', 'uses' => 'StoresController@index']);
    Route::get('stores/create', ['as' => 'store_create', 'uses' => 'StoresController@index']);
    Route::get('stores/edit/{id?}', ['as' => 'store_edit', 'uses' => 'StoresController@index']);
    Route::get('stores/form-create', ['as' => 'store_form_create', 'uses' => 'StoresController@form_create']);
    Route::get('stores/form-edit', ['as' => 'store_form_edit', 'uses' => 'StoresController@form_edit']);
});
    Route::get('api/stores/all', ['as' => 'store_all', 'uses' => 'StoresController@all']);
    Route::get('api/stores/paginate/', ['as' => 'store_paginate', 'uses' => 'StoresController@paginatep']);

Route::post('api/stores/create',['as'=>'store_create', 'uses'=>'StoresController@create']);
Route::put('api/stores/edit',['as'=>'store_edit', 'uses'=>'StoresController@edit']);
Route::post('api/stores/destroy',['as'=>'store_destroy', 'uses'=>'StoresController@destroy']);
Route::get('api/stores/search/{q?}',['as'=>'store_search', 'uses'=>'StoresController@search']);
Route::get('api/storeReport/search/{q?}',['as'=>'store_search', 'uses'=>'StoresController@searchReport']);

Route::get('api/stores/find/{id}',['as'=>'store_find', 'uses'=>'StoresController@find']);
Route::get('api/stores/select','StoresController@selectStores');
//route::controller('/', 'Layout\proban@prob');

Route::group(['middleware' => 'role'], function () {
    Route::get('brands', ['as' => 'brand', 'uses' => 'BrandsController@index']);
    Route::get('brands/create', ['as' => 'brand_create', 'uses' => 'BrandsController@index']);
    Route::get('brands/edit/{id?}', ['as' => 'brand_edit', 'uses' => 'BrandsController@index']);
    Route::get('brands/form-create', ['as' => 'brand_form_create', 'uses' => 'BrandsController@form_create']);
    Route::get('brands/form-edit', ['as' => 'brand_form_edit', 'uses' => 'BrandsController@form_edit']);
});
    Route::get('api/brands/all', ['as' => 'brand_all', 'uses' => 'BrandsController@all']);
    Route::get('api/brands/paginate/', ['as' => 'brand_paginate', 'uses' => 'BrandsController@paginatep']);

 Route::post('api/brands/create',['as'=>'brand_create', 'uses'=>'BrandsController@create']);
 Route::put('api/brands/edit',['as'=>'brand_edit', 'uses'=>'BrandsController@edit']);
 Route::post('api/brands/destroy',['as'=>'brand_destroy', 'uses'=>'BrandsController@destroy']);
 Route::get('api/brands/search/{q?}',['as'=>'brand_search', 'uses'=>'BrandsController@search']);
 Route::get('api/brands/find/{id}',['as'=>'brand_find', 'uses'=>'BrandsController@find']);
 Route::get('api/brands/validar/{text}',['as'=>'brand_find', 'uses'=>'BrandsController@validaBrandname']);
 //END STORE ROUTES
Route::group(['middleware' => 'role'], function () {
    Route::get('types', ['as' => 'store', 'uses' => 'TypesController@index']);
    Route::get('types/create', ['as' => 'type_create', 'uses' => 'TypesController@index']);
    Route::get('types/edit/{id?}', ['as' => 'type_edit', 'uses' => 'TypesController@index']);
    Route::get('types/form-create', ['as' => 'type_form_create', 'uses' => 'TypesController@form_create']);
    Route::get('types/form-edit', ['as' => 'type_form_edit', 'uses' => 'TypesController@form_edit']);
});
Route::get('api/types/all',['as'=>'type_all', 'uses'=>'TypesController@all']);
Route::get('api/types/paginate/',['as' => 'type_paginate', 'uses' => 'TypesController@paginatep']);
Route::post('api/types/create',['as'=>'type_create', 'uses'=>'TypesController@create']);
Route::put('api/types/edit',['as'=>'type_edit', 'uses'=>'TypesController@edit']);
Route::post('api/types/destroy',['as'=>'type_destroy', 'uses'=>'TypesController@destroy']);
Route::get('api/types/search/{q?}',['as'=>'type_search', 'uses'=>'TypesController@search']);
Route::get('api/types/find/{id}',['as'=>'type_find', 'uses'=>'TypesController@find']);

Route::get('api/typeName/search/{q?}',['as'=>'type_search', 'uses'=>'TypesController@searchType']);
/*
Route::get('brands',['as'=>'brand','uses'=>'BrandsController@index']);
Route::get('brands/create',['as'=>'brand_create','uses'=>'BrandsController@index']);
Route::get('brands/edit/{id?}', ['as' => 'brand_edit', 'uses' => 'BrandsController@index']);
Route::get('api/brands/paginate/',['as' => 'brands_paginate', 'uses' => 'BrandsController@paginatep']);
*/
Route::group(['middleware' => 'role'], function () {
    Route::get('atributes', ['as' => 'atribut', 'uses' => 'AtributesController@index']);
    Route::get('atributes/create', ['as' => 'atribut_create', 'uses' => 'AtributesController@index']);
    Route::get('atributes/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'AtributesController@index']);
    Route::get('atributes/form-create', ['as' => 'atribut_form_create', 'uses' => 'AtributesController@form_create']);
    Route::get('atributes/form-edit', ['as' => 'atribut_form_edit', 'uses' => 'AtributesController@form_edit']);
});
Route::get('api/atributes/all',['as'=>'atribut_all', 'uses'=>'AtributesController@all']);
Route::get('api/atributes/paginate/',['as' => 'atribut_paginate', 'uses' => 'AtributesController@paginatep']);
Route::post('api/atributes/create',['as'=>'atribut_create', 'uses'=>'AtributesController@create']);
Route::put('api/atributes/edit',['as'=>'atribut_edit', 'uses'=>'AtributesController@edit']);
Route::post('api/atributes/destroy',['as'=>'atribut_destroy', 'uses'=>'AtributesController@destroy']);
Route::get('api/atributes/search/{q?}',['as'=>'atribut_search', 'uses'=>'AtributesController@search']);
Route::get('api/atributes/find/{id}',['as'=>'atribut_find', 'uses'=>'AtributesController@find']);
Route::get('api/atributes/selectNumber/{id}/{tama}',['as'=>'atribut_find', 'uses'=>'AtributesController@selectNumber']);

Route::get('/joder','WarehousesController@all');
//Route::controller('api/warehouses/','WarehousesController');
Route::get('api/stores/','AtributesController@selest');
Route::get('api/praticando/{id}','alumController@find');
Route::group(['middleware' => 'role'], function () {
    Route::get('warehouses', ['as' => 'warehouse', 'uses' => 'WarehousesController@index']);
    Route::get('warehouses/create', ['as' => 'warehouse_create', 'uses' => 'WarehousesController@index']);
    Route::get('warehouses/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'WarehousesController@index']);
    Route::get('warehouses/form-create', ['as' => 'atribut_form_create', 'uses' => 'WarehousesController@form_create']);
    Route::get('warehouses/form-edit', ['as' => 'atribut_form_edit', 'uses' => 'WarehousesController@form_edit']);
});
Route::get('api/warehouses/all',['as'=>'atribut_all', 'uses'=>'WarehousesController@all']);
Route::get('api/warehouses/paginate/',['as' => 'atribut_paginate', 'uses' => 'WarehousesController@paginatep']);
Route::post('api/warehouses/create',['as'=>'atribut_create', 'uses'=>'WarehousesController@create']);
Route::put('api/warehouses/edit',['as'=>'atribut_edit', 'uses'=>'WarehousesController@edit']);
Route::post('api/warehouses/destroy',['as'=>'atribut_destroy', 'uses'=>'WarehousesController@destroy']);
Route::get('api/warehouses/search/{q?}',['as'=>'atribut_search', 'uses'=>'WarehousesController@search']);
Route::get('api/warehouses/find/{id}',['as'=>'atribut_find', 'uses'=>'WarehousesController@find']);

Route::get('api/warehousesStore/search/{q?}',['as'=>'atribut_search', 'uses'=>'WarehousesController@searchWere']);

Route::get('api/warehouses/search/{q?}/{id?}',['as'=>'atribut_search', 'uses'=>'WarehousesController@searchWarehouse']);

//Route::get('api/stores/select','WarehousesController@select');
Route::group(['middleware' => 'role'], function () {
    Route::get('stations', ['as' => 'warehouse', 'uses' => 'StationsController@index']);
    Route::get('stations/create', ['as' => 'warehouse_create', 'uses' => 'StationsController@index']);
    Route::get('stations/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'StationsController@index']);
    Route::get('stations/form-create', ['as' => 'atribut_form_create', 'uses' => 'StationsController@form_create']);
    Route::get('stations/form-edit', ['as' => 'atribut_form_edit', 'uses' => 'StationsController@form_edit']);
});


Route::get('api/stations/all',['as'=>'atribut_all', 'uses'=>'StationsController@all']);
Route::get('api/stations/paginate/',['as' => 'atribut_paginate', 'uses' => 'StationsController@paginatep']);
Route::post('api/stations/create',['as'=>'atribut_create', 'uses'=>'StationsController@create']);
Route::put('api/stations/edit',['as'=>'atribut_edit', 'uses'=>'StationsController@edit']);
Route::post('api/stations/destroy',['as'=>'atribut_destroy', 'uses'=>'StationsController@destroy']);
Route::get('api/stations/search/{q?}',['as'=>'atribut_search', 'uses'=>'StationsController@search']);
Route::get('api/stations/find/{id}',['as'=>'atribut_find', 'uses'=>'StationsController@find']);
Route::get('api/stations/validar/{text}',['as'=>'atribut_find', 'uses'=>'StationsController@validastationname']);

Route::group(['middleware' => 'role'], function () {
    Route::get('materials', ['as' => 'warehouse', 'uses' => 'MaterialsController@index']);
    Route::get('materials/create', ['as' => 'warehouse_create', 'uses' => 'MaterialsController@index']);
    Route::get('materials/edit/{id?}', ['as' => 'atribut_edit', 'uses' => 'MaterialsController@index']);
    Route::get('materials/form-create', ['as' => 'atribut_form_create', 'uses' => 'MaterialsController@form_create']);
    Route::get('materials/form-edit', ['as' => 'atribut_form_edit', 'uses' => 'MaterialsController@form_edit']);
});
Route::get('api/materials/all',['as'=>'atribut_all', 'uses'=>'MaterialsController@all']);
Route::get('api/materials/paginate/',['as' => 'atribut_paginate', 'uses' => 'MaterialsController@paginatep']);
Route::post('api/materials/create',['as'=>'atribut_create', 'uses'=>'MaterialsController@create']);
Route::put('api/materials/edit',['as'=>'atribut_edit', 'uses'=>'MaterialsController@edit']);
Route::post('api/materials/destroy',['as'=>'atribut_destroy', 'uses'=>'MaterialsController@destroy']);
Route::get('api/materials/search/{q?}',['as'=>'atribut_search', 'uses'=>'MaterialsController@search']);
Route::get('api/materials/find/{id}',['as'=>'atribut_find', 'uses'=>'MaterialsController@find']);


Route::group(['middleware' => 'role'], function () {
    Route::get('employees', ['as' => 'person', 'uses' => 'EmployeesController@index']);
    Route::get('employees/create', ['as' => 'person_create', 'uses' => 'EmployeesController@index']);
    Route::get('employees/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EmployeesController@index']);
    Route::get('employees/form-create', ['as' => 'person_form_create', 'uses' => 'EmployeesController@form_create']);
    Route::get('employees/form-edit', ['as' => 'person_form_edit', 'uses' => 'EmployeesController@form_edit']);
});
Route::get('api/employees/all',['as'=>'person_all', 'uses'=>'EmployeesController@all']);
Route::get('api/employees/paginate/',['as' => 'person_paginate', 'uses' => 'EmployeesController@paginatep']);
Route::post('api/employees/create',['as'=>'person_create', 'uses'=>'EmployeesController@create']);
Route::put('api/employees/edit',['as'=>'person_edit', 'uses'=>'EmployeesController@edit']);
Route::post('api/employees/destroy',['as'=>'person_destroy', 'uses'=>'EmployeesController@destroy']);
Route::get('api/employees/search/{q?}',['as'=>'person_search', 'uses'=>'EmployeesController@search']);
Route::get('api/employees/find/{id}',['as'=>'person_find', 'uses'=>'EmployeesController@find']);
Route::get('api/employeesVenta/search/{q?}',['as'=>'person_search', 'uses'=>'EmployeesController@searchVenta']);

Route::get('api/buscar/find/{id}',['as'=>'person_find', 'uses'=>'EmployeesController@find']);
Route::group(['middleware' => 'role'], function () {
    Route::get('suppliers', ['as' => 'person', 'uses' => 'SuppliersController@index']);
    Route::get('suppliers/create', ['as' => 'person_create', 'uses' => 'SuppliersController@index']);
    Route::get('suppliers/edit/{id?}', ['as' => 'person_edit', 'uses' => 'SuppliersController@index']);
    Route::get('suppliers/form-create', ['as' => 'person_form_create', 'uses' => 'SuppliersController@form_create']);
    Route::get('suppliers/form-edit', ['as' => 'person_form_edit', 'uses' => 'SuppliersController@form_edit']);
});
Route::get('api/suppliers/all',['as'=>'person_all', 'uses'=>'SuppliersController@all']);
Route::get('api/suppliers/paginate/',['as' => 'person_paginate', 'uses' => 'SuppliersController@paginatep']);
Route::post('api/suppliers/create',['as'=>'person_create', 'uses'=>'SuppliersController@create']);
Route::put('api/suppliers/edit',['as'=>'person_edit', 'uses'=>'SuppliersController@edit']);
Route::post('api/suppliers/destroy',['as'=>'person_destroy', 'uses'=>'SuppliersController@destroy']);
Route::get('api/suppliers/search/{q?}',['as'=>'person_search', 'uses'=>'SuppliersController@search']);
Route::get('api/suppliers/find/{id}',['as'=>'person_find', 'uses'=>'SuppliersController@find']);
Route::get('api/suppliers/select','SuppliersController@selectSupliers');
Route::get('api/suppliers/deudas','SuppliersController@deudas');

Route::get('employeecosts',['as'=>'person','uses'=>'EmployeecostsController@index']);
Route::get('employeecosts/create',['as'=>'person_create','uses'=>'EmployeecostsController@index']);
Route::get('employeecosts/edit/{id?}', ['as' => 'person_edit', 'uses' => 'EmployeecostsController@index']);
Route::get('employeecosts/form-create',['as'=>'person_form_create','uses'=>'EmployeecostsController@form_create']);
Route::get('employeecosts/form-edit',['as'=>'person_form_edit','uses'=>'EmployeecostsController@form_edit']);
Route::get('api/employeecosts/all',['as'=>'person_all', 'uses'=>'EmployeecostsController@all']);
Route::get('api/employeecosts/paginate/',['as' => 'person_paginate', 'uses' => 'EmployeecostsController@paginatep']);
Route::post('api/employeecosts/create',['as'=>'person_create', 'uses'=>'EmployeecostsController@create']);
Route::put('api/employeecosts/edit',['as'=>'person_edit', 'uses'=>'EmployeecostsController@edit']);
Route::post('api/employeecosts/destroy',['as'=>'person_destroy', 'uses'=>'EmployeecostsController@destroy']);
Route::get('api/employeecosts/search/{q?}',['as'=>'person_search', 'uses'=>'EmployeecostsController@search']);
Route::get('api/employeecosts/find/{id}',['as'=>'person_find', 'uses'=>'EmployeecostsController@find']);
Route::get('api/employeecosts/mostrarCostos/{id}','EmployeecostsController@mostrarCostos');
//Route::get('api/employeecosts/hola','EmployeecostsController@hola');
// Route::get('aprende',function(){
// 	echo Form::open(array('url'=>'nombre','method'=>'post'));
// 	echo Form::label('nombre','Tu nombre');
// 	echo Form::text('nom');
// 	echo Form::submit('Enviar');
// 	echo Form::close();
// });
// Route::post('nombre',function(){
// 	$nombre = Input::get('nom');
// 	return "tu nombre es: ".$nombre;
// });

//practica
Route::group(['middleware' => 'role'], function () {
    Route::get('cashMonthlys', ['as' => 'person', 'uses' => 'CashMonthlyController@index']);
    Route::get('cashMonthlys/create', ['as' => 'person_create', 'uses' => 'CashMonthlyController@index']);
    Route::get('cashMonthlys/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CashMonthlyController@index']);
    Route::get('cashMonthlys/form-create', ['as' => 'person_form_create', 'uses' => 'CashMonthlyController@form_create']);
    Route::get('cashMonthlys/form-edit', ['as' => 'person_form_edit', 'uses' => 'CashMonthlyController@form_edit']);
});
Route::get('api/cashMonthlys/all',['as'=>'person_all', 'uses'=>'CashMonthlyController@all']);
Route::get('api/cashMonthlys/paginate/',['as' => 'person_paginate', 'uses' => 'CashMonthlyController@paginatep']);
Route::post('api/cashMonthlys/create',['as'=>'person_create', 'uses'=>'CashMonthlyController@create']);
Route::put('api/cashMonthlys/edit',['as'=>'person_edit', 'uses'=>'CashMonthlyController@edit']);
Route::post('api/cashMonthlys/destroy',['as'=>'person_destroy', 'uses'=>'CashMonthlyController@destroy']);
Route::get('api/cashMonthlys/search/{q?}',['as'=>'person_search', 'uses'=>'CashMonthlyController@search']);
Route::get('api/cashMonthlys/find/{id}',['as'=>'person_find', 'uses'=>'CashMonthlyController@find']);
Route::get('api/cashMonthlys/search/{m?}/{a?}/{c?}',['as'=>'person_search', 'uses'=>'CashMonthlyController@search']);
Route::get('api/cashMonthlysMonto/search/{m?}/{a?}/{c?}',['as'=>'person_search', 'uses'=>'CashMonthlyController@searchMonto']);

//Route::get('api/cashMonthlys/search/{q?}',['as'=>'person_search', 'uses'=>'CashMonthlyController@search']);
//-----------------------------------------------------
Route::get('api/months/select','MonthsController@select');
Route::get('api/years/select','YearsController@select');
Route::get('api/expenses/select','ExpenseMonthlysController@select');
Route::post('api/expenseMonthlys/create',['as'=>'person_create', 'uses'=>'ExpenseMonthlysController@create']);
Route::post('api/years/create',['as'=>'person_create', 'uses'=>'YearsController@create']);
Route::post('api/years/destroy',['as'=>'person_destroy', 'uses'=>'YearsController@destroy']);
Route::put('api/years/edit',['as'=>'person_edit', 'uses'=>'YearsController@edit']);
Route::post('api/expenseMonthlys/destroy',['as'=>'person_destroy', 'uses'=>'ExpenseMonthlysController@destroy']);
Route::put('api/expenseMonthlys/edit',['as'=>'person_edit', 'uses'=>'ExpenseMonthlysController@edit']);

//practica
Route::get('practicas',['as'=>'person','uses'=>'PracticasController@index']);
Route::get('practicas/create',['as'=>'person_create','uses'=>'PracticasController@index']);
Route::get('practicas/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PracticasController@index']);
Route::get('practicas/form-create',['as'=>'person_form_create','uses'=>'PracticasController@form_create']);
Route::get('practicas/form-edit',['as'=>'person_form_edit','uses'=>'PracticasController@form_edit']);
Route::get('api/practicas/all',['as'=>'person_all', 'uses'=>'PracticasController@all']);
Route::get('api/practicas/paginate/',['as' => 'person_paginate', 'uses' => 'PracticasController@paginatep']);
Route::post('api/practicas/create',['as'=>'person_create', 'uses'=>'PracticasController@create']);
Route::put('api/practicas/edit',['as'=>'person_edit', 'uses'=>'PracticasController@edit']);
Route::post('api/practicas/destroy',['as'=>'person_destroy', 'uses'=>'PracticasController@destroy']);
Route::get('api/practicas/search/{q?}',['as'=>'person_search', 'uses'=>'PracticasController@search']);
Route::get('api/practicas/find/{id}',['as'=>'person_find', 'uses'=>'PracticasController@find']);

Route::get('api/expenses/find/{id}','ExpenseMonthlysController@find');
Route::get('api/years/find/{id}','YearsController@find');
Route::get('api/warehouses/select','WarehousesController@selectWarehouses');

Route::group(['middleware' => 'role'], function () {
    Route::get('orderPurchases', ['as' => 'person', 'uses' => 'OrderPurchasesController@index']);
    Route::get('orderPurchases/create', ['as' => 'person_create', 'uses' => 'OrderPurchasesController@index']);
    Route::get('orderPurchases/edit/{id?}', ['as' => 'person_edit', 'uses' => 'OrderPurchasesController@index']);
    Route::get('orderPurchases/form-create', ['as' => 'person_form_create', 'uses' => 'OrderPurchasesController@form_create']);
    Route::get('orderPurchases/form-edit', ['as' => 'person_form_edit', 'uses' => 'OrderPurchasesController@form_edit']);
});
Route::get('api/orderPurchases/all/{estado}',['as'=>'person_all', 'uses'=>'OrderPurchasesController@all']);
Route::get('api/orderPurchases/paginate/',['as' => 'person_paginate', 'uses' => 'OrderPurchasesController@paginatep']);
Route::post('api/orderPurchases/create',['as'=>'person_create', 'uses'=>'OrderPurchasesController@create']);
Route::put('api/orderPurchases/edit/',['as'=>'person_edit', 'uses'=>'OrderPurchasesController@edit']);
Route::post('api/orderPurchases/destroy',['as'=>'person_destroy', 'uses'=>'OrderPurchasesController@destroy']);
Route::get('api/orderPurchases/search/{q?}',['as'=>'person_search', 'uses'=>'OrderPurchasesController@search']);
Route::get('api/orderPurchases/find/{id}',['as'=>'person_find', 'uses'=>'OrderPurchasesController@find']);
Route::get('api/orderPurchases/mostrarCostos/{id}','OrderPurchasesController@mostrarCostos');
//Route::get('api/orderPurchases/mostarUltimoagregado','OrderPurchasesController@mostarUltimoagregado');
Route::get('api/orderPurchases/mostrarEmpresa/{id}','OrderPurchasesController@mostrarEmpresa');
Route::get('orderPurchases/createDetalle/{id?}', ['as' => 'person_edit', 'uses' => 'OrderPurchasesController@index']);
Route::get('orderPurchases/form-createDetalle',['as'=>'atribut_form_create','uses'=>'OrderPurchasesController@createDetalle']);
Route::get('orderPurchases/form-createP','OrderPurchasesController@form_createP');
Route::get('orderPurchases/createP','OrderPurchasesController@index');
Route::get('orderPurchases/show/{id?}','OrderPurchasesController@index');
Route::get('orderPurchases/view-show','OrderPurchasesController@show'); 
Route::get('api/orderPurchases/paginarfechaTipo/{fechaini}/{fechafin}/{estado}','OrderPurchasesController@searchFechasEstado');
Route::get('api/orderPurchases/paginar/{fechaini}/{fechafin}','OrderPurchasesController@searchFechas');
Route::get('api/searchFechasLlegadaEstado/paginarfechaTipo/{fechaini}/{fechafin}/{estado}','OrderPurchasesController@searchFechasLlegadaEstado');


Route::post('api/orderPurchases/reporteEstado/{estado}','OrderPurchasesController@reporteEstado');
Route::post('api/orderPurchases/reporteRangoFechas/{fech1}/{fecha2}','OrderPurchasesController@reporteRangoFechas');
Route::post('api/searchFechasLlegada/reporteRangoFechas/{fech1}/{fecha2}','OrderPurchasesController@searchFechasLlegada');
Route::post('api/orderPurchases/reporteRangoFechasEstado/{fech1}/{fecha2}/{estado}','OrderPurchasesController@reporteRangoFechasEstado');
Route::post('api/reporteRangoFechaPrevista/reporteRangoFechas/{fech1}/{fecha2}','OrderPurchasesController@reporteRangoFechaPrevista');
Route::post('api/reporteRangoFechaPrevistaEstado/reporteRangoFechasEstado/{fech1}/{fecha2}/{estado}','OrderPurchasesController@reporteRangoFechaPrevistaEstado');
Route::post('api/reporteOrdenCompreLike/reporteEstado/{descr}','OrderPurchasesController@reporteOrdenCompreLike');

Route::group(['middleware' => 'role'], function () {
    Route::get('purchases', ['as' => 'person', 'uses' => 'PurchasesController@index']);
    Route::get('purchases/create', ['as' => 'person_create', 'uses' => 'PurchasesController@index']);
    Route::get('purchases/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PurchasesController@index']);
    Route::get('purchases/form-create', ['as' => 'person_form_create', 'uses' => 'PurchasesController@form_create']);
    Route::get('purchases/form-edit', ['as' => 'person_form_edit', 'uses' => 'PurchasesController@form_edit']);
});
Route::get('api/purchases/all',['as'=>'person_all', 'uses'=>'PurchasesController@all']);
Route::get('api/purchases/paginate/',['as' => 'person_paginate', 'uses' => 'PurchasesController@paginatep']);
Route::post('api/purchases/create',['as'=>'person_create', 'uses'=>'PurchasesController@create']);
Route::put('api/purchases/edit/',['as'=>'person_edit', 'uses'=>'PurchasesController@edit']);
Route::post('api/purchases/destroy',['as'=>'person_destroy', 'uses'=>'PurchasesController@destroy']);
Route::get('api/purchases/search/{q?}',['as'=>'person_search', 'uses'=>'PurchasesController@search']);
Route::get('api/purchases/find/{id}',['as'=>'person_find', 'uses'=>'PurchasesController@find']);
Route::get('api/purchases/mostrarCostos/{id}','PurchasesController@mostrarCostos');
Route::post('api/TiketReport/create/{id}','PurchasesController@reportes');
Route::post('api/CodReport/create/{id}','PurchasesController@reportesCod');
Route::post('api/reporteCompraLike/create/{descr}','PurchasesController@reporteCompraLike');
Route::get('purchases/createMov','PurchasesController@index');
Route::get('purchases/form-createMov','PurchasesController@form_createMov');
//Route::post('api/orderPurchases/create',['as'=>'person_create', 'uses'=>'OrderPurchasesController@create']);

Route::post('api/reportePorFechacom/create/{fech1}/{fecha2}','PurchasesController@reporteRangoFechas');
Route::post('api/reportPagos1/create/{idpro}','PurchasesController@reportepagosProveedor');
Route::post('api/reportPagos2/create/{idpay}','PurchasesController@reportepagos');
Route::post('api/ReportComprobante/create/{idpago}','DetPaymentsController@ReportComprobante');

Route::get('purchases/showD','PurchasesController@index');
Route::get('purchases/view-showD','PurchasesController@form_showD');
Route::get('purchases/cardex','PurchasesController@index');
Route::get('purchases/view-cardex','PurchasesController@form_cardex');
Route::get('api/purchases/paginar/{fechaini}/{fechafin}','PurchasesController@paginar1');

//---------------------------------------------------------------------
Route::group(['middleware' => 'role'], function () {
    Route::get('variants/create/{product_id}', ['as' => 'variant_create', 'uses' => 'VariantsController@index']);
    Route::get('variants/edit/{id?}', ['as' => 'variant_edit', 'uses' => 'VariantsController@index']);
    Route::get('variants/form-create', ['as' => 'variant_form_create', 'uses' => 'VariantsController@form_create']);
    Route::get('variants/form-edit', ['as' => 'variant_form_edit', 'uses' => 'VariantsController@form_edit']);
});
Route::post('api/variants/create',['as'=>'variant_create', 'uses'=>'VariantsController@create']);
Route::put('api/variants/edit',['as'=>'variant_edit', 'uses'=>'VariantsController@edit']);
Route::post('api/variants/destroy',['as'=>'variant_destroy', 'uses'=>'VariantsController@destroy']);
Route::get('api/variants/select','VariantsController@select');
Route::get('api/variants/findVariant/{id}','VariantsController@findVariant');
Route::get('api/variants/paginate/','VariantsController@paginatep');
Route::get('api/variants/find/{id}','VariantsController@find');
Route::get('api/variants/getAttr/{id}','VariantsController@getAttr');
Route::put('api/variants/editFavorito/','VariantsController@editFavoritos');
Route::get('api/variants/disablevar/{id}',['as'=>'variant_disabled', 'uses'=>'VariantsController@disablevar']);

Route::post('api/detailOrderPurchases/create','DetailOrderPurchasesController@create');
Route::get('api/detailOrderPurchases/all/{estado}',['as'=>'person_all', 'uses'=>'DetailOrderPurchasesController@all']);
Route::get('api/detailOrderPurchases/paginatep/{id}','DetailOrderPurchasesController@paginatep');
Route::get('api/detailOrderPurchases/Eliminar/{id}','DetailOrderPurchasesController@Eliminar');
Route::post('api/detailOrderPurchases/destroy','DetailOrderPurchasesController@destroy');
Route::post('api/detailOrderPurchases/destroy','DetailOrderPurchasesController@destroy');
Route::put('api/detailOrderPurchases/edit/','DetailOrderPurchasesController@edit');


Route::get('api/detailPurchases/paginatep/{id?}','DetailPurchasesController@paginatep');
Route::get('api/stocks/find/{id}/{id1}','StocksController@find');
Route::put('api/stocks/edit/','StocksController@edit');
Route::put('api/stocks1/edit/','StocksController@edit1');
Route::get('api/stocks/traerstock/{product_id}','StocksController@traerStock');
Route::get('api/stocks/verStockActual/{var}/{almacen}','StocksController@verStockActual');

Route::get('api/detpres/paginatep/{id}','DetPresController@paginatep');
Route::get('api/detpres/find/{id}','DetPresController@find');
Route::get('api/detpres/{id}','DetPresController@select');

Route::get('api/equivs/find/{id}','EquivController@find');
Route::post('api/payments/create','PaymentsController@create');
Route::get('api/payments/find/{id}','PaymentsController@find');
Route::post('api/payments/destroy','PaymentsController@destroy'); 
Route::put('api/payments/edit/','PaymentsController@edit');
Route::get('api/payments/select/{id}','PaymentsController@payIDLocal');

Route::get('purchases/show/{id?}','PurchasesController@index');
Route::get('purchases/view-show','PurchasesController@show');
Route::get('api/methodPayments/paginate/','MethodPaymentController@paginatep');
Route::post('api/detPayments/create','DetPaymentsController@create');
Route::get('api/detPayments/paginate/','DetPaymentsController@paginatep');
Route::get('api/detPayments/find/{id}','DetPaymentsController@find');

Route::get('reports',['as'=>'person','uses'=>'ReportsController@index']);
Route::post('api/reports/{id?}',['as'=>'person_search', 'uses'=>'ReportsController@reportProduct']);
Route::post('api/reports/{idStore?}/{idWerwhaose?}',['as'=>'person_search', 'uses'=>'ReportsController@reportProductWere']);
Route::post('api/report/tiket/{id?}',['as'=>'person_search', 'uses'=>'ReportsController@reportTiket']);

Route::post('api/inputStocks/create','InputStocksController@create');
Route::get('api/inputStocks/paginate/','InputStocksController@paginate');
Route::get('api/inputStocks/find/{id}','InputStocksController@paginate2');
Route::get('api/inputStocks/paginar/{fechaini}/{fechafin}','InputStocksController@paginateFechas');
Route::get('api/inputStocks/paginartipos/{tipo}','InputStocksController@paginateTipos');
Route::get('api/inputStocks/paginarfechaTipo/{fechaini}/{fechafin}/{tipo}','InputStocksController@selectFechaYtipo');
//Route::post('api/reportes/reporteMovimientotipo/{tipo}','InputStocksController@reporteMovimentos');
Route::post('api/reporttiket/reporteEstado/{id}','InputStocksController@reporttiket');
Route::post('api/movimientoTipo/create/{tipo}','InputStocksController@reporteMovimentos');
Route::post('api/movimientoFechas/create/{fech1}/{fecha2}','InputStocksController@reporteMovimentosFechas');
Route::post('api/movimientoFechasTipo/create/{fech1}/{fecha2}/{tipo}','InputStocksController@reporteMovimentosFechasTipo');

//-----------------------------Promociones---------------------------
Route::get('promotions',['as'=>'person','uses'=>'PromotionsController@index']);
Route::get('promotions/create',['as'=>'person_create','uses'=>'PromotionsController@index']);
Route::get('promotions/edit/{id?}', ['as' => 'person_edit', 'uses' => 'PromotionsController@index']);
Route::get('promotions/form-create',['as'=>'person_form_create','uses'=>'PromotionsController@form_create']);
Route::get('promotions/form-edit',['as'=>'person_form_edit','uses'=>'PromotionsController@form_edit']);
Route::get('api/promotions/all',['as'=>'person_all', 'uses'=>'PromotionsController@all']);
Route::get('api/promotions/paginate/',['as' => 'person_paginate', 'uses' => 'PromotionsController@paginatep']);
Route::post('api/promotions/create',['as'=>'person_create', 'uses'=>'PromotionsController@create']);
Route::put('api/promotions/edit',['as'=>'person_edit', 'uses'=>'PromotionsController@edit']);
Route::post('api/promotions/destroy',['as'=>'person_destroy', 'uses'=>'PromotionsController@destroy']);
Route::get('api/promotions/search/{q?}',['as'=>'person_search', 'uses'=>'PromotionsController@search']);
Route::get('api/promotions/find/{id}',['as'=>'person_find', 'uses'=>'PromotionsController@find']);
Route::get('api/promotions/mostrarCostos/{id}','PromotionsController@mostrarCostos');


//-----------------reportes----------------------------------------

Route::get('reports',['as'=>'person','uses'=>'ReportsController@index']);
Route::post('api/reports/{id?}',['as'=>'person_search', 'uses'=>'ReportsController@reportProduct']);
Route::post('api/reports/{idStore?}/{idWerwhaose?}',['as'=>'person_search', 'uses'=>'ReportsController@reportProductWere']);



//------------------------------------------------
Route::get('/reporting', ['uses' =>'ReportController@index', 'as' => 'Report']);
Route::post('/reporting', ['uses' =>'ReportController@post']);
Route::get('pdf', 'PdfController@invoice');

Route::group(['middleware' => 'role'], function () {
//-----------------------------CashHeader---------------------------
    Route::get('cashHeaders', ['as' => 'person', 'uses' => 'CashHeadersController@index']);
    Route::get('cashHeaders/create', ['as' => 'person_create', 'uses' => 'CashHeadersController@index']);
    Route::get('cashHeaders/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CashHeadersController@index']);
    Route::get('cashHeaders/form-create', ['as' => 'person_form_create', 'uses' => 'CashHeadersController@form_create']);
    Route::get('cashHeaders/form-edit', ['as' => 'person_form_edit', 'uses' => 'CashHeadersController@form_edit']);
});
Route::get('api/cashHeaders/all',['as'=>'person_all', 'uses'=>'CashHeadersController@all']);
Route::get('api/cashHeaders/paginate/',['as' => 'person_paginate', 'uses' => 'CashHeadersController@paginatep']);
Route::post('api/cashHeaders/create',['as'=>'person_create', 'uses'=>'CashHeadersController@create']);
Route::put('api/cashHeaders/edit',['as'=>'person_edit', 'uses'=>'CashHeadersController@edit']);
Route::post('api/cashHeaders/destroy',['as'=>'person_destroy', 'uses'=>'CashHeadersController@destroy']);
Route::get('api/cashHeaders/search/{q?}',['as'=>'person_search', 'uses'=>'CashHeadersController@search']);
Route::get('api/cashHeaders/find/{id}',['as'=>'person_find', 'uses'=>'CashHeadersController@find']);
Route::get('api/cashHeaders/select','CashHeadersController@select');
Route::get('api/cashHeaders/cajasActivas/{alma}','CashHeadersController@cajasActivas');
Route::get('api/searchHeaders/search/{q?}',['as'=>'person_search', 'uses'=>'CashHeadersController@searchHeader']);
Route::get('/api/cashHeaders/autocomplit2/','CashHeadersController@caja');
//Route::get('api/cashHeaders/mostrarCostos/{id}','PromotionsController@mostrarCostos');

Route::group(['middleware' => 'role-cashier'], function () {
//-----------------------------Cashes---------------------------
    Route::get('cashes', ['as' => 'person', 'uses' => 'CashesController@index']);
    Route::get('cashes/create', ['as' => 'person_create', 'uses' => 'CashesController@index']);
    Route::get('cashes/edit/{id?}', ['as' => 'person_edit', 'uses' => 'CashesController@index']);
    Route::get('cashes/form-create', ['as' => 'person_form_create', 'uses' => 'CashesController@form_create']);
    Route::get('cashes/form-edit', ['as' => 'person_form_edit', 'uses' => 'CashesController@form_edit']);
});
Route::get('api/cashes/all',['as'=>'person_all', 'uses'=>'CashesController@all']);
Route::get('api/cashes/paginate/',['as' => 'person_paginate', 'uses' => 'CashesController@paginatep']);
Route::post('api/cashes/create',['as'=>'person_create', 'uses'=>'CashesController@create']);
Route::put('api/cashes/edit',['as'=>'person_edit', 'uses'=>'CashesController@edit']);
Route::post('api/cashes/destroy',['as'=>'person_destroy', 'uses'=>'CashesController@destroy']);
Route::get('api/cashes/search/{q?}',['as'=>'person_search', 'uses'=>'CashesController@search']);
Route::get('api/cashes/find/{id}',['as'=>'person_find', 'uses'=>'CashesController@find']);
Route::get('api/cashes/cajas_for_user','CashesController@cajas_for_user');
Route::get('api/cashes/cajas_for_user1/{id}','CashesController@cajas_for_user1');
Route::post('api/cashes/searchOpenCashxCashHeader','CashesController@searchOpenCashxCashHeader');
//Route::get('api/cashes/select','SuppliersController@selectSupliers');

//-----------------------------DetCashes---------------------------
Route::get('api/ver_ventas/paginate/',['as'=>'person_search', 'uses'=>'DetCashController@ver_ventas']);
Route::get('api/ver_ventasSeparate/paginate/',['as'=>'person_search', 'uses'=>'DetCashController@ver_ventasSeparate']);
Route::get('detCashes',['as'=>'person','uses'=>'DetCashController@index']);
//Route::get('detCashes',['as'=>'person','uses'=>'DetCashController@index']);
Route::get('detCashes/create/{id?}',['as'=>'person_create','uses'=>'DetCashController@index']);
Route::get('detCashes/edit/{id?}', ['as' => 'person_edit', 'uses' => 'DetCashController@index']);
Route::get('detCashes/form-create',['as'=>'person_form_create','uses'=>'DetCashController@form_create']);
Route::get('detCashes/form-edit',['as'=>'person_form_edit','uses'=>'DetCashController@form_edit']);
Route::get('api/detCashes/all',['as'=>'person_all', 'uses'=>'DetCashController@all']);
Route::get('api/detCashes/paginate/',['as' => 'person_paginate', 'uses' => 'DetCashController@paginatep']);
Route::post('api/detCashes/create',['as'=>'person_create', 'uses'=>'DetCashController@create']);
Route::put('api/detCashes/edit',['as'=>'person_edit', 'uses'=>'DetCashController@edit']);
Route::post('api/detCashes/destroy',['as'=>'person_destroy', 'uses'=>'DetCashController@destroy']);
Route::get('api/detCashes/search/{q?}',['as'=>'person_search', 'uses'=>'DetCashController@search']);
Route::get('api/detCashes/find/{id}',['as'=>'person_find', 'uses'=>'DetCashController@find']);
Route::get('api/detCashes/compCajaActiva/{id}','DetCashController@compCajaActiva');

Route::get('api/detCashesSale/search/{q?}',['as'=>'person_search', 'uses'=>'DetCashController@searchSale']);
Route::get('api/detCashesOrderSale/search/{q?}',['as'=>'person_search', 'uses'=>'DetCashController@searchOrderSale']);
Route::get('api/detCashesSeparateSale/search/{q?}',['as'=>'person_search', 'uses'=>'DetCashController@searchSeparateSale']);
//-------------------------------------------------------------
Route::get('api/cashMotives/select','CashMotivesController@select');
Route::get('api/cashMotives/search/{q?}',['as'=>'person_search', 'uses'=>'CashMotivesController@search']);
Route::get('api/cashMotive/search/{q?}',['as'=>'person_search', 'uses'=>'CashMotivesController@searchMotive']); 

//----------------------------------------------------------------------
//-----------------------------Cashes---------------------------
Route::group(['middleware' => 'role-cashier'], function () {
    Route::get('sales', ['as' => 'person', 'uses' => 'SalesController@index']);
    Route::get('sales/create/', ['as' => 'person_create', 'uses' => 'SalesController@index']);
    Route::get('sales/edit/{id?}', ['as' => 'person_edit', 'uses' => 'SalesController@index']);
    Route::get('sales/form-create', ['as' => 'person_form_create', 'uses' => 'SalesController@form_create']);
    Route::get('sales/form-edit', ['as' => 'person_form_edit', 'uses' => 'SalesController@form_edit']);
});
Route::get('api/sales/all',['as'=>'person_all', 'uses'=>'SalesController@all']);
Route::get('api/sales/paginate/',['as' => 'person_paginate', 'uses' => 'SalesController@paginatep']);
Route::post('api/sales/create',['as'=>'person_create', 'uses'=>'SalesController@create']);
Route::put('api/sales/edit',['as'=>'person_edit', 'uses'=>'SalesController@edit']);
Route::post('api/sales/destroy',['as'=>'person_destroy', 'uses'=>'SalesController@destroy']);
Route::get('api/sales/search/{q?}',['as'=>'person_search', 'uses'=>'SalesController@search']);
Route::get('api/sales/find/{id}',['as'=>'person_find', 'uses'=>'SalesController@find']);
Route::get('api/sales/factura/{id}',['as'=>'person_find', 'uses'=>'SalesController@factura']);
Route::get('api/detfactura/factura/{id}',['as'=>'person_find', 'uses'=>'SalesController@detfactura']);
Route::get('api/sales/numeracion/{tipo}/{id}',['as'=>'person_find', 'uses'=>'SalesController@numeracion']);

Route::post('api/ordsales/create',['as'=>'person_create', 'uses'=>'SalesController@createSale']);
Route::post('api/sepsales/create',['as'=>'person_create', 'uses'=>'SalesController@createSeparateSale']);
Route::get('api/datosDocumento/search/{id}', ['as' => 'person_edit', 'uses' => 'SalesController@DatosDocumento']);



Route::get('api/detpresPresentation/search/{id?}',['as'=>'person_search', 'uses'=>'DetPresController@searchPresentations']);

Route::get('api/DetSales/search/{id?}',['as'=>'person_search', 'uses'=>'DetSalesController@searchDetalle']);
Route::get('api/salePayment/search/{id?}',['as'=>'person_search', 'uses'=>'SalePaymentController@searchPayment']);
Route::get('api/salePaymentOrder/search/{id?}',['as'=>'person_search', 'uses'=>'SalePaymentController@searchPaymentOrder']);
Route::get('api/salePaymentSeparate/search/{id?}',['as'=>'person_search', 'uses'=>'SalePaymentController@searchPaymentSeparate']);
Route::get('api/SaleDetPayment/search/{id?}',['as'=>'person_search', 'uses'=>'SaleDetPaymentController@searchDetalle']);
Route::post('api/salePayment/destroy','SalePaymentController@destroy'); 

Route::get('api/saleMethodPayments/select','SaleMethodPaymentController@select');
Route::post('api/saledetPayments/create',['as'=>'person_create', 'uses'=>'SaleDetPaymentController@create']);
Route::get('api/saledetPayments/find/{id}',['as'=>'person_create', 'uses'=>'SaleDetPaymentController@find']);
Route::get('api/saledetPayments/paginate/',['as' => 'person_paginate', 'uses' => 'SaleDetPaymentController@paginatep']);
Route::put('api/SalePayment/edit','SalePaymentController@edit');

Route::put('api/editdetpatmentSale/edit','SalePaymentController@editdetpatmentSale');

Route::get('api/pendientAccounts/paginate/','PendientAccountsController@paginatep');

Route::get('inventory',['as'=>'person','uses'=>'InventoryController@index']);

Route::put('api/pendientAccounts/edit','PendientAccountsController@edit');
Route::get('api/pendientAccounts/saldost/{id}','PendientAccountsController@verSaldosTotales');

//-----------------------------Order---------------------------
Route::group(['middleware' => 'role'], function () {
    Route::get('orderSales', ['as' => 'person', 'uses' => 'OrderSaleController@index']);
    Route::get('orderSales/create', ['as' => 'person_create', 'uses' => 'OrderSaleController@index']);
    Route::get('orderSales/edit/{id?}', ['as' => 'person_edit', 'uses' => 'OrderSaleController@index']);
    Route::get('orderSales/form-create', ['as' => 'person_form_create', 'uses' => 'OrderSaleController@form_create']);
    Route::get('orderSales/form-edit', ['as' => 'person_form_edit', 'uses' => 'OrderSaleController@form_edit']);
});
Route::get('api/orderSales/all',['as'=>'person_all', 'uses'=>'OrderSaleController@all']);
Route::get('api/orderSales/paginate/',['as' => 'person_paginate', 'uses' => 'OrderSaleController@paginatep']);
Route::post('api/orderSales/create',['as'=>'person_create', 'uses'=>'OrderSaleController@create']);
Route::put('api/orderSales/edit',['as'=>'person_edit', 'uses'=>'OrderSaleController@edit']);
Route::post('api/orderSales/destroy',['as'=>'person_destroy', 'uses'=>'OrderSaleController@destroy']);
Route::get('api/orderSales/search/{q?}',['as'=>'person_search', 'uses'=>'OrderSaleController@search']);
Route::get('api/orderSales/find/{id}',['as'=>'person_find', 'uses'=>'OrderSaleController@find']);

//--------------------------------------------------------------
Route::get('api/DetOrderSales/search/{id?}',['as'=>'person_search', 'uses'=>'DetOrderSalesController@searchDetalle']);
Route::put('api/DetOrderSales/edit',['as'=>'person_edit', 'uses'=>'DetOrderSalesController@edit']);
//Route::put('api/DetSeparateSales/edit',['as'=>'person_edit', 'uses'=>'DetOrderSalesController@edit']);

//-----------------------------Separate---------------------------
Route::group(['middleware' => 'role-cashier'], function () {
    Route::get('separateSales', ['as' => 'person', 'uses' => 'SeparateSaleController@index']);
    Route::get('separateSales/create', ['as' => 'person_create', 'uses' => 'SeparateSaleController@index']);
    Route::get('separateSales/edit/{id?}', ['as' => 'person_edit', 'uses' => 'SeparateSaleController@index']);
    Route::get('separateSales/form-create', ['as' => 'person_form_create', 'uses' => 'SeparateSaleController@form_create']);
    Route::get('separateSales/form-edit', ['as' => 'person_form_edit', 'uses' => 'SeparateSaleController@form_edit']);
});
Route::get('api/separateSales/all',['as'=>'person_all', 'uses'=>'SeparateSaleController@all']);
Route::get('api/separateSales/paginate/',['as' => 'person_paginate', 'uses' => 'SeparateSaleController@paginatep']);
Route::post('api/separateSales/create',['as'=>'person_create', 'uses'=>'SeparateSaleController@create']);
Route::put('api/separateSales/edit',['as'=>'person_edit', 'uses'=>'SeparateSaleController@edit']);
Route::post('api/separateSales/destroy',['as'=>'person_destroy', 'uses'=>'SeparateSaleController@destroy']);
Route::get('api/separateSales/search/{q}/{x}',['as'=>'person_search', 'uses'=>'SeparateSaleController@search']);
Route::get('api/separateSales/find/{id}',['as'=>'person_find', 'uses'=>'SeparateSaleController@find']);

//--------------------------------------------------------------
Route::get('api/DetSeparateSales/search/{id?}',['as'=>'person_search', 'uses'=>'DetSeparateSalesController@searchDetalle']);
Route::put('api/DetSeparateSales/edit',['as'=>'person_edit', 'uses'=>'DetSeparateSalesController@edit']);

Route::post('api/cardexUltimoDia/generate/{tipo}/{fecha}/{tienda}','PurchasesController@cardexUltimoDia');
Route::post('api/cardexRangoFechas/create/{fechaini}/{fechafin}/{tipo}/{tienda}','PurchasesController@cardexRangoFechas');
Route::post('api/cardexTopPrimero/generate/{fecha}/{tienda}/{tipo}','PurchasesController@cardexTopPrimero');
Route::post('api/cardextopUnoRFechas/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardextopUnoRFechas');
Route::post('api/cardextopUnomen/generate/{fecha}/{tienda}/{tipo}','PurchasesController@cardextopUnomen');
Route::post('api/cardextopUnomenRFechas/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardextopUnomenRFechas');
Route::post('api/cardextop10mejores/generate/{fecha}/{tienda}/{tipo}','PurchasesController@cardextop10mejores');
Route::post('api/cardextop10mejoreRFechas/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardextop10mejoreRFechas');
Route::post('api/cardextop10Peores/generate/{fecha}/{tienda}/{tipo}','PurchasesController@cardextop10Peores');
Route::post('api/cardextop10peoresFechas/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardextop10peoresFechas');
Route::post('api/reportMovimientoVarianteDMA/generate/{tipo}/{fecha}/{tienda}/{var}','PurchasesController@reportMovimientoVarianteDMA');
Route::post('api/reportMovimientosVarianteRangoF/create/{fechaini}/{fechafin}/{tipo}/{tienda}/{var}','PurchasesController@reportMovimientosVarianteRangoF');


Route::post('api/Factura','SalesController@reporteFactura');
Route::post('api/TiketReportCompra2/create/{id}','PurchasesController@reportes2');
Route::post('api/TiketReportCompra3/create/{id}','PurchasesController@reportes3');
Route::post('api/TiketReport2/create/{id}','VariantsController@reportes2');
Route::post('api/TiketReport3/create/{id}','VariantsController@reportes3');
Route::post('api/Reportedetcash/create/{id}','CashesController@Reportedetcash');
Route::post('api/ReportCashes/create/{fechaini}/{fechafin}','CashesController@ReportCashes');
Route::post('api/ReportVentas/create/{fechaini}/{fechafin}','SalesController@ReportVentas');
Route::post('api/ReportMejoresCliente/create/{fechaini}/{fechafin}/{cant}','PurchasesController@ReportMejoresCliente');
Route::post('api/ReportMejoresEmpleados/create/{fechaini}/{fechafin}/{cant}','PurchasesController@ReportMejoresEmpleados');
Route::post('api/ReportePedidos/create/{fechaini}/{fechafin}/{tipo}/{estado}','SeparateSaleController@ReportePedidos');

Route::get('api/listarVentasDia/search',['as'=>'person_search', 'uses'=>'DetSalesController@listarVentasDia']);
Route::get('api/listarVentasDiaSep/search',['as'=>'person_search', 'uses'=>'DetSeparateSalesController@listarVentasDia']);

Route::get('api/cantidadProductos/cantidades',['as'=>'person_search', 'uses'=>'ProductsController@cantidadProductos']);

Route::post('api/reporteCajaMensual/create/{fechaini}/{fechafin}/{concepto}','CashMonthlyController@reporteCajaMensual');

Route::post('api/cardextopUnoRFechasProduct/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardextopUnoRFechasProduct');
Route::post('api/cardextopmenRFechasProduct/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardextopmenRFechasProduct');
Route::post('api/cardexto10masFechasProduct/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardexto10masFechasProduct');
Route::post('api/cardexto10menFechasProduct/create/{fechaini}/{fechafin}/{tienda}/{tipo}','PurchasesController@cardexto10menFechasProduct');
Route::post('api/cardexProductsTipeMov/create/{fechaini}/{fechafin}/{tipo}/{tienda}/{id}','PurchasesController@cardexProductsTipeMov');
Route::post('api/cardexPagoProveedores/create/{fechaini}/{fechafin}','PurchasesController@cardexPagoProveedores');
Route::post('api/ReportDetCashes/create/{fechaini}/{fechafin}','PurchasesController@ReportDetCashesResumido');
Route::post('api/ReportDetCashes2/create/{fechaini}/{fechafin}','PurchasesController@ReportDetCashesDetallado');

