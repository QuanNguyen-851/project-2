<?php

namespace App\Http\Controllers;

use App\Mail\ForgetpassMail;
use App\Mail\WarningMail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function warningMail()
    {
        $fee = DB::select('SELECT student.* ,classbk.name as class,fee.countPay,course.countMustPay,subfee.countPay as countSubFee,course.countSubFeeMustPay,payment.sale,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub
        FROM student INNER JOIN  `fee` on student.id = fee.idStudent
        INNER JOIN classbk on student.idClass = classbk.id 
        INNER JOIN course on classbk.idCourse = course.id 
        INNER join subfee on subfee.idStudent = student.id
        INNER JOIN payment ON fee.idMethod = payment.id
        where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id  )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and ( course.countMustPay- fee.countPay>0 or `course`.`countSubFeeMustPay` - subfee.countPay > 0 ) ');
        foreach ($fee as $owefee) {

            Mail::to($owefee->email)->send(new WarningMail($owefee));
        }

        return redirect()->route('fee.listowefee', ['month' => 0])->with('no', "1");
    }
}
