<?php

namespace App\Http\Controllers;

use App\Mail\ForgetpassMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    public function fogetpass()
    {
        $email = session()->get('email');
        $rand = session()->get('rand');
        echo $email . $rand;
        Mail::to($email)->send(new ForgetpassMail());  // gửi mail đi
        //dẫn về trang xác nhận
        return redirect()->route('checkrand');
    }
}
