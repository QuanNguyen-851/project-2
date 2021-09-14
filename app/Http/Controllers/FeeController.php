<?php

namespace App\Http\Controllers;

use App\Exports\exporAllStudentOwe;
use App\Exports\exportStatistic;
use App\Exports\exportStudentOwe;
use App\Models\Classroom;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Student;
use App\Models\SubFee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\TemplateProcessor;

class FeeController extends Controller
{
    public function studentfee($id)
    {
        $student = Student::where('student.id', $id)
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')
            ->select('Student.*', 'course.countMustPay', 'course.countSubFeeMustPay', 'scholarship.name as scholarship')
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
            ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
            ->orderBy('date', 'desc')
            ->get();

        $studentsubfee =  SubFee::where('idStudent', $id)
            ->join('student', 'student.id', '=', 'subfee.idStudent')
            ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
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

    public function listowefee($month)
    {
        // lấy các bản ghi mới nhất của các sinh viên
        if ($month == 5) {
            $studentowefee = DB::select('SELECT student.* ,classbk.name as class,fee.countPay,course.countMustPay,subfee.countPay as countSubFee,course.countSubFeeMustPay,payment.sale,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100 as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id INNER join subfee on subfee.idStudent = student.id INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and (`course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <=5 and `student`.`fee` > ? and `student`.`disable` != ?)', ['0', '1']);
        } else if ($month == 6) {
            $studentowefee = DB::select('SELECT student.* ,classbk.name as class,fee.countPay,course.countMustPay,subfee.countPay as countSubFee,course.countSubFeeMustPay,payment.sale,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100 as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub FROM `fee`INNER JOIN student on student.id = fee.idStudent INNER JOIN classbk on student.idClass = classbk.id INNER JOIN course on classbk.idCourse = course.id INNER join subfee on subfee.idStudent = student.id INNER JOIN payment ON fee.idMethod = payment.id where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and  (`course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ? )', ['0', '1']);
        } else if ($month == 7) {
            $studentowefee = DB::select('SELECT student.* ,classbk.name as class,fee.countPay,course.countMustPay,subfee.countPay as countSubFee,course.countSubFeeMustPay,payment.sale,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100 as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub 
            FROM `fee`INNER JOIN student on student.id = fee.idStudent 
            INNER JOIN classbk on student.idClass = classbk.id 
            INNER JOIN course on classbk.idCourse = course.id 
            INNER join subfee on subfee.idStudent = student.id 
            INNER JOIN payment ON fee.idMethod = payment.id 
            where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id)and  (`course`.`countMustPay` - fee.countPay >= 7   and `student`.`fee` > ? and `student`.`disable` != ?)', ['0', '1']);
        } else {
            $studentowefee = DB::select('SELECT student.* ,classbk.name as class,fee.countPay,course.countMustPay,subfee.countPay as countSubFee,course.countSubFeeMustPay,payment.sale,(course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,(course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub
            FROM student INNER JOIN  `fee` on student.id = fee.idStudent
            INNER JOIN classbk on student.idClass = classbk.id 
            INNER JOIN course on classbk.idCourse = course.id 
            INNER join subfee on subfee.idStudent = student.id
            INNER JOIN payment ON fee.idMethod = payment.id
            where student.disable !=1 and fee.id = (SELECT max(fee.id) from fee where idStudent = student.id  )  and subfee.id = ( SELECT MAX(subfee.id ) FROM subfee WHERE subfee.idStudent = student.id) and ( course.countMustPay- fee.countPay>0 or `course`.`countSubFeeMustPay` - subfee.countPay > 0 ) ');
        }

        $sum = 0;
        $subsum = 0;
        $count = 0;
        foreach ($studentowefee as $item) {
            // $sumst=;
            if ($item->owe <= 0) {
                $item->owe = 0;
            } else if ($item->owesub <= 0) {
                $item->owesub = 0;
            }

            $sum += ($item->owe);
            $subsum += ($item->owesub);
            $count++;
        }

        // dd($studentowefee);
        return view('Fee.listowefee', [
            "studentowefee" => $studentowefee,
            "month" => $month,
            "sum" => $sum,
            "subsum" => $subsum,
            "count" => $count,
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
    public function statistic($month)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        if ($month == 1) {
            $date = date('Y-m-d', time());
            $month1 = strtotime(date("Y-m-d", strtotime($date)) . " -1 month");
            $month1 = strftime("%Y-%m", $month1);
            $fee = Fee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('student.*', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
                ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") = ?', [$month1])
                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('student.*', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
                ->whereraw('DATE_FORMAT(subfee.date, "%Y-%m") = ?', [$month1])
                ->get();
        } elseif ($month == 3) {
            $date = date('Y-m-d', time());
            $month3 = strtotime(date("Y-m-d", strtotime($date)) . " -3 month");
            $month3 = strftime("%Y-%m", $month3);
            $date2 = date('Y-m', time());
            // dd($month3);

            $fee = Fee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
                ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") < ? and DATE_FORMAT(fee.date, "%Y-%m") >= ? ', [$date2, $month3])


                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
                ->whereraw('DATE_FORMAT(subfee.date, "%Y-%m") < ? and DATE_FORMAT(subfee.date, "%Y-%m") >= ?',  [$date2, $month3])

                ->get();
        } elseif ($month == "all") {
            //lấy tất
            $fee = Fee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')

                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')

                ->get();
        } else {
            // tháng này
            $date = date('Y-m', time());
            $fee = Fee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
                ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") = ?', [$date])
                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
                ->whereraw('DATE_FORMAT(subfee.date, "%Y-%m") = ?', [$date])
                ->get();
        }
        $sumfee = 0;
        $sumsubfee = 0;
        foreach ($fee as $item) {
            $sumfee += $item->payfee;
        }
        foreach ($subfee as $item) {
            $sumsubfee += $item->payfee;
        }
        return view('Fee.statistic', [
            "month" => $month,
            "fee" => $fee,
            "sumfee" => $sumfee,
            "subfee" => $subfee,
            "sumsubfee" => $sumsubfee,
        ]);
    }
    public function exportstatistic($month)
    {
        return Excel::download(new exportStatistic($month), 'doanhthu.xlsx');
    }

    public function Student($id)
    {
        $student = Student::where('student.id', $id)
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')
            ->select('Student.*', 'course.countMustPay', 'course.countSubFeeMustPay', 'scholarship.name as scholarship')
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
            ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
            ->orderBy('date', 'desc')
            ->get();

        $studentsubfee =  SubFee::where('idStudent', $id)
            ->join('student', 'student.id', '=', 'subfee.idStudent')
            ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
            ->orderBy('date', 'desc')
            ->get();


        return view('Student.history', [
            "studentfee" => $studentfee,
            "studentsubfee" => $studentsubfee,
            "student" => $student,
            "payed" => $payed,
            "owe" => $owe,
            "owesub" => $owesub,
            "subfeepayed" => $subfeepayed,
        ]);
    }
    public function detaiFeeForstudent($id)
    {
        $detail = Fee::where('fee.id', $id)
            ->join('student', 'fee.idStudent', '=', 'student.id')
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('payment', 'payment.id', '=', 'fee.idMethod')
            ->select('fee.*', 'student.name', 'student.dateBirth', 'student.address', 'student.fee as mustpay', 'payment.name as payment', 'payment.sale', 'payment.countPer', 'student.id as studentid')
            ->first();

        $fee = ($detail->mustpay * $detail->countPer) - (($detail->mustpay * $detail->countPer) * $detail->sale / 100);


        return view('Student.detailFeeForStudent', [
            "detail" => $detail,
            "fee" => $fee,
        ]);
    }
    public function detailSubFeeForstudent($id)
    {

        $detail = SubFee::where('subfee.id', $id)
            ->join('student', 'subfee.idStudent', '=', 'student.id')
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->select('subfee.*', 'student.name', 'student.dateBirth', 'student.address', 'student.fee as mustpay', 'student.id as studentid')
            ->first();
        return view('Student.detailSubFeeForStudent', [
            "detail" => $detail,
        ]);
    }

    public function exportwordfee($id)

    {
        $fee = Fee::where('fee.id', $id)
            ->join('student', 'fee.idStudent', '=', 'student.id')
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->select('fee.*', 'student.name', 'student.dateBirth', 'student.address')
            ->first();
        $templateProcessor = new TemplateProcessor('word-templade/fee.docx');

        $templateProcessor->setValue('id', $fee->id);
        $templateProcessor->setValue('day', date_format(date_create($fee->date), "d"));
        $templateProcessor->setValue('month', date_format(date_create($fee->date), "m"));
        $templateProcessor->setValue('year', date_format(date_create($fee->date), "Y"));
        $templateProcessor->setValue('payer', $fee->payer);
        $templateProcessor->setValue('dateBirth', date_format(date_create($fee->dateBirth), "d.m.Y"));
        $templateProcessor->setValue('address', $fee->address);
        $templateProcessor->setValue('note', $fee->note);
        $templateProcessor->setValue('fee', number_format($fee->fee));

        $fileName = "phiếu thu " . $fee->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
    public function exportwordsubfee($id)
    {
        $subfee = Subfee::where('subfee.id', $id)
            ->join('student', 'subfee.idStudent', '=', 'student.id')
            ->join('classbk', 'student.idClass', '=', 'classbk.id')
            ->select('subfee.*', 'student.name', 'student.dateBirth', 'student.address')
            ->first();
        $templateProcessor = new TemplateProcessor('word-templade/subfee.docx');

        $templateProcessor->setValue('id', $subfee->id);
        $templateProcessor->setValue('day', date_format(date_create($subfee->date), "d"));
        $templateProcessor->setValue('month', date_format(date_create($subfee->date), "m"));
        $templateProcessor->setValue('year', date_format(date_create($subfee->date), "Y"));
        $templateProcessor->setValue('payer', $subfee->payer);
        $templateProcessor->setValue('dateBirth', date_format(date_create($subfee->dateBirth), "d.m.Y"));
        $templateProcessor->setValue('address', $subfee->address);
        $templateProcessor->setValue('note', $subfee->note);
        $templateProcessor->setValue('fee', number_format($subfee->fee));
        //sdkfhkshdf
        $fileName = "phiếu thu " . $subfee->name;
        $templateProcessor->saveAs($fileName . '.docx');
        return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
    }
}
