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

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@redirect');

Route::get('login', 'AccountController@showLogin');

Route::post('login', 'AccountController@doLogin');

Route::get('logout', array('uses' => 'AccountController@logout'));

/**
	Company Routes
*/

Route::get('company/create', 'CompanyController@getCreate');

Route::post('company/create', 'CompanyController@postCreate');

Route::get('company/{id}/edit', 'CompanyController@getEdit');

Route::post('company/{id}/edit/', 'CompanyController@postEdit');

Route::get('company/{id}/view', 'CompanyController@getView');

Route::get('company', 'CompanyController@getList');

Route::get('company/{id}/delete', 'CompanyController@delete');

/**
	Employee Routes
*/

Route::get('employee/create', 'EmployeeController@getCreate');

Route::post('employee/create', 'EmployeeController@postCreate');

Route::get('employee/{id}/edit', 'EmployeeController@getEdit');

Route::post('employee/{id}/edit/', 'EmployeeController@postEdit');

Route::get('employee/{id}/view', 'EmployeeController@getView');

Route::get('employee', 'EmployeeController@getList');

Route::get('employee/{id}/delete', 'EmployeeController@delete');

/**
	Document Routes
*/

Route::get('document/create', 'DocumentController@getCreate');

Route::post('document/create', 'DocumentController@postCreate');

Route::get('document/{id}/edit', 'DocumentController@getEdit');

Route::post('document/{id}/edit/', 'DocumentController@postEdit');

Route::get('document/{id}/view', 'DocumentController@getView');

Route::get('document', 'DocumentController@getList');

Route::get('document/{id}/delete', 'DocumentController@delete');

/**
	Document Type Routes
*/

Route::get('document-type/create', 'DocumentController@getCreateType');

Route::post('document-type/create', 'DocumentController@postCreateType');

Route::get('document-type/{id}/edit', 'DocumentController@getEditType');

Route::post('document-type/{id}/edit/', 'DocumentController@postEditType');

Route::get('document-type/{id}/view', 'DocumentController@getViewType');

Route::get('document-type', 'DocumentController@getListType');

Route::get('document-type/{id}/delete', 'DocumentController@deleteType');

Route::controllers([
	'auth' => 'AccountController',
	'password' => 'Auth\PasswordController',
]);
