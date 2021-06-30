@extends('layouts.layout')
@section('main')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="card">
            <div class="header">
                <h4 class="title">Thêm nhân viên</h4>
            </div>
            <div class="content">
                <form action="{{ route('employee.store') }}" method="post" id="updatevalidateform">
                    @csrf
                   
                    <div class="row">
                        
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control"
                                required
                                email="true"    
                                >
                                <span style="color:red">
                                    @if (Session::has('erremail'))
                                    {{Session::get('erremail')}}
                                        
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input type="text" name="name" class="form-control" 
                                required>
                            </div>
                        </div>
                         <div class="col-md-4">
                        <div class="form-group">
                            <label>Vị trí</label>
                            <a style="color:red;font-size: small;">
                            <select name="permission" class="selectpicker" title="Chọn vị trí--"  data-style="btn-default btn-block" data-menu-style="dropdown-blue" required>
                                <option value="1" 
                                 >Giáo vụ</option>
                                <option value="0"
                               
                                >Kế toán</option>
                          
                            </select>
                            </a>
                      </div>
                       
                        
                    </div>
                    </div>
                   


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input type="text" name="phone" class="form-control"  value=""
                                required
                                minLength="9"
                                maxLength="10"
                                >
                                <span style="color:red">
                                    @if (Session::has('errphone'))
                                    {{Session::get('errphone')}}
                                        
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                            <div class="form-group">
                                  <label>Ngày sinh</label>
                                    
                            <input type="date" name="DoB" class="form-control datepicker" placeholder="" value=""
                            required
                            >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <a style="color:red;font-size: small;">
                                <select name="gender" class="selectpicker" title="chọn giới tính--"  data-style="btn-default btn-block" data-menu-style="dropdown-blue" required>
                                    <option value="1" 
                                     >Nam</option>
                                    <option value="0"
                                   
                                    >Nữ</option>
                              
                                </select>
                                </a>
                          </div>
                           
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea name="address" rows="5" class="form-control" 
                                required></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                    <div class="clearfix" style="color:red;">Nhân viên đăng nhập bằng email và mật khẩu mặc định ban đầu là 123456</div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection