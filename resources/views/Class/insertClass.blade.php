@extends('layouts.layout')
@section('main')
    <form action="{{ route('class.insertClassprocess') }}" method="POST" enctype="multipart/form-data">  
        @csrf
    <div class="col-md-6 col-md-offset-3">
        <div class="card" style="min-height: 250px;text-align: center;">
            <h2>Thêm danh sách lớp</h2>
            <label style="color: red;    font-size: large;">lưu ý nhập danh sách phải đúng theo như file mẫu</label>
            <a href="{{ route('class.insertClassExample') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                <i class="
                pe-7s-add-user
                " > file mẫu</i>
            </a>
            <div class="content " style="height: 90px;">
                <div class="form-group">
                    <input type="file" name="excel" class="form-control" style="" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                     <button type="submit" name="btn"class="btn btn-primary btn-fill" 
                    style="" >Đồng ý</button>
                </div>
               
            </div>
            <span style="color:red;">@if (Session::has('err'))
                    {{Session::get('err')}}
                    @endif</span>
        </div> 
        
    </div>
    </form>
    
@endsection