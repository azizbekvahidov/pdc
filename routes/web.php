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


Route::get('/login',                        ['as' => 'login',           'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('/login',                       ['as' => 'login',           'uses' => 'Auth\LoginController@login']);
Route::match(['get','post'], '/register',   ['as' => 'register',        'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('/registerPost',                ['as' => 'registerPost',    'uses' => 'Auth\RegisterController@register']);
Route::get('/logout',                       ['as' => 'logout',          'uses' => 'Auth\LoginController@logout']);

// Frontend
    Route::get('/',           	            ['as' => 'index', 	        'uses' => 'Frontend\HomeController@index']);
Route::get('news/{slug}',               ['as' => 'news', 	        'uses' => 'Frontend\HomeController@news']);
Route::get('teachers/{id}',             ['as' => 'teachers', 	    'uses' => 'Frontend\HomeController@teachers']);

Route::get('/contacts', function () {
        return view('frontend.guest.contacts');
    });

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend',   'middleware' => 'auth'], function () {
// Profile
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function (){
            Route::get('/profile',              ['as' => 'index',    'uses' => 'HomeController@profile']);
            Route::get('/edit',                 ['as' => 'edit',     'uses' => 'HomeController@edit']);
            Route::post('/update',              ['as' => 'update',   'uses' => 'HomeController@update']);
        });
// Test
    Route::group(['prefix' => 'test', 'as' => 'test.', 'middleware' => 'checktime'], function() {
            Route::get('startlesson/{id}',  ['as' => 'start', 	    'uses' => 'TestController@start']);
            Route::post('clickStart',       ['as' => 'clickStart', 	'uses' => 'TestController@clickStart']);
            Route::get('test/{id}',         ['as' => 'test',  	    'uses' => 'TestController@test', 'middleware' => 'setcookie']);
            Route::post('check/{id}',       ['as' => 'check',  	    'uses' => 'TestController@check']);
            Route::get('conclusion',        ['as' => 'conclusion',  'uses' => 'TestController@conclusion']);
            Route::get('finish',            ['as' => 'finish',      'uses' => 'TestController@finish']);
        });
// Result
        Route::group(['prefix' => 'results', 'as' => 'result.'], function () {
            Route::get('/',                 ['as' => 'index', 'uses' => 'ResultController@index']);
        });
        Route::group(['prefix' => 'themes',  'as' => 'themes.'], function () {
            Route::get('/',                 ['as' => 'index',       'uses' => 'ThemesController@index']);
            Route::get('lessons/{id}',      ['as' => 'lessons',     'uses' => 'ThemesController@lessons']);
            Route::get('{id}/view',         ['as' => 'view',        'uses' => 'ThemesController@view']);
        });
    });

// Admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' =>'Admin', 'middleware' => 'auth'], function() {

        Route::get('/',     ['as' => 'home', 'uses' => 'HomeController@index', 'middleware' => 'roleVerification']);
        Route::get('/stop',  ['as' => 'stop', 'uses' => 'HomeController@stop']);

// Courses
        Route::group(['prefix' => 'courses', 'as' => 'courses.'], function () {
            Route::get('/',                 ['as' => 'index',       'uses' => 'CoursesController@index']);
            Route::get('/create',           ['as' => 'create',      'uses' => 'CoursesController@create']);
            Route::post('/store',           ['as' => 'store',       'uses' => 'CoursesController@store']);
        });

// Groups
        Route::group(['prefix' => 'groups', 'as' => 'groups.'], function () {
            Route::get('/',                     ['as' => 'index',           'uses' => 'GroupsController@index']);
            Route::get('create',                ['as' => 'create',          'uses' => 'GroupsController@create']);
            Route::get('students/{id}',         ['as' => 'students',        'uses' => 'GroupsController@students']);
            Route::get('results/{id}',          ['as' => 'studentResults',  'uses' => 'GroupsController@studentResults']);
            Route::post('dataPost',             ['as' => 'data',            'uses' => 'GroupsController@data']);
            Route::post('store',                ['as' => 'store',           'uses' => 'GroupsController@store']);
            Route::post('status',               ['as' => 'status',          'uses' => 'GroupsController@status']);
        });

// Questions
        Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
            Route::get('/',	            ['as' => 'index',    'uses' => 'QuestionsController@index']);
            Route::post('sendData',     ['as' => 'sendData', 'uses' => 'QuestionsController@sendData']);
            Route::get('create',        ['as' => 'create',   'uses' => 'QuestionsController@create']);
            Route::post('store',        ['as' => 'store',    'uses' => 'QuestionsController@store']);
            Route::get('edit/{id}',     ['as' => 'edit',     'uses' => 'QuestionsController@edit']);
            Route::post('update/{id}',  ['as' => 'update',   'uses' => 'QuestionsController@update']);
            Route::get('destroy/{id}',  ['as' => 'destroy',  'uses' => 'QuestionsController@destroy']);
        });

