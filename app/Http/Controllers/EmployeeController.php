<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Exception;
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
        $employee = Employee::where('id', $id)->first();

        return view('Employee.edit', [
            "employee" => $employee,
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

        $thisemployee = Employee::where('id', $id)->first();

        $checkusername = Employee::where('userName', $request->userName)->first();
        $checkphone = Employee::where('phone', $request->phone)->first();
        $checkemail = Employee::where('email', $request->email)->first();

        if ($checkusername !== null && $thisemployee->userName != $request->userName) {
            return redirect()->route('employee.edit', [$id,])->with('errusername', "Tên đăng nhập này đã tồn tại!");
        } else
        if ($checkphone !== null && $thisemployee->phone != $request->phone) {
            return redirect()->route('employee.edit', [$id,])->with('errphone', "Số điện thoại này đã tồn tại!");
        } else
        if ($checkemail !== null && $thisemployee->email != $request->email) {
            return redirect()->route('employee.edit', [$id,])->with('erremail', "Email này đã tồn tại!");
        } else {
            Employee::where('id', $id)->update([
                "userName" => $request->userName,
                "email" => $request->email,
                "name" => $request->name,
                "phone" => $request->phone,
                "dateBirth" => $request->DoB,
                "gender" => $request->gender,
                "address" => $request->address,
            ]);
            return redirect()->route('employee.edit', [$id,]);
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
    public function changepass($id)
    {
        return view('Employee.changepass', [
            "id" => $id,
        ]);
    }
    public function changepassProcess(Request $request, $id)
    {
        try {
            $oldpass = Employee::where([
                ['id', $id],
                ["passWord", $request->pass]
            ])->firstorFail();
            Employee::where('id', $id)->update([
                "passWord" => $request->newpass,
            ]);
            return redirect()->route('employee.edit', [$id,]);
        } catch (Exception $e) {
            return redirect()->route('employee.changepass', [$id,])->with('error', "sai mật khẩu");
        }
    }
}
