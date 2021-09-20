@extends('layouts.layout')
@section('main')
<div class="card">
    <form id="loginFormValidation" action="{{route('subfee.store')}}" method="post">
        @csrf
        @if (isset($payment))
        @php
            $paid = $payment->countPay+1
        @endphp

        <div class="header text-center">{{$info->name}} Đóng Phụ Phí {{($payment->countPay<6)? "kỳ $paid":""}}</div>

        @else
        <div class="header text-center">{{$info->name}} Đóng Phụ Phí Kỳ 1</div>
        @endif
        <div style="width: 100%; height: 20px;" >
        <a style="float: right;" class="btn btn-warning" href="{{ route('fee.show', $info->id) }}">Chuyển sang đóng học phí</a></div>
        <div class="content">
            <input type="hidden" name="id" value="{{$info->id}}">
            @if(isset($payment))
            <div class="form-group">
                <label class="control-label">Note</label>
                <textarea required name="note" class="form-control" placeholder="Chú thích" rows="5">{{$payment->note}}</textarea>
            </div>
            @else
            <div class="form-group">
                <label class="control-label">Note</label>
                <textarea required name="note" class="form-control" placeholder="Chú thích" rows="5">{{$info->name}} Đóng phụ phí kỳ .. (tháng/năm) 1,000,000/kỳ {{$info->major}}:{{$info->nameclass}}{{$info->course}}</textarea>
            </div>
            @endif
            <div class="form-group">
                <label class="control-label">Sồ tiền đóng (VND)</label>
                <input class="form-control"
                id="pay"
                name="fee"
                type="number"
                required="true"
                value="1000000"
                min="1"
                max="6000000"
                readonly

         />
            </div>
            <div class="form-group">
                <label class="control-label">Người đóng</label>
                <input class="form-control"
                name="nameStudent"
                type="text"
                
                value="{{$info->name}}"
         />
            </div>
            <div class="form-group">
                <label class="control-label">Lớp</label>
                <input class="form-control"
                name="classStudent"
                type="text"
                readonly="true"
                value="{{$info->nameclass}}{{$info->course}}"
         />
            </div>
         <div>
            <input name='count'
            type="number" 
            hidden="true"
            @if (isset($payment))
            value="{{$payment->countPay+1}}"
            @else
            value="1"
            @endif
            >
        </div>
        <div class="footer text-center">

            <button type="submit" class="btn btn-info btn-fill btn-wd" {{(isset($payment) && $payment->countPay>=6)? 'disabled':''}} >Đóng</button>

        </div>
        @if (isset($payment) && $payment->countPay >= 6)
                                        <center><div class="form-group">
                                            <label style="color:red">Đã đóng đủ phụ phí của 3 năm</label>
                                        </div><center>
        @endif
    </form>
</div>
@endsection