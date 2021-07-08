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
            ->orwhere('email', 'LIKE', "%$search%")
            ->paginate(100);

        $employeemi = Employee::where([
            ['permission', '1'],
            ['block', '!=', '1'],
            ['name', 'LIKE', "%$search%"],
        ])
            ->orwhere([
                ['permission', '1'],
                ['block', '!=', '1'],
                ['email', 'LIKE', "%$search%"],
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
                ['email', 'LIKE', "%$search%"],
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
        return view('Employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkemail = Employee::where('email', $request->email)->first();
        $checkphone = Employee::where('phone', $request->phone)->first();

        if ($checkemail !== null) {
            return redirect()->route('employee.create')->with('erremail', "Email này đã tồn tại");
        } elseif ($checkphone !== null) {
            return redirect()->route('employee.create')->with('errphone', "Số điện thoại này đã tồn tại");
        } else {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;

            $employee->password = "123456";
            $employee->gender = $request->gender;
            $employee->dateBirth = $request->DoB;
            $employee->address = $request->address;
            $employee->permission = "0";
            $employee->block = "0";
            $employee->save();
            return redirect()->route('employee.index');
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
        $employee = Employee::where('id', $id)->first();

        return view('Employee.show', [
            "employee" => $employee,
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


        $checkphone = Employee::where('phone', $request->phone)->first();
        $checkemail = Employee::where('email', $request->email)->first();
        if ($id == Session()->get('id')) {
            if ($checkphone !== null && $thisemployee->phone != $request->phone) {
                return redirect()->route('employee.edit', [$id,])->with('errphone', "Số điện thoại này đã tồn tại!");
            } else
            if ($checkemail !== null && $thisemployee->email != $request->email) {
                return redirect()->route('employee.edit', [$id,])->with('erremail', "Email này đã tồn tại!");
            } else {
                Employee::where('id', $id)->update([

                    "email" => $request->email,
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "dateBirth" => $request->DoB,
                    "gender" => $request->gender,
                    "address" => $request->address,

                ]);

                return redirect()->route('employee.edit', [$id,]);
            }
        } else {
            if ($checkphone !== null && $thisemployee->phone != $request->phone) {
                return redirect()->route('employee.show', [$id,])->with('errphone', "Số điện thoại này đã tồn tại!");
            } else
            if ($checkemail !== null && $thisemployee->email != $request->email) {
                return redirect()->route('employee.show', [$id,])->with('erremail', "Email này đã tồn tại!");
            } else {
                Employee::where('id', $id)->update([

                    "email" => $request->email,
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "dateBirth" => $request->DoB,
                    "gender" => $request->gender,
                    "address" => $request->address,

                ]);

                return redirect()->route('employee.show', [$id,]);
            }
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
            return redirect()->route('logout');
        } catch (Exception $e) {
            return redirect()->route('employee.changepass', [$id,])->with('error', "sai mật khẩu");
        }
    }
}
