@extends('layouts.layout')
@section('main')
<div class="table-responsive">
    <h1>Các khóa đã tốt nghiệp</h1>
    <div class="card">
    
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Khóa</th>
                <th>Năm</th>
                <th>Tổng số đợt phải đóng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passed as $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->year}}</td>
                <td>{{$item->countMustPay}} Đợt</td>
            </tr>
           @endforeach
        </tbody>
    </table>
    </div>
</div>
    @endsection
