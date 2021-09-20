<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Fee;
use App\Models\Student;
use App\Models\SubFee as ModelsSubFee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Subfee;

class AuthendController extends Controller
{
    public function dashboard()
    {
        try {
            // BIỂU ĐỒ TRÒN
            //     danh sach sv
            $count = DB::select('select count(*) as count from `student` inner join `fee` on `student`.`id` = `fee`.`idStudent` where `student`.`disable` != 1 and `fee`.`id` = (SELECT max(fee.id) from fee where idStudent = student.id )'); // đếm số sinh viên đã có bản ghi biên lai
            $students = $count[0]->count;
            //     số sinh viên nợ 1-5 tháng
            $fee =  DB::select('SELECT student.*  FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id  INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id ) and (`course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <=5 and `student`.`fee` > ? and `student`.`disable` != ?)', ['0', '1']);
            $owe5 = 0;
            foreach ($fee as $item) {
                $owe5++;
            }
            $o5 = round($owe5 / $students * 100);
            //    số sinh viên nợ 6 tháng
            $fee6 =   DB::select('SELECT student.* FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id ) and  (`course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ? )', ['0', '1']);
            $owe6 = 0;
            foreach ($fee6 as $item) {
                $owe6++;
            }
            $o6 = round($owe6 / $students * 100);
            //   số sinh viên nợ >7 tháng   
            $fee7 =   DB::select('SELECT student.* FROM `fee`INNER JOIN student on student.id = fee.idStudent
            INNER JOIN classbk on student.idClass = classbk.id 
            INNER JOIN course on classbk.idCourse = course.id 
            -- INNER join subfee on subfee.idStudent = student.id
            INNER JOIN payment ON fee.idMethod = payment.id
            where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id  ) and ( course.countMustPay- fee.countPay>7  )');
            $owe7 = 0;
            foreach ($fee7 as $item) {
                $owe7++;
            }
            $o7 = round($owe7 / $students * 100);
            // dd($students, $owe5, $owe7, $owe6);
        } catch (Exception $e) {
            $o5 = 0;
            $o6 = 0;
            $o7 = 0;
        }

        // dd($fee, $fee6, $fee7);

        //BIỂU ĐỒ CỘT
        try {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $year = date('Y', time());
            $array = [];
            for ($i = 1; $i <= 12; $i++) {
                // $i = 6;

                $date = $year . "-" . sprintf("%02d", $i);

                $f1 = Fee::join('student', 'fee.idStudent', '=', 'student.id')
                    ->join('payment', 'payment.id', '=', 'fee.idMethod')
                    ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
                    ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") = ?', [$date])
                    // ->select('fee.id')
                    ->get();
                $subfee1 = ModelsSubFee::join('student', 'student.id', '=', 'subfee.idStudent')
                    ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
                    ->whereraw('DATE_FORMAT(subfee.date, "%Y-%m") = ?', [$date])
                    ->get();

                $sumfee = 0;
                $sumsubfee = 0;
                foreach ($f1 as $item) {
                    $sumfee += $item->payfee;
                }
                foreach ($subfee1 as $item) {
                    $sumsubfee += $item->payfee;
                }

                // $array["key"] = ($sumfee + $sumsubfee);

                $array[$i]  = (($sumfee + $sumsubfee) / 1000000);
            }
        } catch (Exception $e) {
            for ($i = 1; $i <= 12; $i++) {
                $array[$i] = 0;
            }
        }


        return view('dashboard', [
            // "all" => $students,
            "owe5" => $o5,
            "owe7" => $o7,
            "owe6" => $o6,
            "array" => $array,
        ]);
    }

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
            $request->session()->put('name', $checklogin->name); //tạo session
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
