<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use App\Models\Scholarship;
use App\Models\Student as ModelsStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $course = Course::orderBy('id', 'desc')->skip(0)->take(3)->get();
        for ($i = 0; $i < 3; $i++) {
            $student[$i] = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
                ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
                ->join('course', 'course.id', '=', 'classbk.idCourse')
                ->select('student.*', 'classbk.name as classname', 'scholarship.name as scholarship', 'course.name as course', 'course.id as idcorse')
                ->where('student.name', 'LIKE', "%$search%")

                ->where('student.disable', '!=', '1')
                ->where('course.id', '=', $course[$i]->id)
                ->get();
        }
        $allstudents = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
            ->join('scholarship', 'scholarship.id', '=', 'student.idStudentShip')
            ->join('course', 'course.id', '=', 'classbk.idCourse')
            ->select('student.*', 'classbk.name as classname', 'scholarship.name as scholarship', 'course.name as course', 'course.id as idcorse')
            ->where('student.name', 'LIKE', "%$search%")

            ->where('student.disable', '!=', '1')
            ->paginate(1000);

        return view('Student.index', [
            "listall" => $allstudents,
            "list" => $student,
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
        $student->fee = $request->fee;
        $student->disable = 0;
        $student->save();
        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = ModelsStudent::find($id);
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
            ->select('student.*', 'classbk.name as classname', 'classbk.id as idclass', 'scholarship.name as scholarship', 'scholarship.id as idscholarship', 'course.name as course', 'course.id as idcorse')

            ->where('student.disable', '!=', '1')

            ->find($id);
        $class = Classroom::where('disable', '!=', '1')->get();
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
        ModelsStudent::where('id', $id)->update([
            "idClass" => $request->get('class'),
            "name" => $request->get('name'),
            "gender" => $request->get('gender'),
            "dateBirth" => $request->get('DoB'),
            "Email" => $request->get('email'),
            "phone" => $request->get('phone'),
            "address" => $request->get('address'),
            "idStudentShip" => $request->get('scholarship'),
            "fee" => $request->get('fee'),
        ]);

        return redirect(Route('students.index'));
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
    public function hide($id)
    {
        ModelsStudent::where('id', $id)->update([
            "disable" => 1,
        ]);
        return redirect(Route('students.index'));
    }
}
