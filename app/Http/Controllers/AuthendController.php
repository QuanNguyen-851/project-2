<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;

class AuthendController extends Controller
{
    public function login()
    {
        return view('Authend.login');
    }
    public function loginProcess(Request $request)
    {
        try {
            $checklogin =  Employee::where([
                ['email', $request->get('email')],
                ['password', $request->get('password')],
                ['block', '!=', '1'],
                ['permission', '1'],
            ])
                ->firstorFail();
            $request->session()->put('name', $checklogin->name);
            $request->session()->put('id', $checklogin->id);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            return redirect()->route('login')->with('err', "Tài khoản không tồn tại");
        }
    }

    public function logout()
    {
        $request = session()->flush();
        return redirect()->route('login');
    }
}
