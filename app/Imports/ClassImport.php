<?php

namespace App\Imports;

use App\Classroom;
use App\Models\Classroom as ModelsClassroom;
use App\Models\Course;
use App\Models\Major;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $data = [
            "name" => $row["ten_lop"],
            "idMajor" => Major::where('name', '=', $row['nganh_hoc'])->value('id'),
            "idCourse" => Course::where('name', '=', $row['khoa'])->value('id'),
            "disable" => "0",
        ];

        return new ModelsClassroom($data);
    }
}
