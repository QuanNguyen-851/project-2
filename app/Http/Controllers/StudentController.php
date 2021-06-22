<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
