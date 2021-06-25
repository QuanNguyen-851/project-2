@extends('layouts.layout')
@section('main')
<div class="card">
    <form action="{{ route('payment.store') }}" method="post" id="updatevalidateform"> 
        @csrf
        
    <div class="header text-center">Thêm phương thức đóng</div>
    <div class="content">

        <div class="form-group">
            <label class="control-label">phương thức</label>
            <input class="form-control"
                   name="name"
                   type="text"
                   required="true"
       
            />
        </div>

        <div class="form-group">
            <label class="control-label">Giảm( %/đợt ) </label>
            <input class="form-control"
                   name="sale"
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
        <button type="submit" class="btn btn-info btn-fill btn-wd">Cập Nhật</button>
    </div>
    </form>
</div>


        


</div>
@endsection