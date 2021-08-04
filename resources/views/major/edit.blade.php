@extends('layouts.layout')
@section('main')
    <form action="{{ route('major.update',$major->id) }}" method="POST" id="createvalidateform">
    @csrf
    @method("PUT")
    <div class="card">
        
            <div class="header text-center">Sửa ngành</div>
            <div class="content">
    
                <div class="form-group">
                    <label class="control-label">Tên ngành</label>
                    <input class="form-control"
                           name="name"
                           type="text"
                           required="true"
                           value="{{$major->name}}"
                    />
                </div>
    
                <div class="form-group">
                    <label class="control-label">Tên rút gọn </label>
                    <input class="form-control"
                           name="short"
                           id="registerPassword"
                           type="text"
                           required="true"
                           value="{{$major->shortName}}"
                    />
                </div>

                <div class="form-group">
                    <label class="control-label">Học phí</label>
                    <input class="form-control"
                           name="fee"
                           id="registerPassword"
                           type="text"
                           required="true"
                           value="{{$major->fee}}"
                    />
                </div>

            </div>
    
            <div class="footer text-center">
                <button type="submit" class="btn btn-info btn-fill btn-wd">Cập nhật</button>
            </div>
        
    </div>
    
</form>
                
                
            </div>
        </div>
        
    </div>
@endsection