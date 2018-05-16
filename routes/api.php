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
// List Contacts By Company id
Route::get('contacts/company/{id}', 'ContactController@contactsByCompanyId');

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
Route::get('blockStats', 'BlockStatController@index');
// List block status
Route::get('blockStat/{id}', 'BlockStatController@show');
// Create new block status
Route::post('blockStat', 'BlockStatController@store');
// Update block status
Route::put('blockStat', 'BlockStatController@store');
// Delete block status
Route::delete('blockStat/{id}', 'BlockStatController@destroy');

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
Route::get('spares', 'SpareController@index');
// List block status
Route::get('spare/{id}', 'SpareController@show');
// Create new block status
Route::post('spare', 'SpareController@store');
// Update block status
Route::put('spare', 'SpareController@store');
// Delete block status
Route::delete('spare/{id}', 'SpareController@destroy');

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

Route::post('/attachments/store', 'AssetController@storeAttachments')->name('store-attachments');
Route::get('asset/attachments/{ids}', 'AssetController@pullAttachments')->name('pull-attachments');
Route::delete('/attachments/', 'AssetController@deleteAttachment')->name('delete-attachment');

#Asset Model Routes
// List Asset Models
Route::get('assetModels', 'AssetModelController@index');
// List asset model 
Route::get('assetModel/{id}', 'AssetModelController@show');
// Create new asset model
Route::post('assetModel', 'AssetModelController@store');
// Update asset model
Route::put('assetModel', 'AssetModelController@store');
// Delete asset model
Route::delete('assetModel/{id}', 'AssetModelController@destroy');

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
Route::get('accountBlockAssociations', 'AccountBlockAssociationController@index');
// List Account Block Association 
Route::get('accountBlockAssociation/{id}', 'AccountBlockAssociationController@show');
// Create new Account Block Association
Route::post('accountBlockAssociation', 'AccountBlockAssociationController@store');
// Update Account Block Association
Route::put('accountBlockAssociation', 'AccountBlockAssociationController@store');
// Delete Account Block Association
Route::delete('accountBlockAssociation/{id}', 'AccountBlockAssociationController@destroy');

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
Route::get('labels', 'LabelController@index');
//  Activity
Route::get('label/{id}', 'LabelController@show');
// Create new Activity
Route::post('label', 'LabelController@store');
// Update Activity
Route::put('label', 'LabelController@store');
// Delete Activity
Route::delete('label/{id}', 'LabelController@destroy');

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
Route::get('jobPriorities', 'jobPriorityController@index');
//  get one job Priority
Route::get('jobPriority/{id}', 'jobPriorityController@show');
// Create new job Priority
Route::post('jobPriority', 'jobPriorityController@store');
// Update job Priority
Route::put('jobPriority', 'jobPriorityController@store');
// Delete job Priority
Route::delete('jobPriority/{id}', 'jobPriorityController@destroy');

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

# Document Routes
// List documents
Route::get('documents', 'DocumentController@index');
//  get one manufacturer type
Route::get('document/{id}', 'DocumentController@show');
// Create new manufacturer type
Route::post('document', 'DocumentController@store');
// Update manufacturer
Route::put('document', 'DocumentController@store');
// Delete manufacturer
Route::delete('document/{id}', 'DocumentController@destroy');

# Fault Type Routes
// List Fault Types
Route::get('faultTypes', 'faultTypeController@index');
//  get one Fault Type
Route::get('faultType/{id}', 'faultTypeController@show');
// Create new Fault Type
Route::post('faultType', 'faultTypeController@store');
// Update Fault Type
Route::put('faultType', 'faultTypeController@store');
// Delete Fault Type
Route::delete('faultType/{id}', 'faultTypeController@destroy');

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

# Spare Types Routes
// List spare types
Route::get('spareTypes', 'SpareTypeController@index');
//  get one spare type
Route::get('spareType/{id}', 'SpareTypeController@show');
// Create new job type
Route::post('spareType', 'SpareTypeController@store');
// Update spare type
Route::put('spareType', 'SpareTypeController@store');
// Delete spare type
Route::delete('spareType/{id}', 'SpareTypeController@destroy');

# Manufacturer Routes
// List manufacturer types
Route::get('manufacturers', 'ManufacturerController@index');
//  get one manufacturer type
Route::get('manufacturer/{id}', 'ManufacturerController@show');
// Create new manufacturer type
Route::post('manufacturer', 'ManufacturerController@store');
// Update manufacturer
Route::put('manufacturer', 'ManufacturerController@store');
// Delete manufacturer
Route::delete('manufacturer/{id}', 'ManufacturerController@destroy');

# Quality Routes
// List qualities
Route::get('qualities', 'QualityController@index');
//  Quality
Route::get('quality/{id}', 'QualityController@show');
// Create new Quality
Route::post('quality', 'QualityController@store');
// Update Quality
Route::put('quality', 'QualityController@store');
// Delete Quality
Route::delete('quality/{id}', 'QualityController@destroy');

# Asset Locations Routes
// List Locations
Route::get('assetLocations', 'AssetLocationController@index');
//  get individual location
Route::get('assetLocation/{id}', 'AssetLocationController@show');
// Create new location
Route::post('assetLocation', 'AssetLocationController@store');
// Update location
Route::put('assetLocation', 'AssetLocationController@store');
// Delete location
Route::delete('assetLocation/{id}', 'AssetLocationController@destroy');

# repair type Routes
// List types
Route::get('repairTypes', 'RepairTypeController@index');
//  get individual type
Route::get('repairType/{id}', 'RepairTypeController@show');
// Create new type
Route::post('repairType', 'RepairTypeController@store');
// Update type
Route::put('repairType', 'RepairTypeController@store');
// Delete type
Route::delete('repairType/{id}', 'RepairTypeController@destroy');