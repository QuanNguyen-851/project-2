<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $employee = Employee::where('name', 'LIKE', "%$search%")
            ->orwhere('userName', 'LIKE', "%$search%")
            ->paginate(100);

        $employeemi = Employee::where([
            ['permission', '1'],
            ['block', '!=', '1'],
            ['name', 'LIKE', "%$search%"],
        ])
            ->orwhere([
                ['permission', '1'],
                ['block', '!=', '1'],
                ['userName', 'LIKE', "%$search%"],
            ])

            ->get();
        $employeeac = Employee::where([
            ['permission', '0'],
            ['block', '!=', '1'],
            ['name', 'LIKE', "%$search%"],
        ])
            ->orwhere([
                ['permission', '0'],
                ['block', '!=', '1'],
                ['userName', 'LIKE', "%$search%"],
            ])

            ->get();
        return view('Employee.index', [
            "allemployee" => $employee,
            "Miemployee" => $employeemi,
            "Acemployee" => $employeeac,
            "search" => $search,
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('Employee.edit');
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
    public function block($id)
    {
        Employee::where('id', $id)->update([
            "block" => 1,
        ]);
        return redirect()->route('employee.index');
    }
    public function unblock($id)
    {
        Employee::where('id', $id)->update([
            "block" => 0,
        ]);
        return redirect()->route('employee.index');
    }
}
