<?php

namespace App\Exports;

use App\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class exampleFileStudentsExport implements WithHeadings
{
    public function headings(): array
    {
        return [
            "Họ tên",
            "Giới tính",
            "Ngày sinh",
            "email",
            "sdt",
            "Địa chỉ",
            "Lớp",
            "Học bổng"
        ];
    }
}
