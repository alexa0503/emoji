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
Route::any('/wechat/upload/{id}', 'WechatController@upload');
Route::any('/wechat/menu', 'WechatController@menu');
Route::any('/wechat/image', 'WechatController@image');

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
////微信分享接口
Route::get('/wx/share', function(){
    $url = urldecode(Request::get('url'));

    $options = [
      'app_id' => env('WECHAT_APPID'),
      'secret' => env('WECHAT_SECRET'),
      'token' => env('WECHAT_TOKEN')
    ];
    $wx = new EasyWeChat\Foundation\Application($options);
    $js = $wx->js;
    $js->setUrl($url);
    $config = json_decode($js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage', 'onMenuShareQQ'), false), true);
    $share = [
      'title' => '',
      'desc' => '',
      'imgUrl' => asset(env('WECHAT_SHARE_IMG')),
      'link' => '',
    ];
    //Access-Control-Allow-Origin
    return response()
        ->json(array_merge($share, $config))
        ->withHeaders([
            'Access-Control-Allow-Origin:*',
        ]);
    //return json_encode(array_merge($share, $config));
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
