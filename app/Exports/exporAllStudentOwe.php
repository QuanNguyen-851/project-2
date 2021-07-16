<?php

namespace App\Exports;

use App\Models\Student as ModelsStudent;
use App\Student;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class exporAllStudentOwe implements FromArray, WithHeadings, WithMapping
{
    public function __construct($month)
    {
        $this->month = $month;
    }
    public function map($student): array
    {
        $date = date_create($student->dateBirth);
        if ($student->owe <= 0) {
            $student->owe = 0;
        } else if ($student->owesub <= 0) {
            $student->owesub = 0;
        }
        $data = [
            "BKC" . sprintf("%03d",  $student->id),
            $student->class,
            $student->name,
            $student->gender == 1 ? "Nam" : "Nữ",
            date_format($date, "d/m/Y"),
            number_format($student->scholarship) . "VNĐ",
            $student->payment,
            ($student->fee),
            ($student->owe),
            ($student->owesub),
            ($student->owe + $student->owesub),
        ];
        return $data;
    }
    public function headings(): array
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y H:i', time());
        if ($this->month == 5) {
            $head = 'danh sách sinh viên bị CẤM THI ';
        } elseif ($this->month == 6) {
            $head = 'danh sách sinh viên bị ĐÌNH CHỈ HỌC 30 NGÀY ';
        } elseif ($this->month == 7) {
            $head = 'danh sách sinh viên bị BUỘC THÔI HỌC ';
        } else {
            $head = 'danh sách sinh viên nợ học phí';
        }
        return [
            [$head],
            [
                'Mã',
                'Lớp',
                'Họ tên',
                'Giới tính',
                'Ngày sinh',
                'Học bổng',
                'Hình thức đóng',
                'Học phí mỗi đợt',
                'Học phí nợ tính đến ' . $date,
                'Phụ phí nợ tính đến' . $date,
                'Tổng nợ tính đến' . $date,
            ]
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        // $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0 and `student`.`fee` > ? and `student`.`disable` != ?  ', ['0', '1']);
        if ($this->month == 5) {
            //từ 1 đến 5 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` INNER JOIN subfee on student.id = subfee.idStudent where (`course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <=5 and `student`.`fee` > ? and `student`.`disable` != ?) ', ['0', '1', '0', '1']);
        } else if ($this->month == 6) {
            //6 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` INNER JOIN subfee on student.id = subfee.idStudent where (`course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ? )', ['0', '1', '0', '1']);
        } else if ($this->month == 7) {
            //7 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` INNER JOIN subfee on student.id = subfee.idStudent where (`course`.`countMustPay` - fee.countPay >= 7   and `student`.`fee` > ? and `student`.`disable` != ?)', ['0', '1', '0', '1']);
        } else {
            //tất cả
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` INNER JOIN subfee on student.id = subfee.idStudent where (`course`.`countMustPay` - fee.countPay >0 and `student`.`fee` > ? and `student`.`disable` != ?) or (`course`.`countSubFeeMustPay` - subfee.countPay > ? 
            and `student`.`disable` != ? ) ', ['0', '1', '0', '1']);
        }
        $studentowefee = [];
        foreach ($fee as $item) {
            $owefee = ModelsStudent::where('student.id', '=', $item->id)
                ->join('classbk', 'student.idClass', '=', 'classbk.id')
                ->join('course', 'course.id', '=', 'classbk.idCourse')
                ->join('fee', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
                ->join('subfee', 'subfee.idStudent', '=', 'student.id')
                ->select(
                    'Student.id',
                    'classbk.name as class',
                    'Student.name',
                    'Student.gender',
                    'Student.dateBirth',
                    'scholarship.scholarship as scholarship',
                    'payment.name as payment',
                    'student.fee',
                    DB::raw('
                    (course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe,
                    (course.countSubFeeMustPay - subfee.countPay)* 1000000 as owesub')
                )
                ->orderBy('fee.countPay', 'DESC')
                ->first();
            array_push($studentowefee, $owefee);
        }

        return $studentowefee;
    }
}
