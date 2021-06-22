@extends('layouts.layout')
@section('main')
    <h1>danh sách sinh viên</h1>
 
    
    
        <div class="table-responsive">
            <div class="card">
                <div class="row">
                            <div class="content">
                                   
                                <ul role="tablist" class="nav nav-tabs">
                                      <form class="navbar-form navbar-left navbar-search-form" role="search">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                             <input type="text" value="{{ $search}}" name ="search" class="form-control" placeholder="Search...">
                                        </div>
                                    </form>
                                    <button class="btn btn-primary btn-fill" style="float: right;margin-right: 15px;">
                                        <i class="pe-7s-plus" > Thêm</i>
                                    </button>
                                    <li class=" active">
                                        <a href="#settings" class=" active" data-toggle="tab">Tất cả </a>
                                    </li>
                                    <li role="presentation" >
                                        <a href="#agency" data-toggle="tab">{{ $course[2]->name }}</a>
                                    </li>
                                    <li>
                                        <a href="#company" data-toggle="tab">{{ $course[1]->name }}</a>
                                    </li>
                                    <li>
                                        <a href="#style" data-toggle="tab">{{ $course[0]->name }}</a>
                                    </li>
                                    
                                    
                                </ul>

                                <div class="tab-content">
                                    {{-- tất cả --}}
                                    <div id="settings" class="tab-pane active">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">lớp</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">mức học bổng</th>
                                                    <th class="text-center" >Học phí</th>
                                                    <th class="text-center" ></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listall as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->id}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-link btn-sm">
                                                            <i class="fa fa-user"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                
    
                                            </tbody>
                                        </table> 
                                        <div style="text-align: center;">
                                        {{ $listall->appends(['search'=>$search])->links('pagination::bootstrap-4') }}
                                        </div>

                                    </div>
                                    {{-- năm 3 --}}
                                    <div id="agency" class="tab-pane ">
                                         <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">lớp</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">mức học bổng</th>
                                                    <th class="text-center" >Học phí</th>
                                                    <th class="text-center" ></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list[2] as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->id}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-link btn-sm">
                                                            <i class="fa fa-user"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                

                                            </tbody>
                                        </table> 
                                    </div>
                                    {{-- năm 2 --}}
                                    <div id="company" class="tab-pane">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">lớp</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">mức học bổng</th>
                                                    <th class="text-center" >Học phí</th>
                                                    <th class="text-center" ></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list[1] as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->id}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-link btn-sm">
                                                            <i class="fa fa-user"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                

                                            </tbody>
                                        </table> 
                                    </div>
                                    {{-- năm 1 --}}
                                    <div id="style" class="tab-pane">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">lớp</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">mức học bổng</th>
                                                    <th class="text-center" >Học phí</th>
                                                    <th class="text-center" ></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list[0] as $item)
                                                <tr>
                                                    <th class="text-center">{{$item->id}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">
                                                    @php
                                                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                                                    @endphp
                                                    {{$gt}}
                                                    </th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="View Profile" class="btn btn-info btn-link btn-sm">
                                                            <i class="fa fa-user"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                

                                            </tbody>
                                        </table> 
                                    </div>
                                 </div>

                            </div>
                        
                    
                    
                </div>
            </div>
        </div>
@endsection