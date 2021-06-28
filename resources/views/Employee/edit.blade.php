@extends('layouts.layout')
@section('main')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">Edit Profile</h4>
            </div>
            <div class="content">
                <form>
                    <div class="row">
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tên Đăng nhập</label>
                                <input type="text" class="form-control" placeholder="Username" value="michael23">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input type="text" class="form-control" placeholder="Company" value="Mike">
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Số Điện Thoại</label>
                                <input type="text" class="form-control" placeholder="City" value="Mike">
                            </div>
                        </div>
                        <div class="col-md-4">
                          
                            <div class="form-group">
                                  <label>Ngày sinh</label>
                                <input type="date" class="form-control datepicker" placeholder="Date Picker Here"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <select name="cities" class="selectpicker" data-title="Single Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                ...
                                </select>
                          </div>
                           
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <textarea rows="5" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
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
                  

                      <h4 class="title">Tên Đăng nhập<br />
                         <small>Họ và tên</small>
                      </h4>
                    </a>
               
                <p class="description "> Email.@gmail.com<br>
                                 
                </p>
            </div>
            
            
        </div>
    </div>

</div>
@endsection