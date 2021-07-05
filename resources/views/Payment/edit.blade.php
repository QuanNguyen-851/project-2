@extends('layouts.layout')
@section('main')
<div class="card">
    <form action="{{ route('payment.update', $payment->id) }}" method="post" id="updatevalidateform"> 
        @csrf
        @method("PUT")
    <div class="header text-center">Updated phương thức đóng</div>
    <div class="content">

        <div class="form-group">
            <label class="control-label">phương thức</label>
            <input class="form-control"
                   name="name"
                   type="text"
                   required="true"
        value="{{$payment->name}}"
            />
        </div>

        <div class="form-group">
            <label class="control-label">Giảm( %/đợt ) </label>
            <input class="form-control"
                   name="sale"
                   type="text"
                   required="true"
                   number="true"
                   value="{{$payment->sale}}"
            />
        </div>
        <div class="form-group">
            <label class="control-label">Số đợt/lần đóng</label>
            <input class="form-control"
                   name="countPer"
                   type="text"
                   required="true"
                   number="true"
                   value="{{$payment->countPer}}"
                   
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