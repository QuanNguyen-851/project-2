<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PayFeeController extends Controller
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

        $lastpay = Fee::select('fee.*')
            ->where('fee.idStudent', $request->id)->max('id');
        if (isset($lastpay)) {
            $payment = Fee::select('fee.*')
                ->where('id', $lastpay)->first();
            $lastcount = $payment->countPay;
            $count = $lastcount + $request->count;
        } else {
            $count = 0 + $request->count;
        }
        $student = Student::select('*')
            ->where('id', $request->id)
            ->first();
        $getId = Payment::select('*')
            ->where('countPer', $request->method)
            ->first();
        (($student->fee * $request->count - ($student->fee * $request->count * $getId->sale / 100)) <= $request->fee) ? $disable = 1 : $disable = 0;
        $id = $getId->id;
        Fee::insert([
            'idStudent' => $request->id,
            'idMethod' => $id,
            'note' => $request->note,
            'fee' => $request->fee,
            'accountant' => $request->session()->get('name'),
            'payer' => $request->nameStudent,
            'date' => date('Y-m-d'),
            'class_bk' => $request->classStudent,
            'countPay' => $count,
            'disable' => $disable
        ]);
        $maxid = Fee::select('fee.id')
            ->where('idStudent', $request->id)
            ->max('id');
        return view('fee.success', [
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
        $method = Payment::Select('payment.*')->get();
        $info = Student::join('classbk', 'classbk.id', '=', 'student.idClass')
            ->join('course', 'classbk.idCourse', '=', 'course.id')

            ->join('major', 'classbk.idMajor', '=', 'major.id')
            ->Select('student.*', 'classbk.name as nameclass', 'course.name as course', 'major.name as major')

            ->where('student.id', $id)
            ->first();

        $maxpayment = Fee::select('fee.*')
            ->where('fee.idStudent', $id)->max('id');
        $payment = Fee::select('fee.*')
            ->where('id', $maxpayment)->first();


        return View('fee.fee', [
            'method' => $method,
            'info' => $info,
            'payment' => $payment
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
        $method = Payment::Select('payment.*')->get();
        $info = Fee::join('student', 'idStudent', '=', 'student.id')
            ->join('payment', 'fee.idMethod', '=', 'payment.id')
            ->select('fee.*', 'payment.*', 'fee.id as idfee')
            ->where('fee.id', $id)
            ->first();
        $student = Student::select('*')
            ->where('id', $info->idStudent)
            ->first();
        $left = ($student->fee * $info->countPer - ($student->fee * $info->countPer * $info->sale / 100)) - $info->fee;
        return view('fee.dongbu', [
            'info' => $info,
            'method' => $method,
            'left' => $left
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
        (($request->paid + $request->paymore) >= $request->thieu) ? $disable = 1 : $disable = 0;
        Fee::where('id', $id)
            ->update([
                'note' => $request->note,
                'fee' => $request->paid + $request->paymore,
                'date' => date('Y-m-d'),
                'disable' => $disable
            ]);
        return view('fee.success', [
            'id' => $id,
            'paymore' => $request->paymore,
        ]);
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
            ->where('countMustPay', '<', '30')
            ->where('disable', '=', '0')
            ->get();
        foreach ($course as $course) {
            $count = $course->countMustPay;
            Course::where('id', $course->id)
                ->update(['countMustPay' => $count + 1]);
        }
        // return redirect(route('dashboard'));
        return back();
    }
}
