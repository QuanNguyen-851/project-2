<?php

namespace App\Exports;

use App\Classroom;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class insertClassExample implements WithHeadings
{
    public function headings(): array
    {
        return [

            "Tên lớp",
            "Ngành học",
            "Khóa",

        ];
    }
}
