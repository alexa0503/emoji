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
        //Log::info('request arrived.');
        $server = \EasyWeChat::server();

        $server->setMessageHandler(function ($message) {
            if ($message->MsgType == 'event') {
                if( $message->Event == 'subscribe'){
                    return '欢迎加入Life Space的健康空间，这里将为你介绍关于健康，关于益生菌，关于育儿的一切，开启宝宝健康的第”益”步！';
                }
                elseif($message->EventKey == 'LATEST_ACTIVITY'){
                    return '敬请期待！';
                }
            }
            elseif ($message->MsgType == 'text') {
                if(preg_match('/(中国的二维码|中国的微信|二维码)/',$message->Content)){
                    return '你好，我们是直接与Life Space澳洲公司对接的，本微信服务号主要负责Life Space品牌在中国市场的推广。感谢关注，有任何疑问欢迎给我们留言，我们会及时回复！';
                }
                /*
                elseif(preg_match('/(婴儿益生菌|儿童益生菌|婴儿|儿童)/',$message->Content)){
                    return '你好，我们是直接与Life Space澳洲公司对接的，本微信服务号主要负责Life Space品牌在中国市场的推广。感谢关注，有任何疑问欢迎给我们留言，我们会及时回复！';
                }
                */
                Log::info("\n\n".$message->Content."\n\n");
                $id = null;
                $emojis = [
                        ['id'=>1,'value'=>'/::)'],//1
                        ['id'=>1,'value'=>'/::B'],//3
                        ['id'=>1,'value'=>'/::D'],//14
                        ['id'=>1,'value'=>'/:,@P'],//21
                        ['id'=>1,'value'=>'/:,@-D'],//22
                        ['id'=>1,'value'=>'/::>'],//29
                        ['id'=>1,'value'=>'/:handclap'],//43
                        ['id'=>1,'value'=>'/:B-)'],//45
                        ['id'=>2,'value'=>'/::~'],//2
                        ['id'=>2,'value'=>'/::<'],//6
                        ['id'=>2,'value'=>"/::'("],//10
                        ['id'=>2,'value'=>'/::('],//16
                        ['id'=>2,'value'=>'/::T'],//20
                        ['id'=>2,'value'=>'/:,@o'],//24
                        ['id'=>2,'value'=>'/:,@!'],//37
                        ['id'=>2,'value'=>'/:!!!'],//38
                        ['id'=>2,'value'=>'/:<@'],//46
                        ['id'=>2,'value'=>'/:@>'],//47
                        ['id'=>2,'value'=>'/:P-('],//50
                        ['id'=>2,'value'=>"/::'|"],//51
                        ['id'=>3,'value'=> '/::|'],//4
                        ['id'=>3,'value'=> '/:8-)'],//5
                        ['id'=>3,'value'=> '/::$'],//7
                        ['id'=>3,'value'=> '/::P'],//13
                        ['id'=>3,'value'=> '/:--b'],//18
                        ['id'=>3,'value'=> '/::,@'],//30
                        ['id'=>3,'value'=> '/:,@@'],//35
                        ['id'=>3,'value'=> '/:&-('],//44
                        ['id'=>3,'value'=> '/::*'],//53
                        ['id'=>3,'value'=> '/:8*'],//55
                        ['id'=>4,'value'=> '/::@'],//12
                        ['id'=>4,'value'=> '/::+'],//17
                        ['id'=>4,'value'=> '/::Q'],//19
                        ['id'=>4,'value'=> '/::-S'],//32
                        ['id'=>4,'value'=> '/::8'],//36
                        ['id'=>4,'value'=> '/:xx'],//39
                        ['id'=>5,'value'=> '/::X'],//8
                        ['id'=>5,'value'=> '/::Z'],//9
                        ['id'=>5,'value'=> '/:|-)'],//26
                        ['id'=>5,'value'=> '/:,@x'],//34
                        ['id'=>5,'value'=> '/::-O'],//48
                        ['id'=>6,'value'=> '/::O'],//15
                        ['id'=>6,'value'=> '/::d'],//23
                        ['id'=>6,'value'=> '/::!'],//27
                        ['id'=>6,'value'=> '/:?'],//33
                        ['id'=>7,'value'=> '/::-|'],//11
                        ['id'=>7,'value'=> '/::g'],//25
                        ['id'=>7,'value'=> '/::L'],//28
                        ['id'=>7,'value'=> '/:,@f'],//31
                        ['id'=>7,'value'=> '/:bye'],//40
                        ['id'=>7,'value'=> '/:wipe'],//41
                        ['id'=>7,'value'=> '/:dig'],//42
                        ['id'=>7,'value'=> '/:>-|'],//49
                        ['id'=>7,'value'=> '/:X-)'],//52
                        ['id'=>7,'value'=> '/:@x'],//54




                        ['id'=>7,'value'=> '/:pd'],
                        ['id'=>7,'value'=> '/:<W>'],
                        ['id'=>7,'value'=> '/:beer'],
                        ['id'=>7,'value'=> '/:coffee'],
                        ['id'=>7,'value'=> '/:pig'],
                        ['id'=>7,'value'=> '/:rose'],
                        ['id'=>7,'value'=> '/:fade'],
                        ['id'=>7,'value'=> '/:showlove'],
                        ['id'=>7,'value'=> '/:heart'],
                        ['id'=>7,'value'=> '/:break'],
                        ['id'=>7,'value'=> '/:cake'],
                        ['id'=>7,'value'=> '/:bome'],
                        ['id'=>7,'value'=> '/:shit'],
                        ['id'=>7,'value'=> '/:moon'],
                        ['id'=>7,'value'=> '/:sun'],
                        ['id'=>7,'value'=> '/:hug'],
                        ['id'=>7,'value'=> '/:strong'],
                        ['id'=>7,'value'=> '/:weak'],
                        ['id'=>7,'value'=> '/:share'],
                        ['id'=>7,'value'=> '/:v'],
                        ['id'=>7,'value'=> '/:@)'],
                        ['id'=>7,'value'=> '/:jj'],
                        ['id'=>7,'value'=> '/:@@'],
                        ['id'=>7,'value'=> '/:ok'],
                        ['id'=>7,'value'=> '/:jump'],
                        ['id'=>7,'value'=> '/:shake'],
                        ['id'=>7,'value'=> '/:<O>'],
                        ['id'=>7,'value'=> '/:circle'],
                        ['id'=>7,'value'=> '😄'],
                        ['id'=>7,'value'=> '😷'],
                        ['id'=>7,'value'=> '😂'],
                        ['id'=>7,'value'=> '😝'],
                        ['id'=>7,'value'=> '😳'],
                        ['id'=>7,'value'=> '😱'],
                        ['id'=>7,'value'=> '😔'],
                        ['id'=>7,'value'=> '😒'],
                        ['id'=>7,'value'=> '[嘿哈]'],
                        ['id'=>7,'value'=> '[捂脸]'],
                        ['id'=>7,'value'=> '[奸笑]'],
                        ['id'=>7,'value'=> '[机智]'],
                        ['id'=>7,'value'=> '[皱眉]'],
                        ['id'=>7,'value'=> '[耶]'],
                        ['id'=>7,'value'=> '👻'],
                        ['id'=>7,'value'=> '🙏'],
                        ['id'=>7,'value'=> '💪'],
                        ['id'=>7,'value'=> '🎉'],
                        ['id'=>7,'value'=> '🎁'],
                        ['id'=>7,'value'=> '[茶]'],
                        ['id'=>7,'value'=> '[红包]'],
                        ['id'=>7,'value'=> '[蜡烛]'],
                ];
                foreach( $emojis as $emoji){
                    if( stripos($message->Content, $emoji['value']) === 0 ){
                        $id = $emoji['id'];
                        break;
                    }
                }

                /*
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
                        return '';
                        break;
                }
                */
                if( null != $id ){
                    $dt = Carbon::now();
                    if($dt->hour < 7 || $dt->hour >= 20 ){
                        $voice = \App\Voice::find($id);
                    }
                    else{
                        $voice = \App\Voice::find($id+7);
                    }
                    $log = new \App\WechatLog();
                    $log->openid = $message->FromUserName;
                    $log->content = $message->Content;
                    $log->msg_type = $message->MsgType;
                    $log->save();
                    return new Voice(['media_id' => $voice->media_id]);
                }
                else{
                    return '';
                }
            }
        });
        //Log::info('return response.');

        return $server->serve();
    }
    public function menu()
    {
        $menu = \EasyWeChat::menu();
        $menu->destroy();
        $buttons = [
            [
                'name' => '益生世界',
                'sub_button' => [
                    [
                        'type' => 'view',
                        'name' => '益小君大家族',
                        'url' => 'http://www.healthy-lifespace.com/cn/',
                    ],
                    [
                        'type' => 'view',
                        'name' => '益生世界',
                        'url' => 'https://m.v.qq.com/x/page/r/w/0/r0314r7r3w0.html?ptag=v_qq_com%23v.play.adaptor%233',
                    ],
                    [
                        'type' => 'view',
                        'name' => '育儿宝典',
                        'url' => 'https://m.v.qq.com/x/page/r/w/0/r0314r7r3w0.html?ptag=v_qq_com%23v.play.adaptor%233',
                    ],
                ],
            ],
            [
                'name' => '益生活动',
                'sub_button' => [
                    [
                        'type' => 'view',
                        'name' => '最新活动',
                        'url' => 'http://url.cn/414rX0h',
                        //'type' => 'click',
                        //'name' => '最新活动',
                        //'key'  => 'LATEST_ACTIVITY',
                    ],
                ],
            ],
            [
                'name' => '益起去玩',
                'sub_button' => [
                    [
                        'type' => 'media_id',
                        'name' => '哄娃魔音',
                        'media_id'  => 'cZ31wNENt1bdiVf9ESuIU1kQjW472w4c7IDNRkPJkbU',
                    ],
                ],
            ],
        ];
        $result = $menu->add($buttons);
        return $result;
    }
    public function upload($id)
    {
        //return;
        $voices = [
            ['path' => public_path('voice/sleep_happy.mp3'), 'title' => 'sleep happy'],
            ['path' => public_path('voice/sleep_sad.mp3'), 'title' => 'sleep sad'],
            ['path' => public_path('voice/sleep_cute.mp3'), 'title' => 'sleep cute'],
            ['path' => public_path('voice/sleep_angry.mp3'), 'title' => 'sleep angry'],
            ['path' => public_path('voice/sleep_quiet.mp3'), 'title' => 'sleep quiet'],
            ['path' => public_path('voice/sleep_surprised.mp3'), 'title' => 'sleep surprised'],
            ['path' => public_path('voice/sleep_others.mp3'), 'title' => 'sleep others'],
            ['path' => public_path('voice/play_happy.mp3'), 'title' => 'play happy'],
            ['path' => public_path('voice/play_sad.mp3'), 'title' => 'play sad'],
            ['path' => public_path('voice/play_cute.mp3'), 'title' => 'play cute'],
            ['path' => public_path('voice/play_angry.mp3'), 'title' => 'play angry'],
            ['path' => public_path('voice/play_quiet.mp3'), 'title' => 'play quiet'],
            ['path' => public_path('voice/play_surprised.mp3'), 'title' => 'play surprise'],
            ['path' => public_path('voice/play_others.mp3'), 'title' => 'play others'],
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
    public function image()
    {
        return;
        $material = \EasyWeChat::material();
        $path = public_path('images/emoji.jpg');
        $result = $material->uploadImage($path);
        return $result;
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
