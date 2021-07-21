@component('mail::message')
Học viện Công nghệ Bkacad trân trọng thông báo công nợ học phí của sinh viên {{$info ->name}}<br>





@php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y H:i', time());
        if($info->countMustPay - $info->countPay <=0){
            $count = 0;
            $info->owe =0;
        }else{
            $count = $info->countMustPay - $info->countPay;
        }
        if($info->owesub <=0){
            $info->owesub =0;
        }       
@endphp
Sinh viên : {{$info ->name."("."BKC".sprintf("%03d", $info->id).")"}}<br>
Số đợt phải đóng học phí của sinh viên: {{$info->countMustPay}}<br>
Số đợt đã đóng học phí của sinh viên: {{$info->countPay}} <br>
Như vậy sinh viên có {{ $count }} đợt  @if (($count)%5==0)
    (~{{($count)/5}}Kỳ)
@endif  chưa đóng <br>
Học phí còn nợ tính đến: {{$date." (". number_format($info->owe)." VNĐ".")"}} <br>
Phụ phí còn nợ tính đến: {{$date." (". number_format($info->owesub)." VNĐ".")"}} <br>
Tổng nợ tính đến {{$date." (". number_format($info->owe + $info->owesub)." VNĐ".")"}} <br>
@if ($count!=0)
    Dựa theo quy định của học viện sinh viên sẽ bị @if ($info->countMustPay - $info->countPay >=1 && $info->countMustPay - $info->countPay <5)
CẤM THI LẦN MỘT<br>
@elseif($info->countMustPay - $info->countPay==5)
CẤM THI LẦN MỘT (nếu sinh viên nợ 6 đợt liên tiếp sẽ bị đình chỉ học 30 ngày)<br>
@elseif($info->countMustPay - $info->countPay==6)
ĐÌNH CHỈ 30 NGÀY (nếu sinh viên nợ 7 đợt liên tiếp sẽ bị buộc thôi học)<br>
@elseif($info->countMustPay - $info->countPay>=7)
BUỘC THÔI HỌC<br>
@endif

    
@endif

Mọi thắc mắc xin vui lòng liên hệ với cô An Thị Hiên tại P207 hoặc gửi tới hòm thư havt@bkacad.edu.vn để được giải đáp<br>
{{-- <a class="btn btn-primary" href="{{ route('student', $info->id) }}">lịch sử</a> --}}
@component('mail::button', ['url' => "http://127.0.0.1:8000/student/$info->id"])
lịch sử
@endcomponent


Trân trọng <br>
{{ config('app.name') }}
@endcomponent
