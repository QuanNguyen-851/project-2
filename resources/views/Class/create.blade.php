@extends('layouts.layout')
@section('main')
<form action="{{ route('class.store') }}" method="post"> 
    @csrf
    <div class="card">
    <div class="header">Thêm lớp</div>
        <div class="content">
             
                {{-- lớp --}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">lớp</label>
                
                        <input class="form-control"
                            type="text"
                            name="name"
                            required="required"
                        />
                    
                
                </div>
                {{-- ngành --}}
                <div class="form-group">
                    <label class="col-sm-2 control-label">ngành</label>
                    <select name="class" class="selectpicker"  >
                        
                        
                        <option value=""></option>
                        
                        
                    </select>                
                </div>
                {{-- khóa --}}
                <div class="form-group">
                        <label class="col-sm-2 control-label">khóa</label>
                        <select name="class" class="selectpicker"  >
                            
                            
                            <option value=""></option>
                            
                            
                        </select>    
                </div>
            
                     <div style="text-align: center;" >
                        <button type="submit" class="btn btn-primary btn-fill">Thêm </button> 
                    </div>
        </div>
    </div>
    
</div> <!-- end card -->

 </form> 


    
@endsection