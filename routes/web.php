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

//Routes for admin
Route::get('/admin', 'AppControllers\adminController@getAdminView')->middleware('auth')->name('admin');
Route::get('/indicators', function () {
    return view('app.replics.admin.indicators');
})->name('userIndicators');

Route::get('/newUser', function () {
    return view('app.replics.admin.adminNewUser');
})->name('newUser');

Route::get('expert', function () {
    return view('app.expert');
});

Route::get('systemList', function () {
    return view('web.listProductiveSystems');
});

// Route::get('system', function () {
//     return view('web.system');
// });



// Route::get('/services/zones/{name}', 'WebControllers\servicesController@getZones')->name('test');

Route::get('/cartographer', function () {
    return view('cartographer');
})->name('cartographerView');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');