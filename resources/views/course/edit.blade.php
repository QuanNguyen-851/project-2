@extends('layouts.layout')
@section('main')
    <form action="{{ route('course.update',$course->id) }}" method="POST" id="createvalidateform">
    @csrf
    @method("PUT")
    <div class="card">
        
            <div class="header text-center">Sửa Khóa</div>
            <div class="content">
    
                <div class="form-group">
                    <label class="control-label">Khóa </label>
                    <input class="form-control"
                           name="course"
                           type="text"
                           required="true"
                           value="{{$course->name}}"
                    />
                </div>
    
                <div class="form-group">
                    <label class="control-label">year </label>
                    <input class="form-control"
                           name="year"
                           id="registerPassword"
                           type="text"
                           required="true"
                           value="{{$course->year}}"
                    />
                </div>

    
                
            </div>
    
            <div class="footer text-center">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Cập Nhật</button>
            </div>
        
    </div>
    
</form>
                
                
            </div>
        </div>
        
    </div>
@endsection