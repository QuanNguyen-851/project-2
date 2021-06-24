@extends('layouts.layout')
@section('main')

<div class="row">
    <div class="col-md-12">
        <h1>Danh sách lớp</h1>
        <div class="card">

            <div class="toolbar">
               
                <form action="">
                    <input type="file" name="file" class="form-control" style="float: left;width: 75%;" >
                    <button type="submit" name="btn"class="btn btn-primary btn-fill" style="float: left;margin-right: 15px;" >Đồng ý</button>
                    
                </form> 
               
                
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
                            <a rel="tooltip" title="Hide" class="btn btn-danger  btn-sm" href="{{ route('class.hide', $item->id)}}" onclick="return confirm('bạn chắc chứ ?')" style="float: right; margin:10px">
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