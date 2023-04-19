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

use Illuminate\Http\Request;

/**
 *
 * Using Web landing pages
 *
 */


Route::get('/', function () { return view('welcome'); });
Route::get('/terms-and-conditions', function () { return view('terms-and-conditions'); });
Route::get('/privacy-policy', function () {  return view('privacy-policy-page'); });
Route::get('/faq', 'HomeController@faq');

Route::get('/contact', function () { return view('contact'); });
Route::post('/post-contact', 'HomeController@postContact');

Route::get('/hospital/register', 'Frontend\UserController@hospitalRegister');
Route::post('/hospital/post-hospital-register', 'Frontend\UserController@postHospitalRegister');
Route::get('/hospial/register/thanks', 'Frontend\UserController@hospitalRegisterThanks');

Route::get('/user/login', 'Frontend\UserController@loginIndex');
Route::post('/user/loginweb', 'Frontend\UserController@loginWeb');

Route::get('/user/editprofile', 'Frontend\UserController@editProfile');
Route::post('/user/posteditprofile', 'Frontend\UserController@postEditProfile');
Route::get('/user/changeuserpassword', 'Frontend\UserController@changeUserPassword');
Route::post('/user/postchangeuserpassword', 'Frontend\UserController@postChangeUserPassword');

Route::get('user/login/user_forget_password', function () {
    return view('user.login.user_forget_password');
});
Route::post('user/forgot/userpassword', 'Frontend\UserController@userForgotPassword');
Route::post('user/forgot/password', 'UserController@forgotPassword');
Route::any('/user/forgot/password/{token}', 'UserController@changePasswordWeb');

Route::get('/user/physicians-listing', 'Frontend\PhysicianController@physiciansListing');
Route::get('/user/add-physician', 'Frontend\PhysicianController@addPhysician');
Route::get('/user/editphysician/{id}', 'Frontend\PhysicianController@editPhysician');
Route::get('/user/view-attempted-trainings/{id}', 'Frontend\PhysicianController@viewAttemptedTrainings');

Route::get('/user/messages', 'Frontend\UserController@messages');

Route::get('/user/hospital-email/delete/{id}', "Frontend\HospitalEmailController@deleteHospitalEmail");
Route::match(["get","post"],'/user/hospital-email/add', "Frontend\HospitalEmailController@addHospitalEmail");
Route::get('/user/hospital-email', "Frontend\HospitalEmailController@hospitalEmail");

Route::get('/user/hospital-news/delete/{id}', "Frontend\HospitalNewsController@delete");
Route::match(["get","post"],'/user/hospital-news/add', "Frontend\HospitalNewsController@add");
Route::get('/user/hospital-news', "Frontend\HospitalNewsController@index");

Route::group(['middleware' => ['login.auth'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('/logout', 'Frontend\UserController@logout');
});