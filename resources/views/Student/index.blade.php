@extends('layouts.layout')
@section('main')
    <h1>danh sách sinh viên</h1>
    <form class="navbar-form navbar-left navbar-search-form" role="search">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
        <input type="text" value="{{ $search}}" name ="search" class="form-control" placeholder="Search...">
        </div>
    </form>
    
    <button class="btn btn-primary btn-fill" style="float: right;margin: 5px;">
        <i class="pe-7s-plus" > Thêm</i>
        
    </button>
        <div class="table-responsive">
            <div class="card">
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
                @foreach ($list as $item)
                <tr>
                    <th class="text-center">{{$item->id}}</th>
                    <th class="text-center">{{$item->class}}</th>
                    <th class="text-center">{{$item->name}}</th>
                    <th class="text-center">
                    @php
                        $gt = ($item->gender == 1) ? "Nam" : "Nữ";
                    @endphp
                    {{$gt}}
                    </th>
                    <th class="text-center">{{$item->dateBirth}}</th>
                    <th class="text-center"> {{$item->scholarship}}</th>
                    <th class="text-center" >{{ $item->fee}}VND</th>
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
@endsection