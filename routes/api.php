<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middlewauser/forgot/passwordre group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['login.auth']], function () {

    /**
     *
     * Using Api Mobile Application
     *
     */

    Route::post('user/update', 'UserController@updateUser');
    Route::post('user/change/password', 'UserController@changePassword');

    Route::get('categories', 'UserController@categories');
    Route::get('all-course-by-category-id', 'UserController@getAllCourseByCategoryId');

    Route::get('course-details-by-id', 'UserController@courseDetailsById');

    Route::get('quiz-questions-by-course-id', 'UserController@getQuizQuestionsByCourseId');

    Route::post('post-quiz-answer', 'UserController@postQuizAnswer');

    Route::get('search-course', 'UserController@getSearchCourse');

    Route::get('user-quiz-list', 'UserController@getUserQuizzes');

    Route::get('languages', 'UserController@languages');
    Route::post('update-user-language', 'UserController@updateUserLanguage');


    Route::get('user-certificates', 'UserController@getUserCertificates');
    Route::get('user-certificates-details', 'UserController@getUserCertificatesDetails');

    Route::post('mark-complete-course', 'UserController@markCompleteCourse');

    Route::get('news-list', 'UserController@getNewsList');
    Route::get('news-details', 'UserController@getNewsDetails');

    Route::get('message-counter', 'UserController@messageCount');
    Route::get('notification/unread_count', 'NotificationController@unreadCount');
    Route::get('notification/list', 'NotificationController@index');
    Route::post('notification/create', 'NotificationController@store');

    Route::post('notification/update-notification-settings', 'NotificationController@userUpdateNotificationSettings');
    Route::get('notification/notification_settings', 'NotificationController@userNotificationSettings');
    Route::post('notification/update/{id?}', 'NotificationController@update');
});


/**
 *
 * Using Api Mobile Application without Login
 *
 */
Route::post('user/mobilelogout', 'UserController@mobileLogout');
Route::post('user/login', 'UserController@login');
Route::post('user/create', 'UserController@storeUser');
Route::post('user/forgot/password', 'UserController@forgotPassword');