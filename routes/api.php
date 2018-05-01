<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// List roletype
Route::get('roletypes', 'roletypeController@index');

// List single roletype
Route::get('roletype/{id}', 'roletypeController@show');

// Create new roletype
Route::post('roletype', 'roletypeController@store');

// Update roletype
Route::put('roletype', 'roletypeController@store');

// Delete roletype
Route::delete('roletype/{id}', 'roletypeController@destroy');

#Account routes
// List account
Route::get('accounts', 'AccountController@index');
// List single account
Route::get('account/{id}', 'AccountController@show');
// Create new account
Route::post('account', 'AccountController@store');
// Update account
Route::put('account', 'AccountController@store');
// Delete account
Route::delete('account/{id}', 'AccountController@destroy');

#Company Routes
// List companies
Route::get('companies', 'CompanyController@index');
// List single company
Route::get('company/{id}', 'CompanyController@show');
// Create new company
Route::post('company', 'CompanyController@store');
// Update company
Route::put('company', 'CompanyController@store');
// Delete company
Route::delete('company/{id}', 'CompanyController@destroy');


#Contact Routes
// List Contacts
Route::get('contacts', 'ContactController@index');
// List single Contact
Route::get('contact/{id}', 'ContactController@show');
// Create new Contact
Route::post('contact', 'ContactController@store');
// Update Contact
Route::put('contact', 'ContactController@store');
// Delete Contact
Route::delete('contact/{id}', 'ContactController@destroy');

#Block Routes
// List Blocks
Route::get('blocks', 'BlockController@index');
// List single Blocks
Route::get('block/{id}', 'BlockController@show');
// Create new Blocks
Route::post('block', 'BlockController@store');
// Update Blocks
Route::put('block', 'BlockController@store');
// Delete Blocks
Route::delete('block/{id}', 'BlockController@destroy');

#Block Status Routes
// List block status
Route::get('blockstats', 'BlockStatController@index');
// List block status
Route::get('blockstat/{id}', 'BlockStatController@show');
// Create new block status
Route::post('blockstat', 'BlockStatController@store');
// Update block status
Route::put('blockstat', 'BlockStatController@store');
// Delete block status
Route::delete('blockstat/{id}', 'BlockStatController@destroy');

#Module Status Routes
// List block status
Route::get('modules', 'ModuleController@index');
// List block status
Route::get('module/{id}', 'ModuleController@show');
// Create new block status
Route::post('module', 'ModuleController@store');
// Update block status
Route::put('module', 'ModuleController@store');
// Delete block status
Route::delete('module/{id}', 'ModuleController@destroy');

#Model Status Routes
// List model
Route::get('models', 'ModelController@index');
// List block status
Route::get('model/{id}', 'ModelController@show');
// Create new block status
Route::post('model', 'ModelController@store');
// Update block status
Route::put('model', 'ModelController@store');
// Delete block status
Route::delete('model/{id}', 'ModelController@destroy');

#Spares Status Routes
// List spares
Route::get('spares', 'SparesController@index');
// List block status
Route::get('spare/{id}', 'SparesController@show');
// Create new block status
Route::post('spare', 'SparesController@store');
// Update block status
Route::put('spare', 'SparesController@store');
// Delete block status
Route::delete('spare/{id}', 'SparesController@destroy');

#Asset Routes
// List Assets
Route::get('assets', 'AssetController@index');
// List asset status
Route::get('asset/{id}', 'AssetController@show');
// Create new asset status
Route::post('asset', 'AssetController@store');
// Update asset status
Route::put('asset', 'AssetController@store');
// Delete asset status
Route::delete('asset/{id}', 'AssetController@destroy');

#Asset Model Routes
// List Asset Models
Route::get('assetmodels', 'AssetModelController@index');
// List asset model 
Route::get('assetmodel/{id}', 'AssetModelController@show');
// Create new asset model
Route::post('assetmodel', 'AssetModelController@store');
// Update asset model
Route::put('assetmodel', 'AssetModelController@store');
// Delete asset model
Route::delete('assetmodel/{id}', 'AssetModelController@destroy');

# Model Type Routes
// List Model Types
Route::get('modelTypes', 'modelTypeController@index');
// List asset model 
Route::get('modelType/{id}', 'modelTypeController@show');
// Create new asset model
Route::post('modelType', 'modelTypeController@store');
// Update asset model
Route::put('modelType', 'modelTypeController@store');
// Delete asset model
Route::delete('modelType/{id}', 'modelTypeController@destroy');

