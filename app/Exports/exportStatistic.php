<?php

namespace App\Exports;

use App\Fee;
use App\Models\Fee as ModelsFee;
use App\Models\SubFee;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class exportStatistic implements
    FromArray,
    WithHeadings,
    WithMapping
{
    public function __construct($month)
    {
        $this->month = $month;
    }
    /**
     * @var Fee $fee
     */
    public function map($fee): array
    {
        // dd($fee);

        $data = [
            $fee->idFee,
            "BKC" . sprintf("%03d", $fee->id),
            $fee->name,
            $fee->payer,
            $fee->note,
            date_format(date_create($fee->date), "d/m/Y"),
            $fee->countPay,
            ($fee->payment == null) ? "-" : $fee->payment,
            ($fee->payfee),
        ];
        // dd($data);
        return $data;
    }
    public function headings(): array
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y H:i', time());

        return [
            ['BẢN THỐNG KÊ DOANH THU TÍNH ĐẾN ' . $date],
            [
                'Mã đơn',
                'Mã sinh viên',
                'Họ tên',
                'Người nộp',
                'Ghi chú',
                'Ngày nộp',
                'Đợt',
                'Hình thức đóng',
                'Số tiền',
            ]

        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function array(): array
    {
        // return Fee::all();
        $month = $this->month;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if ($month == 1) {
            $date = date('Y-m-d', time());
            $month1 = strtotime(date("Y-m-d", strtotime($date)) . " -1 month");
            $month1 = strftime("%Y-%m", $month1);
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfeee', 'fee.countPay', 'payment.name as payment')
                ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") = ?', [$month1])
                // ->select('fee.id')
                ->get();
            $subfee = SubFee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')
                ->whereraw('DATE_FORMAT(subfee.date, "%Y-%m") = ?', [$month1])
                ->get();
        } elseif ($month == 3) {
            $date = date('Y-m-d', time());
            $month3 = strtotime(date("Y-m-d", strtotime($date)) . " -3 month");
            $month3 = strftime("%Y-%m", $month3);
            $date2 = date('Y-m', time());
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfee',  'fee.countPay', 'payment.name as payment')
                ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") < ? and DATE_FORMAT(fee.date, "%Y-%m") >= ? ', [$date2, $month3])
                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')
                ->whereraw('DATE_FORMAT(subfee.date, "%Y-%m") < ? and DATE_FORMAT(subfee.date, "%Y-%m") >= ?',  [$date2, $month3])
                ->get();
        } elseif ($month == "all") {
            //tất cả
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'payment.name as payment')

                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')

                ->get();
        } else {
            $date = date('Y-m', time());
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'payment.name as payment')
                ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") = ?', [$date])
                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')
                ->whereraw('DATE_FORMAT(subfee.date, "%Y-m") = ?', [$date])
                ->get();
            // $date = date('Y-m', time());
            // $fee = Fee::join('student', 'fee.idStudent', '=', 'student.id')
            //     ->join('payment', 'payment.id', '=', 'fee.idMethod')
            //     ->select('student.*', 'fee.id as idfee', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'fee.payer', 'fee.id as idFee', 'payment.name as payment', 'fee.disable as check')
            //     ->whereraw('DATE_FORMAT(fee.date, "%Y-%m") = ?', [$date])
            //     // ->select('fee.id')
            //     ->get();
            // $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
            //     ->select('student.*', 'subfee.id as idfee', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay', 'subfee.payer', 'subfee.id as idFee', 'subfee.disable as check')
            //     ->whereraw('DATE_FORMAT(subfee.date, "%Y-m") = ?', [$date])
            //     ->get();
        }
        $all = [];
        foreach ($fee as $item) {
            $item->idFee = "HP" . $item->idFee;
            array_push($all, $item);
        }
        foreach ($subfee as $item) {
            $item->idFee = "PP" . $item->idFee;
            array_push($all, $item);
        }
        // $all = [];
        // $all = array_merge($fee, $subfee);
        // dd($all);
        return
            $all;
    }
}
