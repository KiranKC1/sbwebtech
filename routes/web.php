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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// Route::post('/posts','PostsController@store')->name('posts.store');
// Route::get('posts/edit/{slug}','PostsController@edit')->name('posts.edit');
// Route::post('posts/update','PostsController@update')->name('posts.update');
// Route::post('posts/delete','PostsController@delete')->name('posts.delete');
// Route::get('posts/{slug}','PostsController@view')->name('posts.view');
// Route::get('history','PostsController@history')->name('posts.history');
// Route::get('users','AclController@index')->name('users.verify');

Route::get('/posts',[
	'uses'=>'PostsController@index',
	'as'=>'posts.index',
	'middleware'=>'roles',
	'roles'=>['User','Admin','Editor']
]);
Route::post('/posts',[
	'uses'=>'PostsController@store',
	'as'=>'posts.store',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor']
]);
Route::get('/posts/edit/{slug}',[
	'uses'=>'PostsController@edit',
	'as'=>'posts.edit',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor']
]);

Route::post('/posts/update',[
	'uses'=>'PostsController@update',
	'as'=>'posts.update',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor']
]);

Route::post('/posts/delete',[
	'uses'=>'PostsController@delete',
	'as'=>'posts.delete',
	'middleware'=>'roles',
	'roles'=>['Admin']
]);

Route::get('/posts/{slug}',[
	'uses'=>'PostsController@view',
	'as'=>'posts.view',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor','User']
]);

Route::get('history',[
	'uses'=>'PostsController@history',
	'as'=>'posts.history',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor','User']
]);

Route::get('users',[
	'uses'=>'AclController@index',
	'as'=>'users.verify',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor']
]);

Route::post('users',[
	'uses'=>'AclController@AssignRoles',
	'as'=>'assign.roles',
	'middleware'=>'roles',
	'roles'=>['Admin','Editor']
]);
