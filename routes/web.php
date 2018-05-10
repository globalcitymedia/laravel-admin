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
Route::get('/verify/{verification_key}', 'SignupController@verify')->name('verify');
Route::get('/verified/{verification_key}', 'SignupController@verified')->name('verified');
Route::get('/register', 'Auth\LoginController@showLoginForm');
Route::get('/users/register', function () {
    return redirect('/login');
});

Route::get('/glp-subscription', 'SignupController@glpSubscription');
Route::post('/glp-subscription', 'SignupController@saveGLPSubscription');


Auth::routes();


//Admin routes
Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('admin', 'HomeController@index');
    Route::resource('admin/admin_users', 'AdminUsersController');

    //Route::get('admin/contact-lists/{contactList}/contacts', 'ContactListContactsController@contacts');
    Route::resource('admin/contact-lists/{selected_contact_list}/contacts', 'ContactListContactsController');
    Route::resource('admin/contact-lists', 'ContactListsController');


    Route::post('admin/contacts/search', 'ContactsController@search');
    Route::get('admin/contacts/{contact}/audit', 'ContactAuditController@index');
    Route::resource('admin/contacts', 'ContactsController');
    Route::resource('admin/email-templates', 'EmailTemplateController');
    Route::resource('admin/schedule-tasks', 'ScheduleTaskController');

//    Route::get('admin', function () {
//        return "Admin";
//    });
});

Route::get('/home', 'Admin\HomeController@index');