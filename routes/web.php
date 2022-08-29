<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('backend.dashboard');
})->middleware(['auth'])->name('dashboard');


Route::group(['prefix'=>'/admin'],function(){
    Route::group(['prefix'=>'/product'],function(){
    Route::get('/create','App\Http\Controllers\Backend\ProductController@create')->name('createproduct');
    Route::post('/insert','App\Http\Controllers\Backend\ProductController@store')->name('insert');
    Route::get('/manage','App\Http\Controllers\Backend\ProductController@index')->name('manage');
    Route::get('/edit/{id}','App\Http\Controllers\Backend\ProductController@edit')->name('edit');
    Route::post('/update/{id}','App\Http\Controllers\Backend\ProductController@update')->name('update');
    Route::get('/delete/{id}','App\Http\Controllers\Backend\ProductController@delete')->name('delete');
});
Route::group(['prefix'=>'/catogory'],function(){
    Route::get('/create','App\Http\Controllers\Backend\CategoryController@create')->name('catcreate');
    Route::post('/catinsert','App\Http\Controllers\Backend\CategoryController@store')->name('catinsert');
    Route::get('/manage','App\Http\Controllers\Backend\CategoryController@index')->name('catmanage');
    Route::get('/catshow','App\Http\Controllers\Backend\CategoryController@catshow')->name('catshow');
    Route::get('/catedit/{id}','App\Http\Controllers\Backend\CategoryController@catedit')->name('catedit');
    Route::post('/update/{id}','App\Http\Controllers\Backend\CategoryController@update')->name('catupdate');
    Route::get('/delete/{id}','App\Http\Controllers\Backend\CategoryController@delete')->name('catdelete');
    });
    
    Route::group(['prefix'=>'/subcategory'],function(){
        Route::get('/create','App\Http\Controllers\Backend\SubcategoryController@create')->name('subcategorycreate');
        Route::post('/insert','App\Http\Controllers\Backend\SubcategoryController@store')->name('subcategoryinsert');
        Route::get('/manage','App\Http\Controllers\Backend\SubcategoryController@index')->name('subcategorymanage');
        Route::get('/edit/{id}','App\Http\Controllers\Backend\SubcategoryController@edit')->name('subcategoryedit');
        Route::post('/update/{id}','App\Http\Controllers\Backend\SubcategoryController@update')->name('subcategoryupdate');
        Route::get('/delete/{id}','App\Http\Controllers\Backend\SubcategoryController@delete')->name('subcategorydelete');
    });

    Route::group(['prefix'=>'/item'],function(){
        Route::get('/create','App\Http\Controllers\Backend\ItemsController@create')->name('item.create');
        Route::post('/insert','App\Http\Controllers\Backend\ItemsController@store')->name('item.store');
        Route::get('/manage','App\Http\Controllers\Backend\ItemsController@index')->name('item.manage');
        Route::get('/edit/{id}','App\Http\Controllers\Backend\ItemsController@edit')->name('item.edit');
        Route::post('/update/{id}','App\Http\Controllers\Backend\ItemsController@update')->name('item.update');
        Route::post('/update/singleImage/{id}','App\Http\Controllers\Backend\ItemsController@updatesingImage')->name('item.single.update');
        Route::get('/delete/{id}','App\Http\Controllers\Backend\ItemsController@destroy')->name('item.delete');
        Route::get('/delete/image/{id}','App\Http\Controllers\Backend\ItemsController@deletesingleImage')->name('item.image.delete');
    });
});
require __DIR__.'/auth.php';
