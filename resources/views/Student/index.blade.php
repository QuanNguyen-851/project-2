@extends('layouts.layout')
@section('main')

<style>

    #sinhvien>a{
        background: #d0e4ff4a;
    }
</style>
    <h1>Danh sách sinh viên
        <i class="pe-7s-study" ></i>
    </h1>
  <div class="card">
        <div class="table-responsive">
            
                <div class="row">
                            <div class="content">
                                <ul role="tablist" class="nav nav-tabs">
                                      <form class="navbar-form navbar-left navbar-search-form" role="search" style="    margin: 0;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                             <input type="text" value="{{ $search}}" name ="search" class="form-control" placeholder="Search...">
                                        </div>
                                    </form>
                                    
                                    <a href="{{ route('students.importStudents') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                        <i class="
                                        pe-7s-add-user
                                        " > Thêm danh sách sinh viên </i>
                                    </a>
                                    <a href="{{ route('students.exportStudentsform') }}" class="btn btn-warning btn-fill" style="float: right;margin-right: 5px;">
                                        <i class="
                                        pe-7s-next-2
                                        " > xuất danh sách sinh viên </i>
                                    </a>



                                    <li class=" active">
                                        <a href="#settings" class=" active" data-toggle="tab">Tất cả </a>
                                    </li>
                                  
                                        @if (isset($course[2]))
                                         <li role="presentation" >
                                        <a href="#agency" data-toggle="tab">{{ $course[2]->name }}</a>
                                        </li>
                                        @endif
                                        @if (isset($course[1]))
                                    <li>
                                        <a href="#company" data-toggle="tab">{{ $course[1]->name }}</a>
                                    </li>
                                    @endif
                                    @if (isset($course[0]))
                                    <li>
                                        <a href="#style" data-toggle="tab">{{ $course[0]->name }}</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="#icon-info" data-toggle="tab">Bị ẩn</a>
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
                                                    <th class="text-center" >Học phí 1 đợt</th>
                                                    <th  >
                                                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                        <i class="
                                                        pe-7s-add-user
                                                        " > </i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listall as $item)
                                                <tr>
                                                    <th class="text-center">{{"BKC".sprintf("%03d", $item->id)}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">{{$item->GenderName}}</th>
                                                   
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử</a>
                                                        <a rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm" href="{{ route('students.edit', $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                            {{-- <a rel="tooltip" title="Hide" class="btn btn-danger btn-link btn-sm" href="{{ route('students.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                                <i class="fa fa-times"></i>
                                                            </a> --}}

                                                    </td>
                                                </tr>    
                                                @endforeach
                                                
    
                                            </tbody>
                                        </table> 
                                        <div style="text-align: center;">
                                        {{ $listall->appends(['search'=>$search])->links('pagination::bootstrap-4') }}
                                        </div>

                                    </div>
                                   
                                     {{-- năm 3  --}}
                                     @if (isset($list[2]))
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
                                                        <th class="text-center" >Học phí 1 đợt</th>
                                                        <th  >
                                                            <a href="{{ route('students.create') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                                <i class="
                                                                pe-7s-add-user
                                                                " > </i>
                                                        </a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($list[2] as $item)
                                                    <tr>
                                                        <th class="text-center">{{"BKC".sprintf("%03d", $item->id)}}</th>
                                                        <th class="text-center">{{$item->classname}}</th>
                                                        <th class="text-center">{{$item->name}}</th>
                                                        <th class="text-center">
                                                            {{$item->GenderName}}</th>
                                                        @php
                                                            $date=date_create($item->dateBirth);
                                                        @endphp
                                                        <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                        <th class="text-center"> {{$item->scholarship}}</th>
                                                        <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                        <td class="td-actions text-right">
                                                            <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử đóng học</a>
                                                            <a rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm" href="{{ route('students.edit', $item->id) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            {{-- <a rel="tooltip" title="Hide" class="btn btn-danger btn-link btn-sm" href="{{ route('students.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                                <i class="fa fa-times"></i>
                                                            </a> --}}
                                                        </td>
                                                    </tr>    
                                                    @endforeach
                                                    

                                                </tbody>
                                            </table> 
                                         </div>  
                                     @endif
                                  
                                   {{--  năm 2  --}}
                                   @if (isset($list[1]))
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
                                                    <th class="text-center" >Học phí 1 đợt</th>
                                                    <th  >
                                                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                            <i class="
                                                            pe-7s-add-user
                                                            " > </i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list[1] as $item)
                                                <tr>
                                                    <th class="text-center">{{"BKC".sprintf("%03d", $item->id)}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">
                                                        {{$item->GenderName}}</th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử đóng học</a>
                                                        <a rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm" href="{{ route('students.edit', $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        {{-- <a rel="tooltip" title="Hide" class="btn btn-danger btn-link btn-sm" href="{{ route('students.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                            <i class="fa fa-times"></i>
                                                        </a> --}}
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                

                                            </tbody>
                                        </table> 
                                    </div>
                                    @endif
                                  {{--  năm 1  --}}
                                  @if (isset($list[0]))
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
                                                    <th class="text-center" >Học phí 1 đợt</th>
                                                    <th  >
                                                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                            <i class="
                                                            pe-7s-add-user
                                                            " > </i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list[0] as $item)
                                                <tr>
                                                    <th class="text-center">{{"BKC".sprintf("%03d", $item->id)}}</th>
                                                    <th class="text-center">{{$item->classname}}</th>
                                                    <th class="text-center">{{$item->name}}</th>
                                                    <th class="text-center">
                                                        {{$item->GenderName}}</th>
                                                    @php
                                                        $date=date_create($item->dateBirth);
                                                    @endphp
                                                    <th class="text-center">{{date_format($date,"d/m/Y")}}</th>
                                                    <th class="text-center"> {{$item->scholarship}}</th>
                                                    <th class="text-center" >{{ number_format($item->fee)}}VND</th>
                                                    <td class="td-actions text-right">
                                                        <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử đóng học</a>
                                                        <a rel="tooltip" title="Edit Profile" class="btn btn-success btn-link btn-sm" href="{{ route('students.edit', $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        {{-- <a rel="tooltip" title="Hide" class="btn btn-danger btn-link btn-sm" href="{{ route('students.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                            <i class="fa fa-times"></i>
                                                        </a> --}}
                                                    </td>
                                                </tr>    
                                                @endforeach
                                                

                                            </tbody>
                                        </table> 
                                    </div>
                                @endif
                                 {{--  bị ẩn  --}}
                                    <div id="icon-info" class="tab-pane">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">lớp</th>
                                                    <th class="text-center">Họ Và tên</th>
                                                    <th class="text-center">giới tính</th>
                                                    <th class="text-center">ngày sinh</th>
                                                    <th  class="text-center">mức học bổng</th>
                                                    <th class="text-center" >Học phí 1 đợt</th>
                                                    <th  >
                                                        <a href="{{ route('students.create') }}" class="btn btn-primary btn-fill" style="float: right;margin-right: 5px;">
                                                            <i class="
                                                            pe-7s-add-user
                                                            " > </i>
                                                    </a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($listhide as $item)
                                                <tr>
                                                    <th class="text-center">{{"BKC".sprintf("%03d", $item->id)}}</th>
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
                                                        <a href="{{ route('fee.studentfee', $item->id) }}" class="btn btn-primary ">Lịch sử đóng học</a>
                                                         
                                                        {{-- <a rel="tooltip" title="Unhide" class="btn btn-warning btn-link btn-sm" href="{{ route('students.unhide', $item->id)}}" onclick="return confirm('bạn chắc chứ ! ')">
                                                            <i class="fa fa-edit"></i>
                                                        </a> --}}

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