@extends('layouts.layout')
@section('main')
<form action="{{ route('students.store',) }}" method="POST" id="createvalidateform">
    @csrf
    
    <div class="col-md-6" >

        <div class="card">
            <div class="header">Thêm sinh viên</div>
                <div class="content">  

                        {{-- lớp --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lớp</label>
                            <select name="class" class="selectpicker"  >
                                @foreach ($class as $item)
                                
                                <option value="{{$item->id}}">{{ $item->name}}</option>
                                @endforeach
                                
                            </select>                
                        </div>
                        
                        
                        
                        {{-- Họ và Tên --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Họ Và Tên</label>
                        
                                <input class="form-control"
                                    type="text"
                                    name="name"
                                    required="required"
                                />
                            
                        
                        </div>
                        {{-- Giới tính --}}
                        <div class="form-check form-check-radio">
                           
                            <label class="col-sm-2 control-label">Giới tính</label>
                            <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1" checked>
                            
                                <span class="form-check-sign"></span>
                                    Nam
                            </label>
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="0"
                                >
                                <span class="form-check-sign"></span>
                                
                                    Nữ
                            </label>
                        </div>
                        
                    
                        {{-- Ngày sinh --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="form-group">
                            <input type="date" required="required"
                             name="DoB" class="form-control datepicker" placeholder="Date Picker Here"/>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                                <input class="form-control"
                                    type="text"
                                    name="email"
                                    email="true"
                                    required="required"
                                />
                                <span style=" color: red;font-size: 12px;margin-left: 44px;">
                              
                                    @if (Session::has('erre'))
                                    {{Session::get('erre')}}
                                        
                                    @endif

                                </span>
                        </div>
                        
                        {{-- Số Điện thoại --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Điện thoại</label>
                                <input class="form-control"
                                    type="text"
                                    name="phone"
                                    required="required"
                                    number="true"
                                    minLength="9"
                                    maxLength="10"
                                />
                                <span style=" color: red;font-size: 12px;margin-left: 44px;">
                                    @if (Session::has('errp'))
                                    {{Session::get('errp')}}
                                        
                                    @endif
                                    </span>
                        </div>
                        {{-- địa chỉ --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Địa chỉ</label>
                                <input class="form-control"
                                    type="text"
                                    name="address"
                                    required="required"
                                   
                                />
                            
                        
                        </div>
    
                    
                </div>
            
        </div> <!-- end card -->

    </div> <!--  end col-md-6  -->

    <div class="col-md-6" >

        <div class="card">
            
                <div class="content">
                    
                    {{-- mức học bổng --}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="width: 30%;">Học bổng</label>
                        <select name="scholarship" class="selectpicker"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            @foreach ($scholarship as $item)
                                <option value="{{$item->id}}">{{ $item->name." - ".number_format($item->scholarship)."vnd"}}</option>
                            @endforeach
                        </select>               
                    </div>
                
                    
                    {{-- Học phí mỗi đợt --}}
                    {{-- <div class="form-group" >
                        <label class="col-sm-2 control-label">Học phí Mỗi đợt</label>
                        
                        <input class="form-control"
                                type="text"
                                name="fee"
                                required="required"
                                number="true"
                                style="width: 70%;"   
                        />
                    </div> --}}
                </div>
            </div>
            <div  style="text-align: center;">
                
                <button type="submit" name="btn" class="btn btn-fill btn-info" style="margin: 20px;">Thêm</button>
    
</form>
                
                
            </div>
        </div>
        
    </div>

@endsection