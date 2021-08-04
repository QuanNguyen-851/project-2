@extends('layouts.layout')
@section('main')  

<style>

    #no>a{
        background: #d0e4ff4a;
    }
</style>
 @php
       date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('d/m/Y H:i a', time());
    @endphp
    
<div class="card" style=" margin-bottom: 5px;">
<h2 style="margin-bottom: -5px;margin-left: 15px;">Danh sách nợ học phí  </h2><a style="margin-left: 15px;">(Danh sách được tính đến {{$date}})</a>
<div style=" height: 30px;">
    <div class="dropdown">

    <button style="margin-left: 10px;" class="btn btn-info btn-fill" type="button" id="dropdownMenu1" data-toggle="dropdown">
      @if ($month==5)
      Nợ từ 1-5 tháng (Danh sách cấm thi)
      @elseif($month==6)
      Nợ 6 tháng (Danh sách đình chỉ 30 ngày)
      @elseif($month==7)
      Nợ 7 tháng  trở lên (Buộc thôi học)
      @else
      Tất cả
      @endif
      <span class="caret"></span>
    </button>
  
    <ul class="dropdown-menu " role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" 
        href="{{ route('fee.listowefee',['month'=>0]) }}"
        >Tất cả </a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1"
         href="{{ route('fee.listowefee',['month'=>5]) }}"
         >Nợ từ 1-5 tháng (Danh sách cấm thi)</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1"
         href="{{ route('fee.listowefee',['month'=>6]) }}"
         >Nợ 6 tháng (Danh sách đình chỉ 30 ngày)</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" 
        href="{{ route('fee.listowefee',['month'=>7]) }}"
        >Nợ >7 tháng (Buộc thôi học)</a></li>
      
    </ul>
     <a id="sendmail"  href="{{ route('fee.warningMail') }}" class="btn btn-primary btn-round  btn-fill" style="float: right;margin-right: 10px;">
        
        Gửi mail thông báo</a>
    <a id="load"  class="btn btn-primary btn-round btn-fill" style="float: right;margin-right: 10px;display:none;">
        <i class="fa fa-spinner fa-spin"></i>
        Đang gửi vui lòng chờ</a>
  </div>
    </div>
 <div style="margin:10px">
     <a>Số sinh viên: {{$count}} </a>&emsp; 
     <a style="color:black;">Nợ học phí : {{number_format($sum)."VNĐ"}}</a>&emsp; 
     <a style="color:gray;">Nợ phụ phí : {{number_format($subsum)."VNĐ"}}</a>&emsp; 
    <a style="color:red;">Tổng : {{number_format($sum + $subsum)."VNĐ"}}</a>&emsp; 
</div>   


</div>
<div class="card" >
    <div class="toolbar">
        <!--   Here you can write extra buttons/actions for the toolbar  -->
   
        <a class="btn btn-warning  btn-fill" style="margin-right: 25px;" href="{{ route('fee.exportlistowefee', $month) }}">Xuất danh sách</a>
    </div>
    <table id="bootstrap-table" class="table">
       
        <thead>
            <th data-field="id" class="text-center">ID </th>
            <th data-field="name" data-sortable="true">Họ và tên</th>
            <th data-field="date" data-sortable="true">Ngày sinh</th>
            <th data-field="class" data-sortable="true">Lớp</th>
            <th data-field="fee" data-sortable="true">Học phí mỗi đợt</th>
            <th  data-sortable="true">Học phí nợ</th>
            <th  data-sortable="true">Phụ phí nợ </th>
            <th data-sortable="true" >Tổng</th>
            <th data-field="actions" >Actions</th>
        </thead>
        
        <tbody>
            
            @foreach ($studentowefee as $item)
                <tr>            
                <td>{{"BKC".sprintf("%03d", $item->id)}}</td>
                <td>{{$item->name}}</td>
                <td>{{date_format(date_create($item->dateBirth),"d/m/Y")}}</td>
                <td>{{$item->class}}</td>
                <td>{{number_format($item->fee). "VNĐ"}}</td>
                <td>{{number_format($item->owe). "VNĐ"}}</td>
                <td>{{number_format($item->owesub). "VNĐ"}}</td>
                <td>{{number_format($item->owe + $item->owesub). "VNĐ"}}</td>
                <td> <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử</a></td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
  
 

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $("#sendmail").click(function(){
      $("#sendmail").hide();
      $("#load").show();
    });
  });
  </script>


@endsection
