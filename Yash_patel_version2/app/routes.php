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

Route::get('/', function()
{
	return View::make('home');
});

/**
 *  Unauthenticated group
 *  User
 */

Route::group(array('before' => 'guest'), function(){

	Route::group(array('before' => 'csrf'), function(){

		//put all post related routes here for csrf filter
		Route::post('account/signup', 'UserController@postSignup');
		Route::post('account/signin', 'UserController@postSignin');

	});

	// login routes
	Route::get('/', 'UserController@getSignin');
	Route::get('account/signin', 'UserController@getSignin');
	
	// routes for account signup page
	Route::get('account/signup', 'UserController@getSignup');
	
});


/**
 *  Authenticated group
 *  User
 */

Route::group(array('before' => 'auth'), function(){

	Route::group(array('before' => 'csrf'), function(){

		// User profile
		Route::post('user/profile/{id}', 'UserController@postProfile');

	});
	
	Route::post('patient/add', array('as'=>'addPatient', 'uses'=>'PatientController@addPatient' ));

	Route::get('patient/create', array('as'=>'patient.create', 'uses'=>'PatientController@create'));
	
	Route::get('account/signout', array('as'=>'signout', 'uses'=>'UserController@getSignout'));

	// User profile
	Route::get('user/profile/{id}', array('as'=>'getProfile', 'uses'=>'UserController@getProfile'));

	// dashboard
	Route::get('dashboard','DashboardController@getDashboard');

});
Route::get('system',array('as' => 'system', 'uses' => 'SystemController@getparameters'));
Route::post('saved',array('as'=>'saved','uses'=>'SystemController@postparameters'));
Route::get('additem',array('as' => 'additem', 'uses' => 'InventoryController@getadditem'));
Route::post('itemadded',array('as' => 'itemadded', 'uses'=>'InventoryController@postitemadded'));
Route::get('inventory/sales_categories',array('as' => 'sales_categories', 'uses' => 'CategoriesController@get_add_new'));
Route::post('category_saved',array('as'=>'category_saved','uses'=>  'CategoriesController@post_add_new'));
Route::get('inventory/sales_categories/edit/{id}',array('as' => 'edit_categories', 'uses' => 'CategoriesController@get_edit'));
Route::post('category_edit',array('as'=>'category_edit','uses'=>  'CategoriesController@post_edit'));
Route::get('inventory/sales_categories/delete/{id}',array('as' => 'delete_categories', 'uses' => 'CategoriesController@get_delete'));
Route::get('add_supplier',array('as' => 'supplier', 'uses' => 'SupplierController@get_supplier'));
Route::post('supplier_saved',array('as' => 'supplier_saved', 'uses' => 'SupplierController@post_supplier'));
Route::get('locations',array('as' => 'locations','uses' => 'SystemController@getlocations'));
Route::post('locations_saved',array('locations_saved', 'uses' => 'SystemController@postlocations_saved'));
Route::get('locations/edit/{id}',array('as' => 'edit_locations','uses' => 'SystemController@geteditlocations'));
Route::get('locations/delete/{id}',array('as'=>'delete_locations','uses' => 'SystemController@getdeletelocations'));
Route::post('locations_edit',array('as' => 'locations_edit', 'uses' => 'SystemController@postlocations_edit'));
Route::get('purchase',array('as' => 'purchase', 'uses' => 'PurchaseController@getpurchase'));
Route::get('getdatasuppliers',function(){
	$cat = DB::table('suppliers')->get();
		$cat_selector = array();
		foreach ($cat as $ca)
		{
			$cat_selector[] = (string)$ca->supplier_name;
		}
		 $suppliers = DB::table('suppliers')->lists('supplier_name');
		return Response::json($suppliers);
});
Route::post('purchase_save',array('as' => 'purchase_save', 'uses' => 'PurchaseController@postpruchase'));
Route::get('price',array('as' => 'price', 'uses' => 'PriceController@getprice'));
Route::post('price_save',array('as' => 'price_save', 'uses' => 'PriceController@postprice'));
Route::get('add_purchase_order',array('as' => 'purchase_order','uses' => 'PurchaseController@get_purchase_order'));
Route::get('search_supplier','PurchaseController@search_supplier');
Route::get('search_item','PurchaseController@search_item');
Route::get('search_location','PurchaseController@search_location');
Route::get('save_order','PurchaseController@add_order');
Route::get('index','IndexController@gethomepage');
Route::get('listofitems',array('as' => 'listofitems', 'uses' => 'ListofitemsController@getlistofitems'));
Route::get('listoforder',array('as' => 'listoforder', 'uses' => 'ListoforderController@getlistoforder'));
Route::get('purchaseorder',array('as' => 'purchaseorder', 'uses' => 'NewpurchaseorderController@getpurchaseorder'));
Route::get('user_permission',array('as'=>'user_permission', 'uses'=>'LoginController@getuser_permission'));
Route::post('permission_save',array('as'=>'permission_save','uses'=>'LoginController@postpermission_save'));
Route::get('add_costumer', array('as'=>'add_costumer','uses'=>'AddcostumerController@getadd_costumer'));
Route::post('costumer_save',array('as'=>'costumer_save','uses'=>'AddcostumerController@postcostumer_save'));

Route::get('addsaleitem',array('as' => 'addsaleitem', 'uses' => 'SaleController@getaddsalesitem'));
Route::post('saleitemadded',array('as' => 'saleitemadded', 'uses'=>'SaleController@post_save'));