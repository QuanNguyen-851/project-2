<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Scholarship;
use App\Models\Student as ModelsStudent;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements
    ToModel,
    WithHeadingRow,
    WithValidation

//   WithValidation
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

    public function rules(): array
    {
        return [

            '*.ho_ten' => [
                'required',
            ],
            '*.email' => ['email', 'unique:student,email'],
            '*.sdt' => [
                'required',
                'unique:student,phone',
                'max:9999999999',
                'min:99999999',
                'numeric'
            ],
            '*.ngay_sinh' => [
                'required',
                'numeric'
            ],
            '*.gioi_tinh' => [
                'required',
                Rule::in('Nam', 'Nữ')
            ],
            '*.lop' => [
                function ($attribute, $value, $onFailure) {
                    if ($value === null) {
                        $onFailure('Lớp không được để trống');
                    } else
                    if (Classroom::where('name', $value)->value("id") === null) {
                        $onFailure('Lớp này không tồn tại');
                    }
                },

            ],
            '*.hoc_bong' => [
                function ($attribute, $value, $onFailure) {
                    if ($value === null) {
                        $onFailure('Học bổng không được để trống');
                    } else
                    if (Scholarship::where('name', $value)->value("id") === null) {
                        $onFailure('Mức học bổng này không tồn tại');
                    }
                },
            ],
            '*.dia_chi' => [
                'required'
            ]



        ];
    }
    public function customValidationMessages()
    {
        return [
            '*.ho_ten.required' => 'Họ và tên Không được để trống',
            '*.email.unique' => 'Email đã tồn tại',
            '*.sdt.max' => 'số điện thoại không quá 10 ký tự',
            '*.sdt.min' => 'số điện thoại tối thiểu 9 ký tự',
            '*.sdt.required' => 'Số điện thoại Không được để trống',
            '*.sdt.unique' => 'Số điện thoại đã tồn tại',
            '*.sdt.numeric' => 'Số điện thoại chỉ chứa số ',
            '*.gioi_tinh.in' => 'Giới tính phải là Nam Hoặc Nữ',
            '*.gioi_tinh.required' => 'Giới tính Không được để trống',
            '*.ngay_sinh.required' => 'ngày sinh không được để trống',
            '*.ngay_sinh.numeric' => 'ngày sinh không đúng định dạng',
            '*.dia_chi' => 'Địa chỉ Không được để trống',
        ];
    }
}
