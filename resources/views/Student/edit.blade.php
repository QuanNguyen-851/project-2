@extends('layouts.layout');
@section('main')

<form action="{{ route('students.update', $student->id) }}" method="POST" id="updatevalidateform">
    @csrf
    @method("PUT")
    <div class="col-md-6" >

        <div class="card">
            <div class="header">Thông tin sinh viên</div>
                <div class="content">
                    
                        {{-- id --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label"  >ID</label>
                            
                                <input class="form-control"
                                    type="text"
                                    readonly
                                    name="noid"   
                                    value="{{"BKC".$student->id}}"
                                />
                        
                        
                        </div>
                        {{-- lớp --}}
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Lớp</label>
                            <select name="class" class="selectpicker"  >
                                @foreach ($allclass as $item)
                                
                                <option value="{{$item->id}}"
                                 @php
                                    $in = ($item->id == $student->idclass) ? "selected":" " ;
                                @endphp
                                {{$in}}
                                >{{ $item->name}}</option>
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
                                    value="{{$student->name}}"
                                    
                                />
                            
                        
                        </div>
                        {{-- Giới tính --}}
                        <div class="form-check form-check-radio">
                            @php
                            $nam= ($student->gender==1) ? "checked":"" ;
                            @endphp
                            <label class="col-sm-2 control-label">Giới tính</label>
                            <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1"

                            {{$nam}}
                            >
                                <span class="form-check-sign"></span>
                                
                                    Nam
                            </label>
                            <label class="form-check-label">
                                @php
                            $nu= ($student->gender==0) ? "checked" : "" ;
                            @endphp
                                <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="0"
                                {{$nu}}>
                                <span class="form-check-sign"></span>
                                
                                    Nữ
                            </label>
                        </div>
                        
                    
                        {{-- Ngày sinh --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="form-group">
                            <input type="date" value="{{$student->dateBirth}}" name="DoB" class="form-control datepicker" placeholder="Date Picker Here"/>
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email</label>
                            
                                <input class="form-control"
                                    type="email"
                                    name="email"
                                    email="true"
                                    required="required"
                                    value="{{$student->email}}"
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
                                    number="true"
                                    required="required"
                                    value="{{$student->phone}}"
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
                                    value="{{$student->address}}"
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
                                @php
                                    $in = ($item->id==$student->idscholarship) ? "selected":"" ;
                                @endphp
                                <option value="{{$item->id}}" 
                                {{$in}}
                                >{{ $item->name." - ".$item->scholarship."vnd"}}</option>
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
                                value="{{$student->fee}}"
                        />
                    </div> --}}
                </div>
            </div>
            <div  style="text-align: center;">
                <button type="submit" name="btn" class="btn btn-fill btn-info">Update</button>

               
            </div>
        </div>
        
    </div>
</form>

@endsection