<?php

use Illuminate\Support\Facades\Auth;

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
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function ($route) {
//项目
    Route::resource('/project', 'ProjectController');
//version
    Route::resource('/version', 'VersionController');
//step
    Route::resource('/step', 'StepController');
//日志
    Route::resource('/record', 'RecordController');
    //用户管理
    Route::resource('/user', 'UserController');
    //设置为管理员
    Route::get('/manager/{user}/type/{type}', 'UserController@setManager')->name('user.manager');
//根据id获取版本列表
    Route::get('/project_version/{project?}', "ProjectController@gETVersions")->name('project.getVersions');
# 文件上传管理
    Route::any('/file/upload', 'FileController@upload')->name('upload');
    Route::any('test', 'TestController@uploadImages');
});


