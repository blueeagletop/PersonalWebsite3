<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'View\IndexController@index');
Route::get('/category={category_id}', 'View\CategoryController@categoryArticle');
Route::get('/categoryF={categoryF_id}', 'View\CategoryController@firstCategoryArticle');
Route::get('/article={article_id}', 'View\ArticleController@detail');
Route::get('/tag={tag_id}', 'View\TagController@tagArticle');

Route::group(['prefix'=>'service'],function(){
    Route::get('/validate_code/create','Service\ValidateController@create');
    Route::get('category/parent_id/{parent_id}','Service\IndexController@getCategoryByParentId');
});


/******************  后台管理  ******************/
Route::group(['prefix'=>'admin'],function(){
    Route::get('login','Admin\LoginController@toLogin');
    Route::get('index','Admin\IndexController@index');
    Route::get('welcome','Admin\IndexController@welcome');
    
    Route::get('article','Admin\ArticleController@article');
    Route::get('addArticle','Admin\ArticleController@addArticle');
    
    Route::get('category','Admin\CategoryController@category');
    Route::get('addCategory','Admin\CategoryController@addCategory');
    Route::get('editCategory={category_id}','Admin\CategoryController@editCategory');
    Route::get('tag','Admin\IndexController@welcome');
    Route::get('comment','Admin\IndexController@welcome');
    Route::get('message','Admin\IndexController@welcome');
    Route::get('member','Admin\IndexController@welcome');
    Route::get('member/ban','Admin\IndexController@welcome');
    Route::get('admin','Admin\IndexController@welcome');
    
    
    /******* 操作数据库 *******/
    Route::group(['prefix'=>'service'],function(){
        Route::post('addArticle','Admin\ArticleController@doAddArticle');
        
        Route::post('addCategory','Admin\CategoryController@doAddCategory');
        Route::post('editCategory','Admin\CategoryController@doEditCategory');
        Route::post('delCategory','Admin\CategoryController@doDelCategory');
    });
});