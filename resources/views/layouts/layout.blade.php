<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/logo1.gif">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    
        <title>Quản lý học phí sinh viên BKACAD</title>
    
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
    
    
        <!-- Bootstrap core CSS     -->
        <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
    
        <!--  Light Bootstrap Dashboard core CSS    -->
        <link href="{{ asset('assets') }}/css/light-bootstrap-dashboard.css?v=1.4.1" rel="stylesheet"/>
    
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="{{ asset('assets') }}/css/demo.css" rel="stylesheet" />
    
    
        <!--     Fonts and icons     -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="{{ asset('assets') }}/css/pe-icon-7-stroke.css" rel="stylesheet" />
    
    </head>
<body>
    <div class="wrapper" >
        
        {{-- thanh sidebar bên trái --}}
            @include('layouts.sidebar') 
        <div class="main-panel" style="background-color: #507ada0d; background-image: url({{ asset('assets') }}/img/full-screen-image-4.jpg);"  >
           
            {{-- thanh navbar trên cùng --}}
            @include('layouts.navbar')
            <div class="main-content" >
                <div class="container-fluid">
                    {{-- cái thay đổi --}}
                        @yield('main')
                </div>
                {{-- thanh footer --}}
            @include('layouts.footer')
            </div>
            
        </div>
            
    </div>

</body>
     <!--   Core JS Files  -->
     <script src="{{ asset('assets') }}/js/jquery.min.js" type="text/javascript"></script>
     <script src="{{ asset('assets') }}/js/bootstrap.min.js" type="text/javascript"></script>
     <script src="{{ asset('assets') }}/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
 
 
     <!--  Forms Validations Plugin -->
     <script src="{{ asset('assets') }}/js/jquery.validate.min.js"></script>
 
     <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
     <script src="{{ asset('assets') }}/js/moment.min.js"></script>
 
     <!--  Date Time Picker Plugin is included in this js file -->
     <script src="{{ asset('assets') }}/js/bootstrap-datetimepicker.min.js"></script>
 
     <!--  Select Picker Plugin -->
     <script src="{{ asset('assets') }}/js/bootstrap-selectpicker.js"></script>
 
     <!--  Checkbox, Radio, Switch and Tags Input Plugins -->
         <script src="{{ asset('assets') }}/js/bootstrap-switch-tags.min.js"></script>
 
     <!--  Charts Plugin -->
     <script src="{{ asset('assets') }}/js/chartist.min.js"></script>
 
     <!--  Notifications Plugin    -->
     <script src="{{ asset('assets') }}/js/bootstrap-notify.js"></script>
 
     <!-- Sweet Alert 2 plugin -->
     <script src="{{ asset('assets') }}/js/sweetalert2.js"></script>
 
     <!-- Vector Map plugin -->
     <script src="{{ asset('assets') }}/js/jquery-jvectormap.js"></script>
 
     <!--  Google Maps Plugin    -->
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
 
     <!-- Wizard Plugin    -->
     <script src="{{ asset('assets') }}/js/jquery.bootstrap.wizard.min.js"></script>
 
     <!--  Bootstrap Table Plugin    -->
     <script src="{{ asset('assets') }}/js/bootstrap-table.js"></script>
 
     <!--  Plugin for DataTables.net  -->
     <script src="{{ asset('assets') }}/js/jquery.datatables.js"></script>
 
 
     <!--  Full Calendar Plugin    -->
     <script src="{{ asset('assets') }}/js/fullcalendar.min.js"></script>
 
     <!-- Light Bootstrap Dashboard Core javascript and methods -->
     <script src="{{ asset('assets') }}/js/light-bootstrap-dashboard.js?v=1.4.1"></script>
 
     <!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
     {{-- <script src="{{ asset('assets') }}/js/demo.js"></script> --}}

{{-- chart --}}
    <script type="text/javascript">
    	$(document).ready(function(){
        	demo.initDashboardPageCharts();
        	demo.initVectorMap();
    	});
	</script>


    {{-- select js --}}
    <script type="text/javascript">
        $().ready(function(){
            //Init Sliders
            demo.initFormExtendedSliders();
            // Init DatetimePicker
            demo.initFormExtendedDatetimepickers();
        });
    </script>
 
    {{-- validate --}}
    <script type="text/javascript">
        $().ready(function(){
            $('#createvalidateform').validate();
            $('#updatevalidateform').validate();
           
        });
    </script>
    {{-- js class --}}
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

                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
        });

    </script>

    {{-- thông báo gửi mail --}}
    @php
        if(Session::has('no')){
            $no = Session::get('no');
        
        }else {
            $no = 0;
        }
    @endphp
<script type="text/javascript"> 

    var no = "<?= $no ?>"
    if(no!=0){
    $(document).ready(function(){

        // demo.initDashboardPageCharts();
        // demo.initVectorMap();

        $.notify({
            icon: 'pe-7s-bell',
            message: "Đã gửi thành công!"

        },{
            type: 'warning',
            timer: 4000
        });

    });
    }
</script>

</html>
