<?php

namespace App\Http\Controllers;

use App\Exports\insertClassExample;
use App\Imports\ClassImport;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Major;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $allclass = Classroom::join('major', 'classbk.idMajor', '=', 'major.id')
            ->join('course', 'classbk.idCourse', '=', 'course.id')
            ->where('classbk.disable', '!=', '1')
            ->where('course.disable', '!=', '1')
            ->select('classbk.*', 'major.name as major', 'major.shortName as shortName', 'course.name as course')
            ->orderBy('classbk.id', 'desc')
            ->get();
        return view('Class.index', [
            "class" => $allclass,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $major = Major::all();
        $Course = Course::all();
        return view('Class.create', [
            "major" => $major,
            "course" => $Course,
        ]);
        return view('Class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $class = new Classroom();
        $class->name = $request->class;
        $class->idMajor = $request->major;
        $class->idCourse = $request->course;
        $class->disable = 0;
        $check = Classroom::where('name', '=', $request->class)->first();
        if ($check !== null) {
            // return redirect(route('class.create', [
            //     "err" => 1,
            // ]));
            return redirect(route('class.create'))->with('err', "Lớp này đã tồn tại");
        } else {
            $class->save();
            return redirect(route('class.index'));
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
        $major = Major::all();
        $Course = Course::all();
        $class = Classroom::find($id);
        return view('Class.edit', [
            "major" => $major,
            "course" => $Course,
            "class" => $class,
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
        // dd($request);
        try {
            $class = Classroom::select('name')->where('name', $request->class)->firstorFail();

            if ($request->class == $class->name) {
                Classroom::where('id', $id)->update([
                    "name" => $request->get('class'),
                    "major" => $request->get('major'),
                    "course" => $request->get('course'),
                ]);
                return redirect()->route('class.index');
            } else {
                return redirect()->route('class.edit', [
                    $id,
                ])->with('err', "Lớp này đã tồn tại");
            }
        } catch (Exception $e) {

            Classroom::where('id', $id)->update([
                "name" => $request->get('class'),
                "idMajor" => $request->get('major'),
                "idCourse" => $request->get('course'),
            ]);
            return redirect()->route('class.index');
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

    public function hide($id)
    {
        echo "hide";
        Classroom::where('id', $id)->update([
            "disable" => 1,
        ]);
        return redirect(Route('class.index'));
    }
    public function insertClass()
    {

        return view('Class.insertClass');
    }
    public function insertClassprocess(Request $request)
    {
        if ($request->file('excel') === null) {
            return redirect()->route("class.insertClass")->with('err', "Vui lòng chọn file");
        }
        // try {
        Excel::import(new ClassImport, $request->file('excel'));

        return redirect()->route('class.index');
        // } catch (Exception $e) {
        //     return redirect()->route("class.insertClass")->with('err', "Không thể thực hiện! Vui lòng điền danh sách theo file hướng dẫn");
        // }
    }
    public function insertClassExample()
    {

        return Excel::download(new insertClassExample, 'insertClassExample.xlsx');
    }
}
