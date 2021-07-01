@component('mail::message')
# Yêu cầu xác thực

Đây là mã xác thực vui lòng không gửi cho bất cứ ai. 

{{$rand}}


Cảm ơn,<br>
{{ config('app.name') }}
@endcomponent
