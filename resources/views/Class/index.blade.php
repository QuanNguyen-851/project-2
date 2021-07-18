@extends('layouts.layout')
@section('main')

<style>

    #lop>a{
        background: #d0e4ff4a;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <h1>Danh sách lớp</h1>
        <div class="card">

            <div class="toolbar">
                    <a href="{{ route('class.insertClass') }}" class="btn btn-primary btn-fill" style="float: left;margin-right: 15px;" >Thêm danh sách lớp</a>

            </div> 
            
            <a href="{{ route('class.create') }}" class="btn btn-primary btn-fill btn-sm " style="float: right;margin-right: 5px;    margin-top: 19px;">
                        <i class="pe-7s-plus" > Thêm lớp</i>
                    </a>

            <table id="bootstrap-table" class="table">
                <thead >
                    <th data-field="id" data-sortable="true" class="text-center" >ID</th>
                    <th data-field="class" data-sortable="true"class="text-center">Lớp</th>
                    <th data-field="major" data-sortable="true"class="text-center">Ngành</th>
                    <th data-field="cource" data-sortable="true"class="text-center">Khóa</th>
                   
                    <th></th>
                </thead>
                <tbody>
                    
                  @foreach ($class as $item)
                    <tr>
                    <td class="text-center">{{$item->shortName.$item->id}}</td>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">{{$item->major}}</td>
                    <td class="text-center">{{$item->course}}</td>
                    
                        <td >
                            <a rel="tooltip" title="Hide" class="btn btn-danger  btn-sm" href="{{ route('class.hide', $item->id)}}" onclick="return confirm('CẢNH BÁO! HÀNH ĐỘNG NÀY SẼ KHÔNG THỂ THAY ĐỔI BẠN CHẮC CHỨ ?')" style="float: right; margin:10px">
                                ẩn
                            </a>
                            <a rel="tooltip" title="Edit Profile" class="btn btn-success  btn-sm" href="{{ route('class.edit', $item->id) }}" style="float: right; margin: 10px;">
                                sửa
                            </a>
                            
                        </td>
                    </tr>
                  @endforeach
                  
                        
                  
                    
                    
                </tbody>
            </table>
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->
@endsection