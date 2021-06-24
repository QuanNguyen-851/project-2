@extends('layouts.layout')
@section('main')
    <form action="{{ route('major.store') }}" method="POST" id="createvalidateform">
    @csrf
    <div class="card">
        
            <div class="header text-center">Thêm ngành</div>
            <div class="content">
    
                <div class="form-group">
                    <label class="control-label">Tên ngành <star>*</star></label>
                    <input class="form-control"
                           name="name"
                           type="text"
                           required="true"
                           
                    />
                </div>
    
                <div class="form-group">
                    <label class="control-label">Tên rút gọn <star>*</star></label>
                    <input class="form-control"
                           name="short"
                           id="registerPassword"
                           type="text"
                           required="true"
                           
                    />
                </div>

                <div class="form-group">
                    <label class="control-label">Tổng học phí <star>*</star></label>
                    <input class="form-control"
                           name="fee"
                           id="registerPassword"
                           type="text"
                           required="true"
                           
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