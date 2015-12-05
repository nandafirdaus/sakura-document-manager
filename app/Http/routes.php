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

Route::get('company/rptka', 'CompanyController@getRptka');

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

Route::get('document/create/{kitasId}', 'DocumentController@getCreate');

Route::post('document/create/{kitasId}', 'DocumentController@postCreate');

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

/**
	KITAS Routes
*/

Route::get('kitas/create', 'KitasController@getCreate');

Route::post('kitas/create', 'KitasController@postCreate');

Route::get('kitas/{id}/edit', 'KitasController@getEdit');

Route::post('kitas/{id}/edit/', 'KitasController@postEdit');

Route::get('kitas/{id}/view', 'KitasController@getView');

Route::get('kitas', 'KitasController@getList');

Route::get('kitas/{id}/delete', 'KitasController@delete');

/**
	RPTKA Routes
*/

Route::get('rptka/create', 'RptkaController@getCreate');

Route::post('rptka/create', 'RptkaController@postCreate');

Route::get('rptka/{id}/edit', 'RptkaController@getEdit');

Route::post('rptka/{id}/edit/', 'RptkaController@postEdit');

Route::get('rptka/{id}/view', 'RptkaController@getView');

Route::get('rptka', 'RptkaController@getList');

Route::get('rptka/{id}/delete', 'RptkaController@delete');

/**
	Report Routes
*/

Route::get('report/document', 'ReportController@getDocumentReport');

Route::get('report/generate-document/{id}', 'ReportController@getGenerateDocument');

Route::get('report/employee-document', 'ReportController@getEmployeeDocument');

Route::get('report/download-document/{id}', 'ReportController@getDownloadEmployeeDocument');

Route::get('report/download-expired', 'ReportController@getExpiredDocumentsPerMonth');

Route::get('report/generate-expired/{monthStart}/{yearStart}/{monthEnd}/{yearEnd}', 'ReportController@getDownloadExpiredDocumentsPerMonth');

/**
	Expired Routes
*/

Route::get('expired/kitas', 'ExpiredController@getKitas');

Route::get('expired/passport', 'ExpiredController@getPassport');

Route::get('expired/rptka', 'ExpiredController@getRptka');

Route::get('expired/imta', 'ExpiredController@getImta');

/**
	User Routes
*/

Route::controllers([
	'auth' => 'AccountController',
	'password' => 'Auth\PasswordController',
]);
