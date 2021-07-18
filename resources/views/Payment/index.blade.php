@extends('layouts.layout')
@section('main')

<style>

    #phuongthuc>a{
        background: #d0e4ff4a;
    }
</style>
<div class="col-md-6" style="width: 100%;">
    <h1 class="title">Phương thức đóng học</h1>
    <div class="card" style="width: 100%;">
        <div class="header">
            
            <a href="{{ route('payment.create') }}" class="btn btn-primary btn-fill" style="float: right;">
                <i class="pe-7s-plus"></i>
                Thêm</a>
            
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Phương thức</th>
                        <th class="text-center">Giảm</th>
                        <th class="text-center">Số đợt/lần đóng</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment as $item)
                    <tr>
                        <td class="text-center">
                        {{$item->name}}
                      
                        </td>
                        <td class="text-center">
                        {{$item->sale."%/đợt"}}
                        
                        </td >
                        <td class="text-center">
                            {{$item->countPer}}
                            
                            </td >
                        <td class="td-actions text-center">
                            <a href="{{ route('payment.edit', $item->id) }}" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
                                <i class="fa fa-edit"></i>
                            </a>
                            
                        </td>
                    </tr>
                    @endforeach
                    
                    
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection