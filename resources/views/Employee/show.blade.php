@extends('layouts.layout')
@section('main')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">Thông tin cá nhân</h4>
            </div>
            <div class="content">
                <form action="{{ route('employee.update', $employee->id) }}" method="post" id="updatevalidateform">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$employee->email}}"
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
                                <input type="text" name="name" class="form-control" value="{{$employee->name}}"
                                required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label>Vị trí</label>
                            <a style="color:red;font-size: small;">
                            <select name="permission" class="selectpicker"   data-style="btn-default btn-block" data-menu-style="dropdown-blue" required>
                                <option value="1" 
                                @if ($employee->permission==1)
                                    {{"selected"}}
                                @endif
                                 >Giáo vụ</option>
                                <option value="0"
                                @if ($employee->permission==0)
                                {{"selected"}}
                            @endif
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
                                <input type="text" name="phone" class="form-control"  value="{{$employee->phone}}"
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
                                    
                            <input type="date" name="DoB" class="form-control datepicker" placeholder="" value="{{$employee->dateBirth}}"
                            required
                            >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="gender" class="selectpicker"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="1" 
                                    @if ($employee->gender ==1)
                                     {{"selected"}}   
                                    @endif >Nam</option>
                                    <option value="0"
                                    @if ($employee->gender ==0)
                                     {{"selected"}}   
                                    @endif
                                    >Nữ</option>
                              
                                </select>
                          </div>
                           
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea name="address" rows="5" class="form-control" 
                                required>{{$employee->address}}</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">Cập nhật</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-user">
            <div class="image">
                <img src="../../assets/img/full-screen-image-3.jpg" alt="..."/>
            </div>
            <div class="content">                
                     <a href="#">
                     <h4 class="title">{{$employee->name}}<br />
                         
                      </h4>
                    </a>
               
                <p class="description "> Email: {{$employee->email}}<br>
                                 
                </p>
           
                
            </div>
            
            
        </div>
    </div>

</div>
@endsection