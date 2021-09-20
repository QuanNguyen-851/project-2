<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\SubFee;
use Illuminate\Http\Request;

class SubPayFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        ($request->fee >= 1000000) ? $disable = 1 : $disable = 0;

        SubFee::insert([
            'idStudent' => $request->id,
            'note' => $request->note,
            'fee' => $request->fee,
            'accountant' => $request->session()->get('name'),
            'payer' => $request->nameStudent,
            'date' => date('Y-m-d'),
            'class_bk' => $request->classStudent,
            'countPay' => $request->count,

            'disable' => $disable

        ]);
        $maxid = SubFee::select('subfee.id')
            ->where('idStudent', $request->id)
            ->max('id');
        return view('fee.subsuccess', [
            'id' => $maxid
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $info = Student::join('classbk', 'classbk.id', '=', 'student.idClass')
            ->join('course', 'classbk.idCourse', '=', 'course.id')
            ->join('major', 'classbk.idMajor', '=', 'major.id')
            ->Select('student.*', 'classbk.name as nameclass', 'course.name as course', 'major.name as major')
            ->where('student.id', $id)
            ->first();

        $maxpayment = SubFee::select('subfee.*')
            ->where('subfee.idStudent', $id)->max('id');
        $payment = SubFee::select('subfee.*')
            ->where('id', $maxpayment)->first();
        return view('fee.subfee', [
            'payment' => $payment,
            'info' => $info
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
    public function addcount()
    {
        $course = Course::Select('course.*')
            ->where('countSubFeeMustPay', '<', '6')
            ->where('disable', '=', '0')
            ->get();
        foreach ($course as $course) {
            $count = $course->countSubFeeMustPay;
            Course::where('id', $course->id)
                ->update(['countSubFeeMustPay' => $count + 1]);
        }
        // return redirect(route('dashboard'));
        return back();
    }
}
