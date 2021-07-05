<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Scholarship;
use App\Models\Student as ModelsStudent;
use Exception;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $class = Classroom::join('major', 'classbk.idMajor', '=', 'major.id')
            ->where('classbk.name', '=', $row["lop"])
            ->select('major.fee as feemustpay')
            ->first();
        $scholarship = Scholarship::where('name', '=', $row["hoc_bong"])
            ->select('scholarship.scholarship as pay')
            ->first();

        $fee = $class->feemustpay - round($scholarship->pay / 30, -5); // số tiền phải đóng bằng số tiền ngành - tiền học bổng/30
        if ($fee < 0) {
            $fee = 0;
        }
        // $date = str_replace("/", "-", $row["ngay_sinh"]);
        $UNIX_DATE = ($row["ngay_sinh"] - 25569) * 86400;
        $date_column = gmdate("Y-m-d", $UNIX_DATE);
        $data = [
            "name" => $row["ho_ten"],
            "gender" => $row["gioi_tinh"] == "Nam" ? 1 : 0,
            "dateBirth" => $date_column,
            "email" => $row["email"],
            "phone" => $row["sdt"],
            "address" => $row["dia_chi"],
            "fee" => $fee,
            "idClass" => Classroom::where('name', $row["lop"])->value("id"),
            "idStudentShip" => Scholarship::where('name', $row["hoc_bong"])->value("id"),
            "disable" => "0",
        ];

        return new ModelsStudent($data);
    }
}
