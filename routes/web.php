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

Route::middleware('auth')->group(function () {


    Route::resource('question', 'QuestionController', ['except' => ['index']]);
    Route::resource('answer', 'AnswerController', ['except' => ['index', 'show', 'create', 'edit']]);
    Route::resource('comment', 'CommentController', ['except' => ['show', 'create']]);
    Route::post('/topic/user-topics', 'TopicController@userTopics');
    Route::get('/topic/{name}', 'TopicController@show')->name('topic.show');
    Route::delete('/topic/{topic}', 'TopicController@destroy')->name('topic.destroy');
    Route::post('/topic', 'TopicController@store')->name('topic.store');
    Route::get('/feed', 'HomeController@feed')->name('feed');
    Route::get('/', 'HomeController@feed');

    Route::put('/answer/{answer}/property', 'AnswerController@updateProperty')->name('answer.update.property');
    Route::put('/user/{user}/property', 'UserController@updateProperty')->name('user.update.property');

    Route::get('/user/{user}', function ($name) {
        return redirect()->route('user.profile', ['name' => $name, 'entity' => 'questions']);
    });
    Route::get('/user/{user}/{entity}', 'UserController@show')->where('entity', 'questions|answers|topics')->name('user.profile');
    Route::post('/user/{user}/update/avatar', 'UserController@updateAvatar')->name('user.update.avatar');


    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => 'admin'], function () {

    Route::get('/', 'TopicController@index');
    Route::get('/topics', 'TopicController@index')->name('topic.index');
    Route::resource('topic', 'TopicController', ['except' => ['index', 'show']]);
    Route::get('/users', 'UserController@index')->name('user.index');
});
