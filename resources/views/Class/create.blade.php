@extends('layouts.layout')
@section('main')

<form action="{{ route('class.store') }}" method="post" id='createvalidateform'> 
    @csrf
    
    <div class="card">
    <div class="header">Thêm lớp</div>
        <div class="content">
                {{-- lớp --}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">lớp</label>
                        
                        <input class="form-control"
                            type="text"
                            name="class"
                            required="required"
                        />
                        <span style=" color: red;font-size: 12px;margin-left: 44px;">
                           @if (Session::has('err'))
                               {{Session::get('err')}}
                            @else
                            để thêm lớp tạm thời yêu cầu: tên lớp + "tạm thời"
                           @endif
                        </span>
                </div>
                {{-- ngành --}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">ngành</label>
                    <select name="major" class="selectpicker"  >
                        @foreach ($major as $item)
                    <option value="{{$item->id}}">{{$item->name." - ".$item->shortName}}</option>
                        @endforeach
                    </select>                
                </div>
                {{-- khóa --}}
                <div class="form-group">
                        <label class="col-sm-2 control-label">khóa</label>
                        <select name="course" class="selectpicker"  >
                            @foreach ($course as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach

                        </select>    
                </div>
            
                     <div style="text-align: center;" >
                        <button type="submit" class="btn btn-primary btn-fill">Thêm </button> 
                    </div>
        </div>
    </div>
    
</div> <!-- end card -->

 </form> 


    
@endsection