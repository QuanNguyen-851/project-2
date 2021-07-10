<?php

namespace App\Http\Controllers;

use App\Exports\exporAllStudentOwe;
use App\Exports\exportStudentOwe;
use App\Models\Classroom;
use App\Models\Fee;
use App\Models\Student;
use App\Models\SubFee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class FeeController extends Controller
{
    public function studentfee($id)
    {
        $student = Student::where('student.id', $id)
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')
            ->select('Student.*', 'course.countMustPay', 'course.countSubFeeMustPay')
            ->first();

        $payed =  Fee::where('idStudent', $id)

            ->max('fee.countPay');
        $subfeepayed = SubFee::where('idStudent', $id)
            ->max('countPay');

        if ($payed === null) {
            $payed = 0;
        }
        if ($subfeepayed === null) {
            $subfeepayed = 0;
        }
        $sale = Fee::where('idStudent', $id)
            ->join('payment', 'payment.id', '=', 'fee.idMethod')
            ->orderBy('countPay', 'desc')
            ->first();

        if ($student->countMustPay > $payed) {
            if ($sale !== null) {
                $owe = ($student->countMustPay - $payed) * $student->fee - (($student->countMustPay - $payed) * $student->fee * $sale->sale / 100);
            } else {
                $owe = ($student->countMustPay - $payed) * $student->fee;
            }
        } else {
            $owe = 0;
        }
        if ($student->countSubFeeMustPay > $subfeepayed) {
            $owesub = ($student->countSubFeeMustPay - $subfeepayed) * 1000000;
        } else {
            $owesub = 0;
        }

        $studentfee =  Fee::where('idStudent', $id)
            ->join('student', 'student.id', '=', 'fee.idStudent')
            ->join('payment', 'payment.id', '=', 'fee.idMethod')
            ->select('student.*', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment')
            ->orderBy('date', 'desc')
            ->get();

        $studentsubfee =  SubFee::where('idStudent', $id)
            ->join('student', 'student.id', '=', 'subfee.idStudent')
            ->select('student.*', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee')
            ->orderBy('date', 'desc')
            ->get();
        return View('Fee.studentfeeform', [
            "studentfee" => $studentfee,
            "studentsubfee" => $studentsubfee,
            "student" => $student,
            "payed" => $payed,
            "owe" => $owe,
            "owesub" => $owesub,
            "subfeepayed" => $subfeepayed,

        ]);
    }

    public function detailStuddentFee($id)
    {


        $detail = Fee::where('fee.id', $id)
            ->join('student', 'fee.idStudent', '=', 'student.id')
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('payment', 'payment.id', '=', 'fee.idMethod')
            ->select('fee.*', 'student.name', 'student.dateBirth', 'student.address', 'student.fee as mustpay', 'payment.name as payment', 'payment.sale', 'payment.countPer')
            ->first();

        $fee = ($detail->mustpay * $detail->countPer) - (($detail->mustpay * $detail->countPer) * $detail->sale / 100);


        return view('Fee.detailstudentfee', [
            "detail" => $detail,
            "fee" => $fee,
        ]);
    }
    public function detailStudentSubFee($id)
    {
        $detail = SubFee::where('subfee.id', $id)
            ->join('student', 'subfee.idStudent', '=', 'student.id')
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->select('subfee.*', 'student.name', 'student.dateBirth', 'student.address', 'student.fee as mustpay')
            ->first();
        return view('Fee.detailstudentsubfee', [
            "detail" => $detail,

        ]);
    }
    public function listowefee(Request $request)
    {
        // lấy id biên lai các sinh viên nợ 
        $month = $request->month;
        if ($month == 5) {
            //từ 1 đến 5 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <5 and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        } else if ($month == 6) {
            //6 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        } else if ($month == 7) {
            //6 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >= 7   and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        } else {
            //tất cả
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0 and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        }



        $studentowefee = [];

        foreach ($fee as $item) {
            $owefee = Student::where('student.id', '=', $item->id)
                ->join('classbk', 'student.idClass', '=', 'classbk.id')
                ->join('course', 'course.id', '=', 'classbk.idCourse')
                ->join('fee', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select(
                    'Student.*',
                    'classbk.name as class',
                    'fee.countPay',
                    'course.countMustPay',
                    'payment.sale',
                    DB::raw('
                    (course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe')

                )
                ->orderBy('fee.countPay', 'DESC')
                ->first();
            array_push($studentowefee, $owefee);
        }
        return view('Fee.listowefee', [
            "studentowefee" => $studentowefee,
            "month" => $month,
        ]);
    }
    public function exportlistowefee($month)
    {
        $class = Classroom::where('disable', '!=', "1")->get();

        return view('Fee.exportlistowefee', [
            "class" => $class,
            "month" => $month,
        ]);
    }
    public function exportalllistowefeeprocess(Request $request)
    {
        $month = $request->month;
        $class = $request->class;

        if ($class == 0) {
            return Excel::download(new exporAllStudentOwe($month), 'danhSachNo.xlsx');
        } else {
            return Excel::download(new exportStudentOwe($month, $class), 'danhSachNo.xlsx');
        }
    }
}
