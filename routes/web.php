<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::any('/wechat', 'WechatController@server');
Route::any('/wechat/upload', 'WechatController@upload');
Route::any('/wechat/menu', 'WechatController@menu');

Route::get('logout',function(){
    Request::session()->set('wechat.openid',null);
    Request::session()->set('wechat.id',null);
    return redirect('/');
});
Route::get('login',function(){
    $wechat_user = App\WechatUser::find(1);
    Request::session()->set('wechat.openid',$wechat_user->open_id);
    Request::session()->set('wechat.id',$wechat_user->id);
    Request::session()->set('wechat.nickname',json_decode($wechat_user->nick_name));
    return redirect('/');
});

///

Route::get('/admin/login', 'Admin\AuthController@getLogin');
Route::post('/admin/login', 'Admin\AuthController@postLogin');
Route::any('/admin/logout', function(){
    Auth::guard('admin')->logout();
    return redirect('/admin/login');
});


Route::group(['middleware' => ['auth:admin','menu']], function () {
    Route::get('admin', 'CmsController@index')->name('admin_dashboard');
    Route::get('admin/users', 'CmsController@users');
    Route::get('admin/account', 'CmsController@account');
    Route::post('admin/account', 'CmsController@accountPost');
});
//初始化后台帐号
Route::get('admin/install', function () {
    if (0 == \App\Admin::count()) {
        $user = new \App\Admin();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin@2016');
        $user->save();
    }
    return redirect('admin/login');
});
