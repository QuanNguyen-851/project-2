@extends('layouts.layout')
@section('main')

    <form action="{{ route('fee.exportalllistowefeeprocess') }}" method="POST" enctype="multipart/form-data">  
        @csrf
    <div class="col-md-6 col-md-offset-3">
        <div class="card" style="min-height: 250px;text-align: center;">
            
                <h2>Xuất danh sách nợ học phí</h2>
            <div class="form-group">
                    <label >Lớp</label>
            <input type="hidden" value="{{$month}}" name="month">
                    <select name="class" class="selectpicker" data-title="Tất cả"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                        <option value="0" 
                            >Tất cả</option>
                        @foreach ($class as $item)
                    <option value="{{$item->id}}" 
                    >{{$item->name}}</option>
                        @endforeach
                    </select>
             
               
             
            </div> 
            <div class="col-sm-4 col-md-offset-3">
            <button type="submit" class="btn btn-info btn-fill pull-right">Đồng ý</button></div>
        </div>
    </div>
    </form>
    
@endsection