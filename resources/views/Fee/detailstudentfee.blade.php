@extends('layouts.layout')
@section('main')
<div class="col-md-10 col-md-offset-1">
    <div class="card">
        <h2 style="text-align: center;padding: 10px; font-family: ui-monospace">PHIẾU THU</h2>
        <h3 style="text-align: center;font-family: -webkit-body;">Ngày: {{ date_format(date_create($detail->date)," d/m/Y") }}</h3>
        <div style="padding: 35px">
        <p>Mã đơn: {{"HP".$detail->id}}</p>
            <P>Họ tên người nộp tiền: {{ $detail->payer}}</P>
            <p>Sinh viên: {{ $detail->name."(".date_format(date_create($detail->dateBirth),"d/m/Y").")"."_".$detail->address."_".$detail->class_bk}}</p>

            <p>Hình thức đóng: {{ $detail->payment." (". number_format($fee)."/".$detail->payment.")"}}</p>
        <p>Đợt: {{$detail->countPay}} {{
        $detail->countPer!=1? " (". $detail->payment ." " . $detail->countPay/ $detail->countPer .")"
        :""
        }}</p>
            <p>Ghi chú: {{ $detail->note}}</p>
            <P style="color:red">Số tiền: {{number_format($detail->fee)."VNĐ"}}</P>
            <p>Người lập phiếu : {{$detail->accountant}}</p>
            <a class="btn btn-primary" href="{{ route('fee.studentfee', $detail->idStudent) }}"><i class="pe-7s-back" ></i> Lịch sử </a>
            <a class="btn btn-warning" style="margin-left: 35%;" href="{{ route('fee.exportwordfee', $detail->id) }}">Lập phiếu</a>
        </div>
        
    </div>
</div>
@endsection