<?php

/*--------------------------------------------------------------------------
| / front-end
|-------------------------------------------------------------------------*/
  //Blog
  Route::get('/', 'BlogController@lists');
  //search-category
  Route::get('/search/category/{category}', 'BlogController@searchCategory');
  //search-tag
  Route::get('/search/tag/{tag}', 'BlogController@searchTag');
  //article
  Route::get('/post/{slug}', 'BlogController@post');

  //timeline
  Route::get('/timeline', 'BlogController@timeline');
/*----------------------------------------------------------------------------
| Auth
|---------------------------------------------------------------------------*/
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
  /*--------------------------------------------------------------------------
  | backend
  |-------------------------------------------------------------------------*/
    //index
    Route::get('/admin', 'PostController@lists');
    //test
    Route::get('/admin/test', 'PostController@test');
    //logout
    Route::get('/admin/logout', '\App\Http\Controllers\Auth\LoginController@logout');
  /*--------------------------------------------------------------------------
  | posts
  |-------------------------------------------------------------------------*/
    //posts-list
    Route::get('/admin/posts', 'PostController@lists');
    //posts-create
    Route::get('/admin/posts/create', 'PostController@create');
    //posts-edit
    Route::get('/admin/posts/edit/{id}', 'PostController@edit');
    //posts-store
    Route::post('/admin/posts/store', 'PostController@store');
    //posts-delete
    Route::get('/admin/posts/delete/{id}', 'PostController@delete');
    //posts-addTag
    Route::post('admin/post/addTag', 'PostController@addTag');
  /*--------------------------------------------------------------------------
  | Categories
  |-------------------------------------------------------------------------*/
    //categories-list
    Route::get('/admin/categories', 'CategoryController@lists');
    //categories-create
    Route::post('/admin/categories/create', 'CategoryController@create');
    //categories-edit
    Route::post('/admin/categories/edit/{id}', 'CategoryController@edit');
    //categories-delete
    Route::get('/admin/categories/delete/{id}', 'CategoryController@delete');
  /*--------------------------------------------------------------------------
  | Menus
  |-------------------------------------------------------------------------*/

  /*--------------------------------------------------------------------------
  | Settings
  |-------------------------------------------------------------------------*/
    //Settings-list
    Route::get('/admin/settings', 'SettingController@lists');
    //Settings-edit
    Route::post('/admin/settings/edit/{id}', 'SettingController@edit');
});
