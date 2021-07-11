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
        $data = [
            "BKC" . sprintf("%03d",  $student->id),
            $student->name,
            $student->gender == 1 ? "Nam" : "Nữ",
            date_format($date, "d/m/Y"),
            $student->class,
            $student->countMustPay,
            $student->countPay,
            number_format($student->owe) . "VNĐ",
        ];
        return $data;
    }
    public function headings(): array
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y H:i', time());

        return [
            'Mã',
            'Họ tên',
            'Giới tính',
            'Ngày sinh',
            'Lớp',
            'Số đợt phải đóng',
            'Số đợt đã đóng',
            'Nợ',
            'Danh sách được tính đến' . $date,
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0 and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        if ($this->month == 5) {
            //từ 1 đến 5 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0  and `course`.`countMustPay` - fee.countPay <5 and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        } else if ($this->month == 6) {
            //6 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay =6   and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        } else if ($this->month == 7) {
            //6 tháng
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >= 7   and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        } else {
            //tất cả
            $fee =  DB::select('select DISTINCT `student`.`id` from `student` inner join `fee` on `Student`.`id` = `fee`.`idStudent` inner join `classbk` on `student`.`idClass` = `classbk`.`id` inner join `course` on `course`.`id` = `classbk`.`idCourse` where `course`.`countMustPay` - fee.countPay >0 and `student`.`fee` > ? and `student`.`disable` != ? and `fee`.`disable` != ? ', ['0', '1', '1']);
        }
        $studentowefee = [];
        foreach ($fee as $item) {
            $owefee = ModelsStudent::where('student.id', '=', $item->id)
                ->join('classbk', 'student.idClass', '=', 'classbk.id')
                ->join('course', 'course.id', '=', 'classbk.idCourse')
                ->join('fee', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select(
                    'Student.id',
                    'Student.name',
                    'Student.gender',
                    'Student.dateBirth',
                    'classbk.name as class',
                    'course.countMustPay',
                    'fee.countPay',

                    DB::raw('
                    (course.countMustPay - fee.countPay) * student.fee - (course.countMustPay - fee.countPay) * student.fee * payment.sale /100   as owe')
                )
                ->orderBy('fee.countPay', 'DESC')
                ->first();
            array_push($studentowefee, $owefee);
        }

        return $studentowefee;
    }
}
