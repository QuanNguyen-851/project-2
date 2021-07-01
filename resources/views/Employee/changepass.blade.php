@extends('layouts.layout')
@section('main')
<div class="col-md-6 col-md-offset-3">
    <div class="card">
        <form id="updatevalidateform" action="{{ route('employee.changepassProcess', $id) }}" method="post" >
            @csrf
            
        <div class="header">Đổi mật khẩu</div>
            <div class="content">
                <div class="form-group">
                    <label class="control-label">Mật khẩu cũ</label>
                    <input class="form-control"
                           name="pass"
                           type="password"
                           required="true"
                           minLength="5"
                                
                    />
                    <span style="color:red">
                        @if (Session::has('error'))
                        {{Session::get('error')}}
                            
                        @endif
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label">Mật khẩu mới</label>
                    <input class="form-control"
                           name="newpass"
                           id="registerPassword"
                           type="password"
                           required="true"
                           minLength="5"
                    />
                </div>

                <div class="form-group">
                    <label class="control-label">Nhập lại mật khẩu mới </label>
                    <input class="form-control"
                           name="password_confirmation"
                           id="registerPasswordConfirmation"
                           type="password"
                           required="true"
                           equalTo="#registerPassword"
                           minLength="5"
                    />
                </div>

               
            </div>

            <div class="footer" style="text-align: center;">
                <button type="submit" class="btn btn-info btn-fill  " onclick="return confirm('bạn chắc chứ ?')">Đồng ý</button>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>
@endsection