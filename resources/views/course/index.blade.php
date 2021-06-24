@extends('layouts.layout')
@section('main')
<div class="table-responsive">
    <h1>Các khóa đang theo học</h1>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Khóa</th>
                <th>Năm</th>
                <th>Tổng số đợt phải đóng</th>
                <th><a href="{{route('course.create')}}">Thêm</a></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listallCourse as $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->year}}</td>
                <td>{{$item->countMustPay}} Đợt</td>
                <td class="td-actions text-right">
                    <a href="{{ route('course.edit',$item->id) }}" type="button" rel="tooltip" title="Sửa khóa" class="btn btn-success btn-link btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('course.hide', $item->id) }}" onclick="return confirm('không thể thay đổi một khi chấp nhận')" type="button" rel="tooltip" title="Tốt Nghiệp" class="btn btn-success btn-link btn-sm">
                        <i class="pe-7s-check"></i>
                    </a>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
    </div>
    @endsection
