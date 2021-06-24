@extends('layouts.layout')
@section('main')
<div class="card">
    <form action="{{ route('scholarship.update', $scholarship->id) }}" method="post" id="updatevalidateform"> 
        @csrf
        @method("PUT")
    <div class="header text-center">Updated học bổng</div>
    <div class="content">

        <div class="form-group">
            <label class="control-label">Tên</label>
            <input class="form-control"
                   name="name"
                   type="text"
                   required="true"
        value="{{$scholarship->name}}"
            />
        </div>

        <div class="form-group">
            <label class="control-label">Số tiền </label>
            <input class="form-control"
                   name="scholarship"
                   type="text"
                   required="true"
                   number="true"
                   value="{{$scholarship->scholarship}}"
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