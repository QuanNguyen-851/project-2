<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use App\Models\SubFee;
use Illuminate\Http\Request;

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

        // $studentsubfee =  Fee::where('idStudent', $id)
        //     ->join('student', 'student.id', '=', 'subfee.idStudent')
        //     ->select('student.*', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer')
        //     ->orderBy('date', 'desc')
        //     ->get();
        return View('Fee.studentfeeform', [
            "studentfee" => $studentfee,
            // "studentsubfee" => $studentsubfee,
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
}
