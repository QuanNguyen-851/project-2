@extends('layouts.layout')
@section('main')

<style>

    #khoa>a{
        background: #d0e4ff4a;
    }
</style>
<div class="table-responsive">
    <h1>Các khóa đang theo học</h1>
    <div class="card">
        <a style="margin: 5px;" class="btn btn-primary" href="{{route('course.passed')}}">Khóa đã tốt nghiệp</a>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Khóa</th>
                <th>Năm</th>
                <th>Số đợt phải đóng</th>
                <th>Số đợt phải đóng phụ phí</th>
                <th class="text-center"><a href="{{route('course.create')}}" class="btn btn-primary">Thêm</a></th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($listallCourse as $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->year}}</td>
                <td>{{$item->countMustPay}} Đợt</td>
                <td>{{$item->countSubFeeMustPay}} Đợt</td>
                <td class="td-actions text-center">
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
</div>
    @endsection
