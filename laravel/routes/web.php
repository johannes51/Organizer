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

Auth::routes();


Route::get(   '/',
              'HomeController@index');


Route::match( ['get', 'post'],
              '/projects',
              'ProjectController@index');
Route::get(   '/projects/show/{project}',
              'ProjectController@show');
Route::get(   '/projects/diary/{diaryEntry}',
              'ProjectController@diary');
Route::post(  '/projects/diary/add/',
              'DiaryController@showAdd');


Route::match( ['get', 'post'],
              '/diary',
              'DiaryController@index');
Route::get(   '/diary/show/{diaryEntry}',
              'DiaryController@show');
Route::post(  '/diary/add/',
              'DiaryController@showAdd');
Route::post(  '/diary/processAdd',
              'DiaryController@add');


Route::match( ['get', 'post'],
              '/filmliste/{sort_field?}/{sort_direction?}',
              'FilmlisteController@show');
Route::post(  '/filmlisteAj/show/{sort_field?}/{sort_direction?}',
              'FilmlisteController@showAjax');
Route::post(  '/filmlisteAj/check',
              'FilmlisteController@check');
Route::post(  '/filmlisteAj/csrf',
              'FilmlisteController@csrfAjax');



Route::redirect('/watchlist',
                '/watchlist/list');
Route::match(   ['get', 'post'],
                '/watchlist/list/{sort_field?}/{sort_direction?}',
                'WatchlistController@index');
Route::get(     '/watchlistAj/list/{sort_field?}/{sort_direction?}',
                'WatchlistController@indexAjax');
Route::post(    '/watchlistAj/list/{sort_field?}/{sort_direction?}',
                'WatchlistController@indexAjax');
Route::post(    '/watchlistAj/delete/{sort_field?}/{sort_direction?}',
                'WatchlistController@delete');
Route::view(    '/watchlist/add',
                'watchlist.add');
Route::post(    '/watchlist/add',
                'WatchlistController@addProcess');


Route::get( '/leihliste',
            'LeihlisteController@index');
Route::get( '/leihliste/edit/{leihgabe?}',
            'LeihlisteController@edit');
Route::post('/leihliste/save/{leihgabe?}',
            'LeihlisteController@save');


Route::view('/spa',
            'spa/app');