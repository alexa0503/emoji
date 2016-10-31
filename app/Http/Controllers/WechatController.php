<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;
use Carbon\Carbon;
use Log;
use EasyWeChat\Message\Voice;
use EasyWeChat\Message\Text;
use EasyWeChat\Message\Material;

class WechatController extends Controller
{
    public function server()
    {
        Log::info('request arrived.');
        $server = \EasyWeChat::server();

        $server->setMessageHandler(function ($message) {
            if ($message->MsgType == 'text') {
                Log::info(', content:'.$message->Content.'.');
                # code...
                switch ($message->Content) {
                    case '/::)'://1
                    case '/::B'://3
                    case '/::D'://14
                    case '/:,@P'://21
                    case '/:,@-D'://22
                    case '/::>'://29
                    case '/:handclap'://43
                    case '/:B-)'://45
                        $id = 1;
                        # code...
                        break;
                    case '/::~'://2
                    case '/::<'://6
                    case "/::'("://10
                    case '/::('://16
                    case '/::T'://20
                    case '/:,@o'://24
                    case '/:,@!'://37
                    case '/:!!!'://38
                    case '/:<@'://46
                    case '/:@>'://47
                    case '/:P-('://50
                    case "/::'|"://51
                        $id = 2;
                        break;
                    case '/::|'://4
                    case '/:8-)'://5
                    case '/::$'://7
                    case '/::P'://13
                    case '/:--b'://18
                    case '/::,@'://30
                    case '/:,@@'://35
                    case '/:&-('://44
                    case '/::*'://53
                    case '/:8*'://55
                        $id = 3;
                        break;
                    case '/::@'://12
                    case '/::+'://17
                    case '/::Q'://19
                    case '/::-S'://32
                    case '/::8'://36
                    case '/:xx'://39
                        $id = 4;
                        break;
                    case '/::X'://8
                    case '/::Z'://9
                    case '/:|-)'://26
                    case '/:,@x'://34
                    case '/::-O'://48
                        $id = 5;
                        break;
                    case '/::O'://15
                    case '/::d'://23
                    case '/::!'://27
                    case '/:?'://33
                        $id = 6;
                        break;
                    case '/::-|'://11
                    case '/::g'://25
                    case '/::L'://28
                    case '/:,@f'://31
                    case '/:bye'://40
                    case '/:wipe'://41
                    case '/:dig'://42
                    case '/:>-|'://49
                    case '/:X-)'://52
                    case '/:@x'://54
                        $id = 7;
                        break;
                    default:
                        $id = 7;
                        # code...
                        break;
                }
                $voice = \App\Voice::find($id);
                return new Voice(['media_id' => $voice->media_id]);
            }
        });
        Log::info('return response.');

        return $server->serve();
    }
    public function menu()
    {
        $menu = \EasyWeChat::menu();
        $menu->destroy();
        $buttons = [
            [
                'type' => 'click',
                'name' => '今日歌曲',
                'key' => 'V1001_TODAY_MUSIC',
            ],
            [
                'name' => '菜单',
                'sub_button' => [
                    [
                        'type' => 'view',
                        'name' => '搜索',
                        'url' => 'http://www.soso.com/',
                    ],
                    [
                        'type' => 'view',
                        'name' => '视频',
                        'url' => 'http://v.qq.com/',
                    ],
                    [
                        'type' => 'click',
                        'name' => '赞一下我们',
                        'key' => 'V1001_GOOD',
                    ],
                ],
            ],
        ];
        $result = $menu->add($buttons);
        return $result;
    }
    public function upload($id)
    {
        $voices = [
            ['path' => public_path('voice/happy.mp3'), 'title' => 'happy'],
            ['path' => public_path('voice/sad.mp3'), 'title' => 'sad'],
            ['path' => public_path('voice/cute.mp3'), 'title' => 'cute'],
            ['path' => public_path('voice/angry.mp3'), 'title' => 'angry'],
            ['path' => public_path('voice/quiet.mp3'), 'title' => 'quiet'],
            ['path' => public_path('voice/surprise.mp3'), 'title' => 'surprise'],
            ['path' => public_path('voice/others.mp3'), 'title' => 'others'],
        ];
        $material = \EasyWeChat::material();

        $result = $material->uploadVoice($voices[$id]['path']);
        $mediaId = $result->media_id;
        $voice = new \App\Voice();
        $voice->media_id = $mediaId;
        $voice->title = $voices[$id]['title'];
        $voice->save();

        return;
    }
    public function auth(Request $request)
    {
        if (null != $request->get('url')) {
            $request->session()->set('wechat.callback_url', urldecode($request->get('url')));
        } else {
            $request->session()->set('wechat.callback_url', null);
        }
        $app_id = env('WECHAT_APPID');
        $callback_url = $request->getUriForPath('/wechat/callback');
        $state = '';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$app_id.'&redirect_uri='.$callback_url."&response_type=code&scope=snsapi_userinfo&state=$state#wechat_redirect";

        return redirect($url);
    }
    public function callback(Request $request)
    {
        $app_id = env('WECHAT_APPID');
        $secret = env('WECHAT_SECRET');
        $code = $request->get('code');
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$app_id.'&secret='.$secret."&code=$code&grant_type=authorization_code";
        $data = Helper\HttpClient::get($url);
        $token = json_decode($data);
        if (isset($token->errcode) && $token->errcode != 0) {
            return view('errors/503', ['error_msg' => '获取用户信息失败~']);
        }

        $wechat_token = $token->access_token;
        $openid = $token->openid;

        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$wechat_token}&openid={$openid}";
        $data = Helper\HttpClient::get($url);
        $user_data = json_decode($data);
        if (isset($user_data) && isset($user_data->errcode)) {
            //echo $user_data->message;
            return view('errors/503', ['error_msg' => $user_data->message]);
            //return $user_data->message;
        } else {
            $wechat_user = \App\WechatUser::where('open_id', $openid);
            if ($wechat_user->count() > 0) {
                $wechat = $wechat_user->first();
                $wechat->updated_at = Carbon::now();
            } else {
                $wechat = new \App\WechatUser();
                $wechat->open_id = $openid;
                $wechat->created_at = Carbon::now();
                $wechat->ip_address = $request->getClientIp();
                $wechat->updated_at = null;
            }
            $wechat->gender = $user_data->sex;
            $wechat->head_img = $user_data->headimgurl;
            $wechat->nick_name = json_encode($user_data->nickname);
            $wechat->country = $user_data->country;
            $wechat->province = $user_data->province;
            $wechat->city = $user_data->city;
            //$wechat->options = $options;
            $wechat->save();
            $request->session()->set('wechat.id', $wechat->id);
            $request->session()->set('wechat.openid', $openid);
            $request->session()->set('wechat.nickname', json_decode($wechat->nick_name));
            $request->session()->set('wechat.headimg', $wechat->head_img);

            return redirect($request->session()->get('wechat.redirect_uri'));
        }
    }
}
