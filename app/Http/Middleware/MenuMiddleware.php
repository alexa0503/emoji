<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Menu;
class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Menu::make('adminNavbar', function($menu){
            $menu->add('控制面板',['route'=>'admin_dashboard']);
            $menu->add('微信日志',['url'=>'admin/logs']);
            //$page->add('查看', 'page/view')->divide();
            //$menu->add('账户',['route'=>'admin_account']);
        });
        return $next($request);
    }
}
