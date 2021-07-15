@extends('layouts.layout')
@section('main')
<div class="card">
    <table border="0" class="table">
        <tr>
            <td rowspan="2">
                <h3>Lịch sử đóng học</h3>
                <label>Sinh viên: {{$student->name}}</label>
                <p>Ngày sinh: {{date_format(date_create($student->dateBirth),"d/n/Y")}}</p>
                <p>Địa chỉ: {{$student->address}}</p>
                <p>Học phí mỗi đợt: {{number_format($student->fee)."VNĐ"}}</p>
                <p>Mức học bổng: {{$student->scholarship}}</p>
            </td>
            <td>Học phí</td>
        <td>Số đợt phải đóng: {{$student->countMustPay}}</td>
        <td>Số đợt đã đóng: {{$payed}}</td>
        <td>Nợ học phí:{{number_format($owe)."VNĐ"}}</td>
        
        </tr>
        <tr>
            <td>phụ phí</td>
        <td>Số đợt phải đóng: {{$student->countSubFeeMustPay}}</td>
        <td>Số đợt đã đóng: {{$subfeepayed}} </td>
        <td>Nợ:{{number_format($owesub)."VNĐ"}}</td>
        
        </tr>
        <tr>
            <td colspan="4"></td>
        <td style="color:red">tổng: {{ number_format($owe + $owesub)."VNĐ" }}</td>
        </tr>

    </table>


</div>
<div class="row">
    <div class="col-md-12">
    <div class="card">

        <table id="bootstrap-table" class="table">
            <thead>
               
                <th  class="text-center">Người nộp</th>
                <th  data-sortable="true">Ghi chú</th>
                <th  data-sortable="true">Ngày nộp</th>
                <th  data-sortable="true">Số tiền</th>
                <th  data-sortable="true">Đợt</th>
                <th >Hình thức đóng</th>
                <th >Actions</th>
            </thead>
            <tbody>
                @foreach ($studentfee as $item)
                <tr>
                <td> {{$item->payer}} </td>

                <td style="text-align: left;" ><textarea disabled style="width: 390px;height: 90px;border: none; max-width: 390px;min-height: 90px;">{{$item->note}}</textarea></td>
                <td style="text-align: left">
                {{date_format(date_create($item->date),"d/n/Y")}}
                </td>
                <td style="text-align: left" >
                    {{number_format($item->payfee)."VNĐ"}}
                </td>
                <td style="text-align: left">
                    {{$item->countPay}}
                </td>
                <td style="text-align: left" >
                    {{$item->payment}}
                </td>
                <td class="td-actions">
                    @if ($item->check != 1)
                        thiếu
                    @endif

                    <a  href="{{ route('fee.detailStuddentFee', $item->idFee) }}"  title="Xem chi tiết" class="btn btn-primary">
                        Xem chi tiết
                    </a>
                    
                </td>
            </tr>
            @endforeach
            @foreach ($studentsubfee as $item)
            <tr>
            <td>
                <div>
                    {{$item->payer}}
                </div>
            </td>

            <td style="text-align: left;" ><textarea disabled style="width: 390px;height: 90px;border: none; max-width: 390px;min-height: 90px;">{{$item->note}}</textarea></td>
            <td style="text-align: left">
            {{date_format(date_create($item->date),"d/n/Y")}}
            </td>
            <td style="text-align: left" >
                {{number_format($item->payfee)."VNĐ"}}
            </td>
            <td style="text-align: left" >
                {{$item->countPay}}
            </td>
            <td style="text-align: left" >
                {{$item->payment}}
            </td>
            <td class="td-actions">  
                @if ($item->check != 1)
                thiếu
            @endif
                <a href="{{ route('fee.detailStudentSubFee', $item->idFee) }}"  title="Xem chi tiết" class="btn btn-primary">
                    Xem chi tiết
                </a>               
            </td>
        </tr>
        @endforeach
            </tbody>
        </table>



        {{-- <table class="table table-bigboy" >
            <thead>
                <tr>
                    <th class="text-left">Người nộp</th>
                    <th class="th-description" >Ghi chú</th>
                    <th class="text-left" >Ngày nộp</th>
                    <th class="text-left" >Số tiền</th>
                    <th class="text-left" >Đợt</th>
                    <th class="text-left" >Hình thức đóng</th>
                    <th class="text-left" >Actions</th>
                </tr>
            </thead>
            <tbody>
            
                @foreach ($studentfee as $item)
                    <tr>
                    <td>
                        <div class="td-name">
                            {{$item->payer}}
                        </div>
                    </td>

                    <td style="text-align: left;" ><textarea disabled style="width: 390px;height: 90px;border: none; max-width: 390px;min-height: 90px;">{{$item->note}}</textarea></td>
                    <td style="text-align: left" class="td-number">
                    {{date_format(date_create($item->date),"d/n/Y")}}
                    </td>
                    <td style="text-align: left" class="td-number">
                        {{number_format($item->payfee)."VNĐ"}}
                    </td>
                    <td style="text-align: left" class="td-number">
                        {{$item->countPay}}
                    </td>
                    <td style="text-align: left" >
                        {{$item->payment}}
                    </td>
                    <td class="td-actions">
                        
                        <a rel="tooltip" href="{{ route('fee.detailStuddentFee', $item->idFee) }}" data-placement="left" title="Xem chi tiết" class="btn btn-info btn-link btn-icon">
                            <i class="fa fa-image"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach

                @foreach ($studentsubfee as $item)
                    <tr>
                    <td>
                        <div class="td-name">
                            {{$item->payer}}
                        </div>
                    </td>

                    <td style="text-align: left;" ><textarea disabled style="width: 390px;height: 90px;border: none; max-width: 390px;min-height: 90px;">{{$item->note}}</textarea></td>
                    <td style="text-align: left" class="td-number">
                    {{date_format(date_create($item->date),"d/n/Y")}}
                    </td>
                    <td style="text-align: left" class="td-number">
                        {{number_format($item->payfee)."VNĐ"}}
                    </td>
                    <td style="text-align: left" class="td-number">
                        {{$item->countPay}}
                    </td>
                    <td style="text-align: left" >
                        {{$item->payment}}
                    </td>
                    <td class="td-actions">
                        
                        <a rel="tooltip" href="{{ route('fee.detailStudentSubFee', $item->idFee) }}" data-placement="left" title="Xem chi tiết" class="btn btn-info btn-link btn-icon">
                            <i class="fa fa-image"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
                        
            
            </tbody>
        </table> --}}
    </div>
    </div>
</div>
@endsection