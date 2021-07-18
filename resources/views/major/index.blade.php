@extends('layouts.layout')
@section('main')

<style>

    #nganh>a{
        background: #d0e4ff4a;
    }
</style>
<h1>Danh sách các ngành</h1>
<div class="card">
<div class="toolbar">
    <button style="margin-right: 10px" onclick="location.href='{{route('major.disabled')}}'" class="btn btn-primary">Xem các ngành đã ẩn</button>
    <button style="margin-right: 10px" onclick="location.href='{{route('major.create')}}'" class="btn btn-primary">Thêm ngành</button>
</div>

<table id="bootstrap-table" class="table">
    <thead>
        
        <th data-field="id" class="text-center">#</th>
    	<th data-field="name" data-sortable="true">Tên Ngành</th>
    	<th data-field="salary" data-sortable="true">Tên rút gọn</th>
    	<th data-field="country" data-sortable="true">Tổng học phí phải đóng</th>
    	<th>Action</th>
    </thead>
    <tbody>
        @foreach ($listAll as $item)
        <tr>
            
        	<td>{{$item->id}}</td>
        	<td>{{$item->name}}</td>
        	<td>{{$item->shortName}}</td>
        	<td>{{number_format($item->fee)}}VND</td>
        	
        	<td> <a href="{{ route('major.edit',$item->id) }}" type="button" rel="tooltip" title="Sửa khóa" class="btn btn-success btn-link btn-sm">
                <i class="fa fa-edit"></i>
            </a>
            <a href="{{route('major.hide', $item->id) }}" onclick="return confirm('Ẩn ngành này ?')" type="button" rel="tooltip" title="Ẩn" class="btn btn-danger btn-link btn-sm">
                <i class="pe-7s-close-circle"></i>
            </a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
<script type="text/javascript">
    var $table = $('#bootstrap-table');

    $().ready(function(){
        $table.bootstrapTable({
            toolbar: ".toolbar",
            clickToSelect: true,
            showRefresh: true,
            search: true,
            showToggle: true,
            showColumns: true,
            pagination: true,
            searchAlign: 'left',
            pageSize: 8,
            clickToSelect: false,
            pageList: [8,10,25,50,100],

            formatShowingRows: function(pageFrom, pageTo, totalRows){
                //do nothing here, we don't want to show the text "showing x of y from..."
            },
            formatRecordsPerPage: function(pageNumber){
                return pageNumber + " rows visible";
            },
            icons: {
                refresh: 'fa fa-refresh',
                toggle: 'fa fa-th-list',
                columns: 'fa fa-columns',
                detailOpen: 'fa fa-plus-circle',
                detailClose: 'fa fa-minus-circle'
            }
        });

        //activate the tooltips after the data table is initialized
        $('[rel="tooltip"]').tooltip();

        $(window).resize(function () {
            $table.bootstrapTable('resetView');
        });

        window.operateEvents = {
            'click .view': function (e, value, row, index) {
                info = JSON.stringify(row);

                swal('You click view icon, row: ', info);
                console.log(info);
            },
            'click .edit': function (e, value, row, index) {
                info = JSON.stringify(row);

                swal('You click edit icon, row: ', info);
                console.log(info);
            },
            'click .remove': function (e, value, row, index) {
                console.log(row);
                $table.bootstrapTable('remove', {
                    field: 'id',
                    values: [row.id]
                });
            }
        };
    });

    function operateFormatter(value, row, index) {
        return [
            '<a rel="tooltip" title="View" class="btn btn-link btn-info btn-icon table-action view" href="javascript:void(0)">',
                '<i class="fa fa-image"></i>',
            '</a>',
            '<a rel="tooltip" title="Edit" class="btn btn-link btn-warning btn-icon table-action edit" href="javascript:void(0)">',
                '<i class="fa fa-edit"></i>',
            '</a>',
            '<a rel="tooltip" title="Remove" class="btn btn-link btn-danger btn-icon table-action remove" href="javascript:void(0)">',
                '<i class="fa fa-remove"></i>',
            '</a>'
        ].join('');
    }


</script>
@endsection