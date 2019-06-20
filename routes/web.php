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

Route::get('/test', function () {
    return "TEst";
});

//Route::get('/users/register', function () {
//    return redirect('/login');
//});
Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/verify/{verification_key}', 'SignupController@verify')->name('verify');
Route::get('/verified/{verification_key}', 'SignupController@verified')->name('verified');

Route::get('/send-email-to-manage-preferences', 'ManageUserPreferenceController@sendManagePreferenceEmail');
Route::post('/send-email-to-manage-preferences', 'ManageUserPreferenceController@sendingManagePreferenceEmail');

Route::PATCH('/manage-preference/{email_id}', 'ManageUserPreferenceController@updateManagePreference');


Route::get('/unsubscribe/{tkn}', 'UnsubscribeController@unsubscribe');
Route::get('/unsubscribe/step2/{tkn}', 'UnsubscribeController@unsubscribeStep2');

Route::get('/manage-preference/{tkn}', 'ManageUserPreferenceController@managePreference');

Route::get('/subscription-confirmation', 'SignupController@subscriptionConfirmation');

//Route::get('/register', 'Auth\LoginController@showLoginForm');


Route::get('/glp-subscription', 'SignupController@glpSubscription');
Route::post('/glp-subscription', 'SignupController@saveGLPSubscription');


Auth::routes();


//Admin routes
Route::group(['namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('admin', 'HomeController@index');
    Route::resource('admin/admin_users', 'AdminUsersController');

    //Route::get('admin/contact-lists/{contactList}/contacts', 'ContactListContactsController@contacts');
    Route::resource('admin/contact-lists/{selected_contact_list}/contacts', 'ContactListContactsController');
    Route::get('admin/contact-lists/{selected_contact_list}/download', 'ContactListContactsController@download');
    Route::post('admin/contact-lists/{contact_list}/unsubscribe-contacts', 'ContactListsController@unsubscribeContacts');
    Route::resource('admin/contact-lists', 'ContactListsController');

    Route::post('admin/contacts/search', 'ContactsController@search');
    Route::get('admin/contacts/{contact}/audit', 'ContactAuditController@index');
    Route::get('admin/contacts/no-email-send', 'ContactsController@noEmailSend');
    Route::get('admin/contacts/email-sent-not-verified', 'ContactsController@emailSentNotVerified');
    Route::get('admin/contacts/verified-emails', 'ContactsController@verifiedEmails');
    Route::get('admin/contacts/send-verification-emails', 'ContactsController@sendVerificationEmails');

    Route::get('admin/contacts/unsubscribed','UnsubscribeController@index');
    Route::get('admin/contacts/unsubscribed/{id}/restore', 'UnsubscribeController@getUnsubscribeRecord');
    Route::patch('admin/contacts/unsubscribed/{id}', 'UnsubscribeController@restore');

    Route::resource('admin/contacts', 'ContactsController');
    Route::resource('admin/email-templates', 'EmailTemplateController');

    //
    Route::get('admin/schedule-tasks/dispatch', 'DispatchTaskController@executeScheduledTasks');
    Route::resource('admin/schedule-tasks', 'ScheduleTaskController');
    Route::get('admin/outbox/dispatch', 'OutboxController@sendEmails');
    Route::resource('admin/outbox', 'OutboxController');


    Route::get('admin/master', 'MasterController@main');
    Route::POST('admin/master', 'MasterController@executeQuery');

    Route::get('admin/master', 'MasterController@main');

    Route::get('/admin/utility_functions/manual_unsubscribe', 'ManualUnSubscribeController@loadData');
    Route::post('/admin/utility_functions/manual_unsubscribe', 'ManualUnSubscribeController@processLoadedData');

//    Route::get('admin', function () {
//        return "Admin";
//    });
});

Route::get('/home', 'Admin\HomeController@index');