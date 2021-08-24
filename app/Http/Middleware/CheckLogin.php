<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists('id')) { //check login
            $em = Employee::where('id', $request->session()->get('id'))->first();
            if ($em->block == 1) { //check bị chặn
                $request = session()->flush(); // nếu đang đăng nhập mà bị chặn thì lập tức xóa session 
                return redirect()->route('login')->with('notlogin', "Bạn đã bị chặn");
            } else {
                return $next($request);
            }
        } else {
            return redirect()->route('login')->with('notlogin', "Bạn chưa đăng nhập");
        }
    }
}
