@extends('layouts.layout')
@section('main')
<div class="col-md-6" style="width: 100%;">
            <h1 class="title">Học Bổng</h1>
    <div class="card" style="width: 100%;">
        <div class="header">
            <a href="{{ route('scholarship.create') }}" class="btn btn-primary btn-fill" style="float: right;">
                <i class="pe-7s-plus"></i>
                Thêm</a>
            
        </div>
        <div class="content table-responsive table-full-width">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Mức</th>
                        <th class="text-center">Số tiền</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($scholarship as $item)
                    <tr>
                        <td class="text-center">
                        {{$item->name}}
                      
                        </td>
                        <td class="text-center">
                        {{number_format($item->scholarship)."VND"}}
                        
                        </td >
                        <td class="td-actions text-center">
                            <a href="{{ route('scholarship.edit', $item->id) }}" rel="tooltip" title="Edit Profile" class="btn btn-success btn-simple btn-xs">
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