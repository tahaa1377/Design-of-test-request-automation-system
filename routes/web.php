<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',"AccountController@page");

Route::get('/login',"AccountController@login_page");
Route::post('/loginCheck',"AccountController@loginCheck");

Route::get('/register',"AccountController@register_page");
Route::post('/registerCheck',"AccountController@registerCheck");

Route::get('/logout',"AccountController@logout");



Route::get('/admin_pages', [
    'uses' => 'AccountController@admin_page',
    'as' => 'admin.page'
]);

Route::get('/home', [
    'uses' => 'HomeController@home',
    'as' => 'user.page'
]);


Route::get('/newProjectStudent', [
    'uses' => 'HomeController@newProjectStudent',
    'as' => 'new.project.stu'
]);

Route::get('/newProjectCompany', [
    'uses' => 'HomeController@newProjectCompany',
    'as' => 'new.project.com'
]);





Route::post('/project_list',"HomeController@project_list");

Route::post('/set_price',"HomeController@set_price");




Route::get('/pay',"HomeController@pay");


Route::post('/payment_stu',"HomeController@payment_stu");
Route::post('/payment_com',"HomeController@payment_com");


Route::post('/notification_count',"AdminController@notification_count");

Route::post('/message_count',"AdminController@message_count");
Route::post('/message_user_count',"HomeController@message_user_count");


Route::get('/notifseen',"AdminController@notifseen");
Route::get('/msgseen',"AdminController@msgseen");


Route::get('/testDoing',"AdminController@testDoing");


Route::get('/messenger/{formid}/{user_id}',"AdminController@messenger");

Route::get('/messengerU/{formid}',"HomeController@messengerU");

Route::post('/messenger_result',"AdminController@messenger_result");
Route::post('/messenger_result_U',"HomeController@messenger_result_U");


Route::post('/sendMsg',"AdminController@sendMsg");
Route::post('/sendMsg_U',"HomeController@sendMsg");



Route::get('/messageSeen',"HomeController@messageSeen");


Route::get('/userTestDoing',"HomeController@userTestDoing");


Route::get('/testDefine',"AdminController@testDefine");
Route::post('/test_define_form',"AdminController@test_define_form");


Route::get('/amar',"AdminController@amar");


Route::get('/finish/{form_id}',"AdminController@finish_form_id");


Route::get('/documents/{form_id}',"AdminController@documents_form_id");
