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


Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();




Route::get('/admin/move/{mtype}/{action}/id/{id}', 'AdminController@moveItem');

Route::any('/Listing/{id}/Contact/', 'HomeController@sendContact');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/Create', 'MyListingsController@index')->name('create');
Route::post('/Create', 'MyListingsController@store');
Route::get('/listing/{id}', 'HomeController@viewlisting')->name('view');
 
Route::get('/MyAlerts', 'MyListingsController@myalerts')->name('myalerts');
Route::get('/MyListings', 'MyListingsController@mylistings')->name('myproperties');

Route::get('/MyAccount', 'MyListingsController@myaccount')->name('myaccount');

Route::post('/MyAccount', 'MyListingsController@myaccountsave');

Route::any('/alerts/add', 'MyListingsController@addalert');

Route::any('/search', 'HomeController@search')->name('search');


Route::get('/admin', 'AdminController@index');

Route::get('/users', 'AdminController@users');
Route::get('/adminlistings', 'AdminController@listings');
Route::get('/admin/categories', 'AdminController@categoryListings');
Route::get('/adminregions', 'AdminController@alerts');



Route::get('/AdminUser', 'AdminController@user');
Route::post('/AdminUser', 'AdminController@usersave');

Route::get('/AdminListings', 'AdminController@listings');
Route::get('/AdminListing', 'AdminController@listing');
Route::post('/AdminListing', 'AdminController@listingsave');



Route::get('/AdminListing', 'AdminController@listingcategory');

Route::post('/AdminListing', 'AdminController@listingcategorysave');


Route::get('/admin/user/delete/{id}', 'AdminController@deleteUser');
Route::get('/admin/user/add', 'AdminController@addUser');
Route::post('/admin/user/add', 'AdminController@userSave');
Route::get('/admin/user/edit/{id}', 'AdminController@editUser');
Route::post('/admin/user/edit/{id}', 'AdminController@userSave');



Route::get('/admin/listing/delete/{id}', 'AdminController@deleteListing');
Route::get('/admin/listing/add', 'AdminController@addListing');
Route::post('/admin/listing/add', 'AdminController@listingSave');
Route::get('/admin/listing/edit/{id}', 'AdminController@editListing');
Route::post('/admin/listing/edit/{id}', 'AdminController@listingSave');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/listings', 'AdminController@listings');
Route::get('/admin/listings/approved', 'AdminController@listingsUnApproved');

Route::get('/admin/category/edit/{id}', 'AdminController@editCategoryListing');
Route::post('/admin/category/edit/{id}', 'AdminController@categorySave');


Route::get('/admin/listing/approve/{id}', 'AdminController@approveListing');
Route::get('/admin/listing/unapprove/{id}', 'AdminController@unapproveListing');



Route::get('/admin/region/delete/{id}', 'AdminController@deleteRegion');
Route::get('/admin/region/edit/{id}', 'AdminController@editRegion');
Route::post('/admin/region/edit/{id}', 'AdminController@regionSave');
Route::post('/admin/region/add', 'AdminController@regionSave');

Route::get('/admin/listing/delete/{id}', 'AdminController@deleteListing');
Route::get('/admin/category/delete/{id}', 'AdminController@deleteCategory');
Route::get('/admin/user/region/{id}', 'AdminController@deleteRegion');

Route::get('/admin/category/add', 'AdminController@addCategory');
Route::post('/admin/category/add', 'AdminController@categorySave');
Route::get('/admin/region/add', 'AdminController@addRegion');


Route::get('/admin/regions', 'AdminController@regions');
Route::get('/admin/alerts', 'AdminController@alerts');

Route::get('/listing/edit/{id}', 'MyListingsController@editListing');

Route::get('/alert/edit/{id}', 'MyListingsController@editAlert');
Route::get('/alert/delete/{id}', 'MyListingsController@deleteAlert');

Route::post('/listing/delete/{id}', 'MyListingsController@delete');



