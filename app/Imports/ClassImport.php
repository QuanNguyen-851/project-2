<?php

namespace App\Imports;

use App\Classroom;
use App\Models\Classroom as ModelsClassroom;
use App\Models\Course;
use App\Models\Major;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ClassImport implements
    ToModel,
    WithHeadingRow,
    WithValidation
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
    public function rules(): array
    {
        return [
            '*.ten_lop' => [
                'required',
                'unique:classbk,name',
            ],
            '*nganh_hoc' => [
                function ($attribute, $value, $onFailure) {
                    if ($value === null) {
                        $onFailure('Ngành không được để trống');
                    } else
                    if (Major::where('name', $value)->first() === null) {
                        $onFailure('Ngành này không tồn tại');
                    }
                },
            ],
            '*.khoa' => [
                function ($attribute, $value, $onFailure) {
                    if ($value === null) {
                        $onFailure('Khóa không được để trống');
                    } else
                    if (Course::where('name', $value)->value("id") === null) {
                        $onFailure('Khóa này không tồn tại');
                    }
                }
            ]

        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.ten_lop.required' => 'Tên lớp không được để trống',
            '*.ten_lop.unique' => 'Lớp này đã tồn tại'
        ];
    }
}