# Account Block Association Routes
// List Account Block Associations Types
Route::get('accountblockassociations', 'AccountBlockAssociationController@index');
// List Account Block Association 
Route::get('accountblockassociation/{id}', 'AccountBlockAssociationController@show');
// Create new Account Block Association
Route::post('accountblockassociation', 'AccountBlockAssociationController@store');
// Update Account Block Association
Route::put('accountblockassociation', 'AccountBlockAssociationController@store');
// Delete Account Block Association
Route::delete('accountblockassociation/{id}', 'AccountBlockAssociationController@destroy');

# Customer Block Association Routes
// List Customer Block Associations
Route::get('customerblockassociations', 'CustomerBlockAssociationController@index');
// List Customer Block Association 
Route::get('customerblockassociation/{id}', 'CustomerBlockAssociationController@show');
// Create new Customer Block Association
Route::post('customerblockassociation', 'CustomerBlockAssociationController@store');
// Update Customer Block Association
Route::put('customerblockassociation', 'CustomerBlockAssociationController@store');
// Delete Customer Block Association
Route::delete('customerblockassociation/{id}', 'CustomerBlockAssociationController@destroy');

# Customer Block Module Activity Routes
// Customer Block Module Activities
Route::get('customerblockmoduleactivities', 'CustomerBlockModuleActivityController@index');
// Customer Block Module Activity
Route::get('customerblockmoduleactivity/{id}', 'CustomerBlockModuleActivityController@show');
// Create new Customer Block Module Activity
Route::post('customerblockmoduleactivity', 'CustomerBlockModuleActivityController@store');
// Update Customer Block Module Activity
Route::put('customerblockmoduleactivity', 'CustomerBlockModuleActivityController@store');
// Delete Customer Block Module Activity
Route::delete('customerblockmoduleactivity/{id}', 'CustomerBlockModuleActivityController@destroy');

# Activity Routes
// List Activities
Route::get('activities', 'ActivityController@index');
//  Activity
Route::get('activity/{id}', 'ActivityController@show');
// Create new Activity
Route::post('activity', 'ActivityController@store');
// Update Activity
Route::put('activity', 'ActivityController@store');
// Delete Activity
Route::delete('activity/{id}', 'ActivityController@destroy');

# Label Routes
// List Labels
Route::get('labelnames', 'LabelNameController@index');
//  Activity
Route::get('labelname/{id}', 'LabelNameController@show');
// Create new Activity
Route::post('labelname', 'LabelNameController@store');
// Update Activity
Route::put('labelname', 'LabelNameController@store');
// Delete Activity
Route::delete('labelname/{id}', 'LabelNameController@destroy');

# Job Type Routes
// List job types
Route::get('jobTypes', 'jobTypeController@index');
//  get one job type
Route::get('jobType/{id}', 'jobTypeController@show');
// Create new job type
Route::post('jobType', 'jobTypeController@store');
// Update job type
Route::put('jobType', 'jobTypeController@store');
// Delete job type
Route::delete('jobType/{id}', 'jobTypeController@destroy');

# Job Priority Routes
// List job Priorities
Route::get('jobpriorities', 'JobPriorityController@index');
//  get one job Priority
Route::get('jobpriority/{id}', 'JobPriorityController@show');
// Create new job Priority
Route::post('jobpriority', 'JobPriorityController@store');
// Update job Priority
Route::put('jobpriority', 'JobPriorityController@store');
// Delete job Priority
Route::delete('jobpriority/{id}', 'JobPriorityController@destroy');

# Documentation Type Routes
// List Documentation Types
Route::get('documentationTypes', 'documentationTypeController@index');
//  get one Documentation Type
Route::get('documentationType/{id}', 'documentationTypeController@show');
// Create new Documentation Type
Route::post('documentationType', 'documentationTypeController@store');
// Update Documentation Type
Route::put('documentationType', 'documentationTypeController@store');
// Delete Documentation Type
Route::delete('documentationType/{id}', 'documentationTypeController@destroy');

# Fault Type Routes
// List Fault Types
Route::get('faulttypes', 'FaultTypeController@index');
//  get one Fault Type
Route::get('faulttype/{id}', 'FaultTypeController@show');
// Create new Fault Type
Route::post('faulttype', 'FaultTypeController@store');
// Update Fault Type
Route::put('faulttype', 'FaultTypeController@store');
// Delete Fault Type
Route::delete('faulttype/{id}', 'FaultTypeController@destroy');

# Asset Image Record Routes
// List Asset Image Records
Route::get('assetimagerecords', 'AssetImageRecordController@index');
//  get each Asset Image Record
Route::get('assetimagerecord/{id}', 'AssetImageRecordController@show');
// Create new Asset Image Record
Route::post('assetimagerecord', 'AssetImageRecordController@store');
// Update Asset Image Record
Route::put('assetimagerecord', 'AssetImageRecordController@store');
// Delete Asset Image Record
Route::delete('assetimagerecord/{id}', 'AssetImageRecordController@destroy');