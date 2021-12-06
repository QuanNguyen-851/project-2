<?php

namespace App\Http\Controllers;

use App\Exports\exampleFileStudentsExport;
use App\Exports\StudentsExport;
use App\Exports\StudentsExportall;
use App\Imports\StudentsImport;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Scholarship;
use App\Models\Student as ModelsStudent;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $course = Course::where('disable', '!=', "1")->orderBy('id', 'desc')->skip(0)->take(3)->get();

        for ($i = 0; $i < count($course); $i++) {
            $student[$i] = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
                ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
                ->join('course', 'course.id', '=', 'classbk.idCourse')
                ->select(
                    [
                        'student.*', 'classbk.name as classname', 'scholarship.name as scholarship', 'course.name as course', 'course.id as idcorse',
                        DB::raw('(SELECT MAX(fee.countPay)  FROM fee where fee.idStudent = student.id) as count'),
                    ]

                )
                ->where([
                    ['student.name', 'LIKE', "%$search%"],
                    ['student.disable', '!=', '1'],
                    ['course.id', '=', $course[$i]->id],
                ])
                ->orwhere([
                    ['classbk.name', 'LIKE', "%$search%"],
                    ['student.disable', '!=', '1'],
                    ['course.id', '=', $course[$i]->id],
                ])
                ->orwhere([
                    ['student.id', 'LIKE', "%$search%"],
                    ['student.disable', '!=', '1'],
                    ['course.id', '=', $course[$i]->id],
                ])
                ->get();
        }
        $allstudents = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')

            ->select(
                [
                    'student.*', 'classbk.name as classname', 'scholarship.name as scholarship', 'course.name as course', 'course.id as idcorse',
                    DB::raw('(SELECT MAX(fee.countPay)  FROM fee where fee.idStudent = student.id) as count'),
                ]

            )
            ->where([
                ['student.name', 'LIKE', "%$search%"],
                ['student.disable', '!=', '1'],
            ])
            ->orwhere([
                ['classbk.name', 'LIKE', "%$search%"],
                ['student.disable', '!=', '1'],
            ])
            ->orwhere([
                ['student.id', 'LIKE', "%$search%"],
                ['student.disable', '!=', '1'],
            ])
            ->paginate(100);
        // dd($allstudents);
        $hidedstudents = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')
            ->select(
                [
                    'student.*', 'classbk.name as classname', 'scholarship.name as scholarship', 'course.name as course', 'course.id as idcorse',
                    DB::raw('(SELECT MAX(fee.countPay)  FROM fee where fee.idStudent = student.id) as count'),
                ]

            )
            // ->where('student.name', 'LIKE', "%$search%")
            // ->where('student.disable', '1')
            ->where([
                ['student.name', 'LIKE', "%$search%"],
                ['student.disable', '1'],
            ])
            ->orwhere([
                ['classbk.name', 'LIKE', "%$search%"],
                ['student.disable', '1'],
            ])
            ->orwhere([
                ['student.id', 'LIKE', "%$search%"],
                ['student.disable', '1'],
            ])

            ->paginate(100);

        return view('Student.index', [
            "listall" => $allstudents,
            "list" => $student,
            "listhide" => $hidedstudents,
            "search" => $search,
            "course" => $course,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $class = Classroom::where('disable', '!=', '1')->get();
        $scholarship = Scholarship::all();
        return view('Student.create', [
            "class" => $class,
            "scholarship" => $scholarship,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $student = new ModelsStudent();
        $student->name = $request->name;
        $student->idClass = $request->class;
        $student->gender = $request->gender;
        $student->dateBirth = $request->DoB;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->idStudentShip = $request->scholarship;

        $class = Classroom::join('major', 'classbk.idMajor', '=', 'major.id')
            ->where('classbk.id', '=', $request->class)
            ->select('major.fee as feemustpay')
            ->first();
        $scholarship = Scholarship::find($request->scholarship)
            ->select('scholarship.scholarship as pay')
            ->first();

        $fee = $class->feemustpay - round($scholarship->pay / 30, -5); // số tiền phải đóng bằng số tiền ngành - tiền học bổng/30
        if ($fee < 0) {
            $fee = 0;
        }
        $student->fee = $fee;
        $student->disable = 0;
        $email = $request->email;
        $check = ModelsStudent::where('email', '=', $email)->first();
        $checkphone = ModelsStudent::where('phone', '=', $request->phone)->first();
        if ($check !== null) {
            return redirect()->route('students.create')->with('erre', "Email đã tồn tại");
        } else if ($checkphone !== null) {
            return redirect()->route('students.create')->with('errp', "Số điện thoại này đã tồn tại");
        } else {
            $student->save();
            return redirect(route('students.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $student = ModelsStudent::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $student = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')
            ->select('student.*', 'classbk.name as classname', 'classbk.id as idclass', 'scholarship.name as scholarship', 'scholarship.id as idscholarship', 'course.name as course', 'course.id as idcorse', 'classbk.idMajor as idMajor')

            ->where('student.disable', '!=', '1')

            ->find($id);

        $class = Classroom::join('course', 'course.id', '=', 'classbk.idCourse')
            ->where('classbk.disable', '!=', '1')
            ->where('classbk.idMajor', $student->idMajor)
            ->where('classbk.idCourse', '>=', $student->idcorse)
            ->select('classbk.*')
            ->get();
        $scholarship = Scholarship::all();



        return view('Student.edit', [
            "student" => $student,
            "allclass" => $class,
            "scholarship" => $scholarship,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $class = Classroom::join('major', 'classbk.idMajor', '=', 'major.id')
            ->where('classbk.id', '=', $request->class)
            ->select('major.fee as feemustpay')
            ->first();
        $scholarship = Scholarship::where('id', '=', $request->scholarship)
            ->select('scholarship.scholarship as pay')
            ->first();

        // echo $request->scholarship;
        // echo "tiền khóa" . $class->feemustpay;
        // echo "học bổng" . $scholarship->pay;
        // echo " tiền trừ" . round($scholarship->pay / 30, -5);
        $fee = $class->feemustpay - round($scholarship->pay / 30, -5);
        if ($fee < 0) {
            $fee = 0;
        }
        $email = $request->email;
        $check = ModelsStudent::where('email', '=', $email)->first();
        $checkphone = ModelsStudent::where('phone', '=', $request->phone)->first();
        $ok = ModelsStudent::find($id);
        if ($check !== null && $email != $ok->email) {

            return redirect()->route('students.edit', [
                "$id",
            ])->with('erre', "Email đã tồn tại");
        } else if ($checkphone !== null && $request->phone != $ok->phone) {

            return redirect()->route('students.edit', [
                "$id",
            ])->with('errp', "Số điện thoại này đã tồn tại");
        } else {
            ModelsStudent::where('id', $id)->update([
                "idClass" => $request->get('class'),
                "name" => $request->get('name'),
                "gender" => $request->get('gender'),
                "dateBirth" => $request->get('DoB'),
                "Email" => $request->get('email'),
                "phone" => $request->get('phone'),
                "address" => $request->get('address'),
                "idStudentShip" => $request->get('scholarship'),
                "fee" => $fee,
            ]);
            return redirect(Route('students.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function importStudents()
    {
        return view('Student.importStudent');
    }

    public function insertByExcel(Request $request)
    {
        if ($request->file('excel') === null) {
            return redirect()->route("students.importStudents")->with('err', "Vui lòng chọn file");
        }

        Excel::import(new StudentsImport, $request->file('excel'));
        return redirect()->route('students.index');
    }
    public function exportStudentsform()
    {
        $course = Course::orderBy('id', 'desc')->skip(0)->take(3)->get();
        return view('Student.exportStudentsform', [
            "course" => $course,
        ]);
    }

    public function exportStudents(Request $request)
    {
        $idcourse = $request->course;
        if ($idcourse != 0) {
            return Excel::download(new StudentsExport($idcourse), 'ListStudents.xlsx');
        } else {
            return Excel::download(new StudentsExportall, 'ListStudents.xlsx');
        }

        // return (new StudentsExport($idcourse))->download('ListStudents.xlsx');
    }
    public function exampleFileStudents()
    {

        return Excel::download(new exampleFileStudentsExport, 'exampleFileStudents.xlsx');
    }
    public function searchForStudent()
    {
        return view('Student.forstudent');
    }
    public function checksearchForStudent(request $req)
    {
        $str = substr($req->id, 3);

        try {
            $student = ModelsStudent::where('id', $str)->firstorFail();
            // dd($student->id);
            return redirect()->route('student', [$student->id]);
        } catch (Exception $e) {
            return redirect()->route('searchForStudent')->with('err', "Không tìm thấy mã sinh viên vui lòng nhập lại");
        }
    }
    public function testError($id)
    {
        $str = substr($id, 3);
        try {
            $student = ModelsStudent::where('id', $str)->firstorFail();
            return " ";
        } catch (Exception $e) {
            return "Không tìm thấy mã sinh viên vui lòng nhập lại";
        }
    }
}
