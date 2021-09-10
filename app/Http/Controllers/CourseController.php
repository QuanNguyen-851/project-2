<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listallCourse = Course::select('course.*')->where('disable', '=', '0')->get();
        return view('course.index', [
            'listallCourse' => $listallCourse,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $course = new Course();
        $course->name = $request->course;
        $course->year = $request->year;
        $course->countMustPay = '0';
        $course->countSubFeeMustPay = "0";
        $course->disable = '0';
        $course->save();
        return redirect(route('course.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $passed = Course::select('course.*')->where('disable', '=', '1')->get();
        return view('course.passed', [
            'passed' => $passed
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $view = Course::select('course.*')
            ->where('disable', '=', '0')
            ->find($id);
        return view('course.edit', [
            'course' => $view
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
        Course::where('id', $id)->update([
            "name" => $request->get('course'),
            "year" => $request->get('year'),
        ]);
        return redirect(route('course.index'));
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
        Course::where('id', $id)->update([
            "disable" => 1,
        ]);
        Classroom::where('idCourse', $id)->update([
            "disable" => 1,
        ]);
        return redirect(route('course.index'));
    }
    public function passed()
    {
        $passed = Course::select('course.*')->where('disable', '=', '1');
        return view('course.passed', [
            'passed' => $passed,
        ]);
    }
}
