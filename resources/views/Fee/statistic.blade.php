@extends('layouts.layout')
@section('main')  
<style>
    #thongke>a{
        background: #d0e4ff4a;
    }
</style>
 @php
       date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('m', time());
    @endphp
<div class="card" style=" margin-bottom: 5px;">
    <h2 style="margin-bottom: -5px;float: left;margin-left: 20px;"> Doanh thu  <i class="pe-7s-graph3" ></i></h2>

    <div style="text-align: end;margin-right: 20px;">
    <p>Học phí: {{number_format($sumfee)." VNĐ"}}</p>
    <p>Phụ phí:{{number_format($sumsubfee)." VNĐ"}} </p>
    <p style="color:red;">Tổng: {{number_format($sumsubfee + $sumfee)." VNĐ"}} </p>   
    </div>
</div>
<div class="card">
    <div class="toolbar">
        <!--   Here you can write extra buttons/actions for the toolbar  -->
        <div class="dropdown">

            <button style="" class="btn btn-info  btn-fill" type="button" id="dropdownMenu1" data-toggle="dropdown">
                @if($month==1)
                    Tháng {{$date -1}}
                @elseif($month==3)
                    3 tháng gần nhất
                    @elseif($month=="all")
                     Tất cả 
                @else
                    Tháng này 
                
                @endif
              <span class="caret"></span>
            </button>
          
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('fee.statistic',['month'=>0])}}">Tháng này </a></li>
            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('fee.statistic',['month'=>1])}}">Tháng {{$date-1}}</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('fee.statistic',['month'=>3])}}">3 tháng gần đây</a></li>
              <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('fee.statistic',['month'=>"all"])}}">Tất cả</a></li>
              
              
            </ul>
             <a class="btn btn-warning  btn-fill" style="margin-right: 25px;margin-left: 5px;" href="{{ route('fee.exportstatistic', ['month'=>$month]) }}">Xuất file</a>
        </div>
   
       
    </div>
    <table id="bootstrap-table" class="table">
       
        <thead>
            <th  class="text-center">Mã đơn </th>
            <th data-field="id" class="text-center">ID </th>
            <th data-field="name" data-sortable="true">Họ và tên</th>
            
            
            <th  class="text-center">Người nộp</th>
                <th  data-sortable="true">Ghi chú</th>
                <th data-field="dateBirth"  data-sortable="true">Ngày nộp</th>
                <th data-field="number " data-sortable="true">Số tiền</th>
                <th  data-sortable="true">Đợt</th>
                <th >Hình thức đóng</th>
            <th data-field="actions" >Actions</th>
        </thead>
        
        <tbody>
            
            @foreach ($fee as $item)
                <tr>  
                <td>{{"HP".$item->idFee}}</td>          
                <td>{{"BKC".sprintf("%03d", $item->id)}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->payer}}</td>
                <td style="text-align: left;" ><textarea disabled style="width: 255px;height: 90px;border: none; max-width: 255px;min-height: 90px;">{{$item->note}}</textarea></td>
                <td style="text-align: left">
                {{date_format(date_create($item->date),"d/n/Y")}}
               </td>
                <td style="text-align: left" >
                {{number_format($item->payfee)."VNĐ"}}
                @if ($item->check != 1)
                        <a style="    color: #ffa50c;">(thiếu)</a>
                    @endif
                </td>
                <td style="text-align: left">
                    {{$item->countPay}}
                </td>
                <td style="text-align: left" >
                    {{$item->payment}}
                </td>
                <td class="td-actions">
                  

                    <a  href="{{ route('fee.detailStuddentFee', $item->idFee) }}"  title="Xem chi tiết" class="btn btn-primary">
                        Xem chi tiết
                    </a>
                    
                </td>
                </tr>
            @endforeach
            @foreach ($subfee as $item)
            <tr>
                <td>{{"PP".$item->idfee}}</td>
                <td>{{"BKC".sprintf("%03d", $item->id)}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->payer}}</td>

            <td style="text-align: left;" ><textarea disabled style="width: 255px;height: 90px;border: none; max-width: 255px;min-height: 90px;">{{$item->note}}</textarea></td>
            <td style="text-align: left">
            {{date_format(date_create($item->date),"d/n/Y")}}
            </td>
            <td style="text-align: left" >
                {{number_format($item->payfee)."VNĐ"}}
                @if ($item->check != 1)
                        <a style="    color: #ffa50c;">(thiếu)</a>
                    @endif
            </td>
            <td style="text-align: left" >
                {{$item->countPay}}
            </td>
            <td style="text-align: left" >
                {{$item->payment}}
            </td>
            <td class="td-actions">  
                
                <a href="{{ route('fee.detailStudentSubFee', $item->idFee) }}"  title="Xem chi tiết" class="btn btn-primary">
                    Xem chi tiết
                </a>               
            </td>
        </tr>
        @endforeach

        </tbody>
    </table>
  </div>
  
 

  


@endsection
