<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use App\Models\Student as ModelsStudent;
use Exception;
use Illuminate\Http\Request;
use Student;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scholarship = Scholarship::all();
        return view("Scholarship.index", [
            "scholarship" => $scholarship,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Scholarship.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $scho = $request->scholarship;

        try {
            $scholarship = Scholarship::where('name', $name)
                ->where('scholarship', $scho)
                ->firstorFail();

            return redirect()->route('scholarship.create')->with('err', "Mức học bổng này đã tồn tại");
        } catch (Exception $e) {
            $up = new Scholarship();
            $up->name = $request->name;
            $up->scholarship = $request->scholarship;
            $up->save();

            return redirect()->route('scholarship.index');
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
        $scholarship = scholarship::find($id);
        return View('Scholarship.edit', [
            'scholarship' => $scholarship,
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

        $name = $request->name;
        $scho = $request->scholarship;

        try {
            $scholarship = Scholarship::where('name', $name)
                ->where('scholarship', $scho)
                ->firstorFail();
            print_r($scholarship);
            return redirect()->route('scholarship.edit', [$id,])->with('err', "Mức học bổng này đã tồn tại");
        } catch (Exception $e) {
            //update cho bảng học bổng
            Scholarship::where('id', $id)->update([
                "name" => $request->name,
                "scholarship" => $request->scholarship,

            ]);
            //update lại số tiền phải đóng cho tất cả các thằng nào dùng mức học bổng đagn được thay đổi
            $student = ModelsStudent::join('classbk', 'student.idClass', '=', 'classbk.id')
                ->join('major', 'classbk.idMajor', '=', 'major.id')
                ->select('major.fee as feemustpay', 'student.id as id')
                ->where('student.disable', '!=', '1')
                ->where('student.idStudentShip', '=', $id)->get();

            foreach ($student as $item) {

                $fee = $item->feemustpay - round($scho / 30, -5);
                echo ($fee);
                if ($fee < 0) {
                    $fee = 0;
                }

                ModelsStudent::where('id', $item->id)->update([
                    "fee" => $fee,
                ]);
            }

            return redirect()->route('scholarship.index');
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
}
