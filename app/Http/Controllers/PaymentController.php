<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payment = Payment::all();
        return View('Payment.index', [
            "payment" => $payment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.create');
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
        $sale = $request->sale;
        $countPer = $request->countPer;

        try {
            $payment = Payment::where('name', $name)
                ->where('sale', $sale)
                ->firstorFail();

            return redirect()->route('payment.create')->with('err', "Đã tồn tại");
        } catch (Exception $e) {
            $up = new Payment();
            $up->name = $name;
            $up->sale = $sale;
            $up->$countPer;
            $up->save();
            return redirect()->route('payment.index');
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
        $payment = Payment::find($id);
        return view('Payment.edit', [
            "payment" => $payment,
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
        $sale = $request->sale;
        $countPer = $request->countPer;

        // $payment = Payment::where('name', $name)
        //         ->where('sale', $sale)
        //         -
        //         ->first();
        // if($payment!==null&&) {


        //     return redirect()->route('payment.edit', [$id,])->with('err', "Đã tồn tại");
        // } else {
        //     Payment::where('id', $id)->update([
        //         "name" => $name,
        //         "sale" => $sale,
        //         "countPer" => $countPer,
        //     ]);
        //     return redirect()->route('payment.index');
        // }
        try {
            $payment = Payment::where('name', $name)
                ->where('sale', $sale)
                ->where('id', '!=', $id)
                ->firstorFail();

            return redirect()->route('payment.edit', [$id,])->with('err', "Đã tồn tại");
        } catch (Exception $e) {
            Payment::where('id', $id)->update([
                "name" => $name,
                "sale" => $sale,
                "countPer" => $countPer,
            ]);
            return redirect()->route('payment.index');
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
