@extends('layouts.layout')
@section('main')
    <form action="{{ route('course.update',$course->id) }}" method="POST" id="createvalidateform">
    @csrf
    @method("PUT")
    <div class="card">
        
            <div class="header text-center">Sửa Khóa</div>
            <div class="content">
    
                <div class="form-group">
                    <label class="control-label">Khóa <star>*</star></label>
                    <input class="form-control"
                           name="course"
                           type="text"
                           required="true"
                           value="{{$course->name}}"
                    />
                </div>
    
                <div class="form-group">
                    <label class="control-label">year <star>*</star></label>
                    <input class="form-control"
                           name="year"
                           id="registerPassword"
                           type="text"
                           required="true"
                           value="{{$course->year}}"
                    />
                </div>

    
                <div class="category"><star>*</star> Bắt buộc</div>
            </div>
    
            <div class="footer text-center">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Thêm</button>
            </div>
        
    </div>
    
</form>
                
                
            </div>
        </div>
        
    </div>
@endsection