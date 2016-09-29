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

Route::get('/','OverallController@overall');


Route::get('bocom/{page}','BocomController@index');//交通银行
Route::get('zft/{page}','ZftController@index');//pad智付通
Route::get('zftexc/{page}','ZftController@exception');//pad智付通(异常)
Route::get('zftsta','ZftController@statistics');//pad智付通统计
Route::get('overall','OverallController@index');//总体统计
Route::get('index','OverallController@overall');//总体
Route::get('zfterr','OverallController@zfterr');//智付通异常日志
Route::get('zfttrue','OverallController@zft');//智付通正常日志
Route::get('bocomtrue','OverallController@bocom');//交行异常日志
Route::get('bocomerr','OverallController@bocomerr');//交行正常日志
Route::get('search','SearchController@index');//搜索
Route::get('show/{page}/{id}','SearchController@show');//搜索

Route::post('task', 'TaskController@store');//新建定时任务功能
Route::get('task/{id}/{page}', 'TaskController@index');//查看流水
Route::get('taskmanage/{page}', 'TaskController@manage');//任务管理
Route::get('taskshow/{id}/{page}', 'TaskController@show');//任务管理界面查看
Route::get('taskflowshow/{id}/{time}/{page}', 'TaskController@flowShow');//任务流水界面查看
Route::get('taskclose/{name}', 'TaskController@close');//关闭定时任务
Route::get('taskopen/{name}', 'TaskController@open');//开启定时任务