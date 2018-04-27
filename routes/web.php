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

//Route::get('/', function () {
//    return view('auth.login');
//});

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/verify/{verification_key}','SignupController@verify')->name('verify');
Route::get('/verified/{verification_key}','SignupController@verified')->name('verified');

Auth::routes();


//Admin routes
Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('admin', 'HomeController@index');
    Route::resource('admin/admin_users', 'AdminUsersController');

    //Route::get('admin/contact-lists/{contactList}/contacts', 'ContactListContactsController@contacts');
    Route::resource('admin/contact-lists/{selected_contact_list}/contacts', 'ContactListContactsController');
    Route::resource('admin/contact-lists', 'ContactListsController');

    Route::get('admin/contacts/{contact}/audit', 'ContactAuditController@index');
    Route::resource('admin/contacts', 'ContactsController');

//    Route::get('admin', function () {
//        return "Admin";
//    });
});

Route::get('/home', 'Admin\HomeController@index');