// Subjects
        Route::group(['prefix' => 'subjects', 'as' => 'subjects.'], function() {
            Route::get('/',         ['as' => 'index',   'uses' => 'SubjectsController@index']);
            Route::get('create',    ['as' => 'create',  'uses' => 'SubjectsController@create']);
            Route::post('store',    ['as' => 'store',   'uses' => 'SubjectsController@store']);
        });

        // Users
        Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
            Route::get('/',                 ['as' => 'index',   'uses' => 'UsersController@index']);
            Route::get('edit/{id}',         ['as' => 'edit',    'uses' => 'UsersController@edit']);
            Route::get('create',            ['as' => 'create',  'uses' => 'UsersController@create']);
            Route::post('store',            ['as' => 'store',   'uses' => 'UsersController@store']);
            Route::post('update/{id}',      ['as' => 'update',  'uses' => 'UsersController@update']);
            Route::get('destroy/{id}',      ['as' => 'destroy', 'uses' => 'UsersController@destroy']);
            Route::post('role',             ['as' => 'role',    'uses' => 'UsersController@role']);
        });
// News
        Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
            Route::get('/',             ['as' => 'index',   'uses' => 'NewsController@index']);
            Route::get('/create',       ['as' => 'create',  'uses' => 'NewsController@create']);
            Route::patch('/store',      ['as' => 'store',   'uses' => 'NewsController@store']);
            Route::get('{id}/edit',     ['as' => 'edit',    'uses' => 'NewsController@edit']);
            Route::patch('{id}/update', ['as' => 'update',  'uses' => 'NewsController@update']);
            Route::get('{id}/destroy',  ['as' => 'destroy', 'uses' => 'NewsController@destroy']);
        });
//Teachers
        Route::group(['prefix' => 'teachers', 'as' => 'teachers.'], function () {
            Route::get('/',             ['as' => 'index',   'uses' => 'TeachersController@index']);
            Route::get('{id}/edit',     ['as' => 'edit',    'uses' => 'TeachersController@edit']);
            Route::patch('{id}/update', ['as' => 'update',  'uses' => 'TeachersController@update']);
            Route::get('{id}/destroy',  ['as' => 'destroy', 'uses' => 'TeachersController@destroy']);
        });
//Themes
        Route::group(['prefix' => 'themes',    'as' => 'themes.'], function (){
            Route::get('/',             ['as' => 'index',   'uses' => 'ThemesController@index']);
            Route::get('view/{id}',     ['as' => 'view',    'uses' => 'ThemesController@view']);
            Route::get('create',        ['as' => 'create',  'uses' => 'ThemesController@create']);
            Route::post('store',        ['as' => 'store',   'uses' => 'ThemesController@store']);
            Route::post('choose',       ['as' => 'choose',  'uses' => 'ThemesController@choose']);
            Route::get('edit/{id}',     ['as' => 'edit',    'uses' => 'ThemesController@edit']);
            Route::post('update/{id}',  ['as' => 'update',  'uses' => 'ThemesController@update']);
            Route::get('delete/{id}',   ['as' => 'delete',  'uses' => 'ThemesController@delete']);
            Route::get('destroy/{id}',  ['as' => 'destroy', 'uses' => 'ThemesController@destroy']);
        });
    });
    Route::get('lang/{lang}', 'Admin\HomeController@lang')->name('lang');
