@extends('layouts.layout')
@section('main')
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Khóa</th>
                <th>Năm</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listallCourse as $item)
            <tr>
                <td class="text-center">{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->year}}</td>
                <td class="td-actions text-right">
                    <button type="button" rel="tooltip" title="Xem" class="btn btn-info btn-link btn-sm">
                        <i class="fa fa-user"></i>
                    </button>
                    <button type="button" rel="tooltip" title="Sửa khóa" class="btn btn-success btn-link btn-sm">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" rel="tooltip" title="Tốt Nghiệp" class="btn btn-danger btn-link btn-sm">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
    </div>
    @endsection
