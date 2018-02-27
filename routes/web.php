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

// Routes for homeController
Route::get('/home', 'WebControllers\homeController@getHome')->name('home');

//Routes for aboutUsController
Route::get('/aboutUs', 'WebControllers\aboutUsController@getAboutUs')->name('aboutUs');
Route::get('/UAF', 'WebControllers\aboutUsController@getUAF')->name('UAF');
Route::get('/UAFIntregral', 'WebControllers\aboutUsController@getUAFIntegral')->name('IntegralUAF');
Route::get('/UAFUnity', 'WebControllers\aboutUsController@getUnity')->name('Unity');

//Routes for glossaryController
Route::get('/glossary', 'WebControllers\glossaryController@getGlossary')->name('glossary');
Route::get('/glossary/word/{id}', 'WebControllers\glossaryController@searchWords')->name('searchWords');
Route::get('/glossary/definition/{id}', 'WebControllers\glossaryController@searchDefinition')->name('searchDefinition');

//Routes for servicesController
Route::get('/services', 'WebControllers\servicesController@getServices')->name('services');
Route::get('/services/zones/{name}', 'WebControllers\servicesController@getZones')->name('optionsZones');
Route::get('/service/{name}', 'WebControllers\servicesController@getPrevServices')->name('prevDepartament');

//Routes for zoneController
Route::post('/zone', 'WebControllers\zoneController@getZone')->name('zone');
Route::get('/zone/elements/{id}', 'WebControllers\zoneController@getClimaticElements')->name('zoneElements');
Route::get('/zone/characteristics/{id}', 'WebControllers\zoneController@getSocioeconomicCharacteristics')->name('zoneCharacteristics');
Route::get('/zone/prevZone/{name}', 'WebControllers\zoneController@getPrevZone')->name('prevZone');

//Routes for systemController
Route::get('/listSystem/{idZone}', 'WebControllers\systemController@getListSystem')->name('listSystem');
Route::get('/changeSystem/{idSystem}', 'WebControllers\systemController@changeSystem')->name('changeSystem');
Route::get('/System/{idSystem}', 'WebControllers\systemController@getSystem')->name('system');
Route::get('/System/Entry/{idEntry}', 'WebControllers\systemController@getCharacteristicsEntry')->name('entryCharacteristics');
Route::get('/System/Cost/{idSystem}', 'WebControllers\systemController@getCosts')->name('systemCost');
Route::get('/System/Indicators/{idSystem}', 'WebControllers\systemController@getIndicators')->name('systemIndicators');

//Routes for adminController
Route::get('/admin', 'AppControllers\adminController@getListUsers')->middleware('auth')->name('admin');
Route::get('/admin/newUser/{id}', 'AppControllers\adminController@getUser')->middleware('auth')->name('getUser');
Route::get('/admin/editIndicators', 'AppControllers\adminController@getEditIndicators')->middleware('auth')->name('editIndicators');
Route::post('/admin/saveUser', 'AppControllers\adminController@saveUser')->name('saveUser');
Route::post('/admin/saveIndicators', 'AppControllers\adminController@saveIndicators')->name('saveIndicators');
Route::get('/admin/deleteUser/{id}', 'AppControllers\adminController@deleteUser')->name('userDelete');

//Routes for cartographerController
Route::get('/cartographer', 'AppControllers\cartographerController@cartographerPanel')->middleware('auth')->name('cartographer');
Route::get('/cartographer/{idDepartament}', 'AppControllers\cartographerController@getListZones')->name('listZones');
Route::get('/cartographer/zone/{idZone}/departament/{idDepartament}', 'AppControllers\cartographerController@getZone')->name('getZone');
Route::post('/cartographer/saveZone', 'AppControllers\cartographerController@saveZone')->name('saveZone');







//localhost/uafApp/public/System/Indicators/339

//Routes for admin

// Route::get('/indicators', function () {
//     return view('app.replics.admin.indicators');
// })->name('userIndicators');
//
// // Route::get('/newUser', function () {
// //     return view('app.replics.admin.adminNewUser');
// // })->name('newUser');
//
// Route::get('expert', function () {
//     return view('app.expert');
// });
//
// Route::get('systemList', function () {
//     return view('web.listProductiveSystems');
// });

// Route::get('system', function () {
//     return view('web.system');
// });



// Route::get('/services/zones/{name}', 'WebControllers\servicesController@getZones')->name('test');

// Route::get('/cartographer', function () {
//     return view('cartographer');
// })->name('cartographerView');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
