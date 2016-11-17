<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App;
//use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('web');
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/dashboard');
    }
    public function logs(Request $request)
    {
        $query = App\WechatLog::where(\DB::raw('1'), '1');
        if( null != $request->input('start')){
            $query->where('created_at', '>=', urlencode($request->input('start')));
        }
        if( null != $request->input('end')){
            $query->where('created_at', '<=', urlencode($request->input('end')));
        }
        $logs[] = $query->select(\DB::raw('count(*) as num, content as value'))->groupBy('content')->get();
        $logs[] = $query->select(\DB::raw('count(*) as num, openid as value'))->groupBy('openid')->get();
        $count = App\WechatLog::count();
        return view('admin/logs',[
            'logs' => $logs,
            'count' => $count,
        ]);
    }
    /**
     * 账户管理
     */
    public function users()
    {
        $users = DB::table('users')->paginate(20);
        return view('admin/users', ['users' => $users]);
    }
    /**
     * @return mixed
     * session 查看
     */
    public function sessions($id = null)
    {
        if( null == $id)
            $sessions = DB::table('sessions')->paginate(20);
        else
            $sessions = DB::table('sessions')->where('id', '=', $id)->paginate(20);
        return view('admin/sessions', ['sessions' => $sessions]);
    }
    /**
     * 导出
     */
    public function export()
    {
        $filename = 'lottery-'.date('YmdHis');
        $collection = \App\Lottery::whereNotNull('prize_id')->orderBy('lottery_at','ASC')->get();
        $data = $collection->map(function($item){
            $code = $item->prize_code_id != null ? $item->prizeCode->code : '--';
            return [
                //$item->id,
                json_decode($item->user->nick_name),
                $item->prizeInfo->title,
                $code,
                $item->lottery_at
            ];
        });
        Excel::create($filename, function($excel) use($data) {
            $excel->setTitle('中奖记录');
            // Chain the setters
            $excel->setCreator('Alexa');
            // Call them separately
            $excel->setDescription('中奖记录');
            $excel->sheet('Sheet', function($sheet) use($data) {
                $sheet->row(1, array('用户昵称','奖品','抽奖码','抽奖时间'));
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->download('xlsx');
    }
    /**
     *账户管理
     */
    public function account()
    {
        return view('admin/account');
    }
    public function accountPost(Requests\AccountFormRequest $request)
    {
        //var_dump($request->user()->id);
        $user = \App\User::find($request->user()->id);
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('admin/logout');
        //var_dump($request->input('password'));
    }
    public function userLogs()
    {
        $logs = \App\UserLog::limit(30)->offset(0)->orderBy('create_time', 'DESC')->get();
        return view('admin/userLogs',['logs' => $logs]);
    }
}
