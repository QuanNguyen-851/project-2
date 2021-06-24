@extends('layouts.layout')
@section('main')
<div class="table-responsive">
    <h1>Danh sách các ngành đã ẩn</h1>
    <div class="toolbar">
        <button style="margin-right: 10px" onclick="location.href='{{route('major.index')}}'" class="btn btn-primary">Xem các ngành hiện có</button>
        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Tên</th>
                <th>Tên rút gọn</th>
                <th>Tổng học phí</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disabled as $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->shortName}}</td>
                <td>{{number_format($item->fee)}}VND</td>
                <td><a href="{{route('major.showmajor', $item->id) }}" onclick="return confirm('Bỏ Ẩn ?')" type="button" rel="tooltip" title="Hiện" class="btn btn-success btn-link btn-sm">
                    <i class="pe-7s-check"></i>
                </a></td>
            </tr>
           @endforeach
        </tbody>
    </table>
    </div>
    @endsection
