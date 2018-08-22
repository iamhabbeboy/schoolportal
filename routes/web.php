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
Route::view('/',            'index');
Route::view('/student',     'student-portal-login');
Route::view('/prospective', 'prospective');
Route::view('/about',       'about');
Route::view('/gallery',       'gallery');
Route::view('/contact',       'contact');

Route::post('/pay',             'FormsController@redirectToGateway')->name('pay');
Route::post('/ajax-local',       'FormsController@ajaxLocalGovernment');

Auth::routes();
Route::get('/home',             'HomeController@index')->name('home');
Route::get('/dashboard',        'DashboardController@index')->name('dashboard');
Route::get('/form',             'FormsController@index')->name('form');
Route::get('/school-fee',       'SchoolFeeController@index')->name('school-fee');
Route::get('/result',           'ResultController@index')->name('result');
Route::get('/admission',        'DashboardController@admission')->name('admission');
Route::get('/admission-letter', 'DashboardController@admissionLetter')->name('letter');
Route::get('/course-register',  'CoursesController@courseRegister')->name('course-register');
Route::get('/payment-history',  'PaymentController@history')->name('history');
Route::get('/print',            'PaymentController@print')->name('print');
// Route::get('/old-register',     'ReturningStudentController@index');

Route::post('/user-profile',     'HomeController@userProfile');
Route::post('/ajax-photo',      'HomeController@ajaxPhoto');
Route::post('/payment',         'PaymentController@processing');
Route::post('/ajax-result',     'ResultController@create')->name('ajax-result');
Route::post('/add-courses',     'CoursesController@studentCourseAdd')->name('add-course');


//  *  Panel <-> Route *
Route::group(['prefix' => 'panel'], function () {

    Route::get('/',                             'PanelController@index')->name('panel');
    Route::get('/students',                     'PanelController@students')->name('students');
    Route::get('/transactions',                 'PanelController@transaction')->name('transactions');
    Route::get('/logoutpanel',                  'PanelController@logout')->name('logoutpanel');
    Route::get('/result',                       'GradesController@result')->name('olevel');
    Route::get('/course',                       'CoursesController@index')->name('course');
    Route::get('/studentinfo-csv',              'PanelController@csv')->name('csv');

    Route::post('/addCourse',                   'CoursesController@create')->name('add_course');
    Route::post('/add-result',                  'GradesController@addResult')->name('add_olevel');
    Route::post('/auth',                        'PanelController@auth')->name('auth');
    Route::post('/admission-status',            'PanelController@admission');
});


