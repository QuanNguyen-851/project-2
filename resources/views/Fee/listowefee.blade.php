@extends('layouts.layout')
@section('main')  
<div class="card" style=" margin-bottom: 5px;">
<h2>Danh sách nợ học phí </h2>
<div style=" height: 48px;">
    <form action="{{ route('fee.listowefee') }}" method="get">   
    <div class="col-md-4" style="width: 20%;    float: left;">
            
            <div class="form-group">
                <select name="month" class="selectpicker" id ="check" data-style="btn-default btn-block" data-menu-style="dropdown-blue" >
                    <option value="all" >Tất cả</option>
                    <option value="5" @if ($month == 5) selected @endif >Nợ từ 1-5 tháng (Danh sách cấm thi)</option>
                    <option value="6"@if ($month == 6) selected @endif>Nợ 6 tháng (Danh sách đình chỉ 30 ngày)</option>
                    <option value="7"@if ($month == 7) selected @endif>Nợ >7 tháng (Buộc thôi học)</option> 
                </select>
        </div>
    </div>    
    <button class="btn btn-primary"  style="float: left;">Đồng ý</button></form>
    <a class="btn btn-primary btn-round" style="float: right;margin-right: 10px;">gửi mail</a>
</div>

</div>
<div class="card">
    <div class="toolbar">
        <!--   Here you can write extra buttons/actions for the toolbar  -->
    @php
        if(isset($_GET['month'])){
            $month = $_GET['month'];
        }else{
            $month = 0;
        }
    @endphp
        <a class="btn btn-warning" style="margin-right: 25px;" href="{{ route('fee.exportlistowefee', $month) }}">Xuất danh sách</a>
    </div>
    <table id="bootstrap-table" class="table">
        <thead>
            <th data-field="id" class="text-center">ID </th>
            <th data-field="name" data-sortable="true">Họ và tên</th>
            <th data-field="salary" data-sortable="true">Ngày sinh</th>
            <th data-field="country" data-sortable="true">Lớp</th>
            <th  data-sortable="true">Số đợt phải đóng</th>
            <th  data-sortable="true">Số đợt đã đóng</th>
            <th data-sortable="true" >Nợ</th>
            <th data-field="actions" >Actions</th>
        </thead>
        <tbody>
            @foreach ($studentowefee as $item)
                <tr>            
                <td>{{"BKC".sprintf("%03d", $item->id)}}</td>
                <td>{{$item->name}}</td>
                <td>{{date_format(date_create($item->dateBirth),"d/m/Y")}}</td>
                <td>{{$item->class}}</td>
                <td>{{$item->countMustPay." đợt"}}</td>
                <td>{{$item->countPay." đợt"}}</td>
                <td>{{number_format($item->owe). "VNĐ"}}</td>
                <td> <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử</a></td>
                </tr>
            @endforeach

        </tbody>
    </table>
  </div>
@endsection
