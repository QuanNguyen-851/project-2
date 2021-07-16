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
        $date = date('m', time());
        if ($month == 1) {
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfeee', 'fee.countPay', 'payment.name as payment')
                ->whereraw('DATE_FORMAT(fee.date, "%m") = ?', [$date - 1])
                // ->select('fee.id')
                ->get();
            $subfee = SubFee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')
                ->whereraw('DATE_FORMAT(subfee.date, "%m") = ?', [$date - 1])
                ->get();
        } elseif ($month == 3) {
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfee',  'fee.countPay', 'payment.name as payment')
                ->whereraw('DATE_FORMAT(fee.date, "%m") < ? and DATE_FORMAT(fee.date, "%m") >= ? ', [$date, $date - 3])
                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')
                ->whereraw('DATE_FORMAT(subfee.date, "%m") < ? and DATE_FORMAT(subfee.date, "%m") >= ?',  [$date, $date - 3])
                ->get();
        } else {
            $fee = ModelsFee::join('student', 'fee.idStudent', '=', 'student.id')
                ->join('payment', 'payment.id', '=', 'fee.idMethod')
                ->select('fee.id as idFee', 'student.id', 'student.name', 'fee.payer', 'fee.note', 'fee.date', 'fee.fee as payfee', 'fee.countPay', 'payment.name as payment')
                ->whereraw('DATE_FORMAT(fee.date, "%m") = ?', [$date])
                // ->select('fee.id')
                ->get();
            $subfee = Subfee::join('student', 'student.id', '=', 'subfee.idStudent')
                ->select('subfee.id as idFee', 'student.id', 'student.name', 'subfee.payer', 'subfee.note', 'subfee.date', 'subfee.fee as payfee', 'subfee.countPay')
                ->whereraw('DATE_FORMAT(subfee.date, "%m") = ?', [$date])
                ->get();
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
