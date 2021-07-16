<?php

namespace App\Exports;

use App\Models\Classroom;
use App\Models\Scholarship;
use App\Models\Student as ModelsStudent;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExportall implements FromCollection, WithHeadings, withMapping
{
    public function map($student): array
    {
        $date = date_create($student->dateBirth);
        $data = [
            "BKC" . sprintf("%03d",  $student->id),
            $student->name,
            $student->gender == 1 ? "Nam" : "Nữ",
            date_format($date, "d/m/Y"),
            $student->email,
            $student->phone,
            $student->address,
            number_format($student->fee) . "VND",
            Classroom::where("id", $student->idClass)->value('name'),
            Scholarship::where('id', $student->idStudentShip)->value('name'),

        ];
        return $data;
    }
    /**
     * @var Invoice $invoice
     */
    public function headings(): array
    {
        return [
            ['DANH SÁCH SINH VIÊN'],
            [
                'Mã',
                'Họ tên',
                'Giới tính',
                'Ngày sinh',
                'email',
                'sdt',
                'địa chỉ',
                'Học phí/đợt',
                'Lớp',
                'Học bổng',
            ]


        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {

        return ModelsStudent::where('disable', '!=', "1")

            ->get();
    }
}
