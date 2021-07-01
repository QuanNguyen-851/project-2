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
            return redirect()->route('login')->with('err', "Tài khoản không tồn tại, hoặc bạn không có quền truy cập vào trang web này!");
        }
    }

    public function logout()
    {
        $request = session()->flush();
        return redirect()->route('login');
    }

    public function foget()
    {
        return view('Authend.findaccount');
    }
    public function findaccount(Request $request)
    {
        try {
            $em = Employee::where('email', $request->email)->firstorFail();
            $rand = rand(10000, 99999);

            //tạo session random và mail
            session()->put('rand', $rand);
            session()->put('email', $em->email);
            //gửi mail
            return redirect()->Route('fogetpass');
        } catch (Exception $e) {
            return redirect()->Route('foget')->with('error', "Email này không tồn tại");
        }
    }
    public function checkrand()
    {
        return view('Authend.checkrand');
    }
    public function checkrandprocess(Request $request)
    {
        if ($request->rand == session()->get('rand')) {
            return redirect()->route('getpass');
        } else {
            return redirect()->Route('checkrand')->with('error', "mã xác nhận không chính xác");
        }
    }
    public function getpass()
    {
        return view('Authend.getpass');
    }
    public function setpass(Request $request)
    {
        $pass = $request->newpass;
        $email = session()->get('email');

        Employee::where('email', $email)->update([
            "passWord" => $pass,
        ]);
        $request = session()->flush();
        return redirect()->route('login');
    }
}
