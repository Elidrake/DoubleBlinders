<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['web','auth']);

Route::get('/upload', function () {
    return view('upload');
})->middleware(['web','auth']);

Route::get('/review', function () {
    return view('review');
})->middleware(['web','auth']);

Route::get('/comments', function () {
    return view('comments');
})->middleware(['web','auth']);

Route::get('/classes', function () {
    return view('group');
})->middleware(['web','auth']);

Route::get('/test', function () {
    return view('test');
})->middleware(['web','auth']);
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function (){
  Route::controller('account', 'UsersUtilityController');
});
Route::group(['middleware' => ['web'], 'prefix' => 'api/v1', 'namespace' => 'API\V1'], function () {
  Route::resource('account', 'AccountCreateController', ['only' => [
      'index', 'store'
  ]]);
  Route::resource('account/login', 'AccountLoginController', ['only' => [
      'store', 'destroy'
  ]]);
});
Route::group(['middleware' => ['web','auth'], 'prefix' => 'api/v2', 'namespace' => 'V2'], function () {
    Route::resource('files', 'FileController', ['only' => [
        'index', 'store'
    ]]);
    Route::resource('groups', 'GroupController', ['only' => [
        'index', 'store'
    ]]);
    Route::resource('groups.files.comments', 'GroupFileCommentController', ['only' => [
        'index', 'store'
    ]]);
    Route::resource('groups.files', 'GroupsFilesController', ['only' => [
        'index', 'store'
    ]]);
    Route::resource('groups.assignments', 'GroupAssignmentController', ['only'=>[
      'index','store']]);
    //Change
});
