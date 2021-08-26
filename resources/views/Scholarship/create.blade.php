@extends('layouts.layout')
@section('main')
<div class="card">
    <form action="{{ route('scholarship.store') }}" method="post" id="updatevalidateform"> 
        @csrf
       
    <div class="header text-center">Thêm học bổng</div>
    <div class="content">

        <div class="form-group">
            <label class="control-label">Tên</label>
            <input class="form-control"
                   name="name"
                   type="text"
                   required="true"
        
            />
        </div>

        <div class="form-group">
            <label class="control-label">Số tiền </label>
            <input class="form-control"
                   name="scholarship"
                   type="text"
                   required="true"
                   number="true"
                   
            />
        </div>
        <span style=" color: red;font-size: 12px;margin-left: 44px;">

            @if (Session::has('err'))
            {{Session::get('err')}}
                
            
            @endif
        </span>


        
    </div>

    <div class="footer text-center">
        <button type="submit" class="btn btn-info btn-fill btn-wd">Thêm</button>
    </div>
    </form>
</div>


        


</div>
@endsection