
@extends('layouts.layout')

@section('main')
<style>

    #dashboard>a{
        background: #d0e4ff4a;
    }
</style>
<div class="main-content">
    <div class="container-fluid">

        {{-- <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Global Sales by Top Locations</h4>
                        <p class="category">All products that were shipped</p>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../assets/img/flags/US.png">
                                                    </div>
                                                </td>
                                                <td>USA</td>
                                                <td class="text-right">
                                                    2.920
                                                </td>
                                                <td class="text-right">
                                                    53.23%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../assets/img/flags/DE.png">
                                                    </div>
                                                </td>
                                                <td>Germany</td>
                                                <td class="text-right">
                                                    1.300
                                                </td>
                                                <td class="text-right">
                                                    20.43%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../assets/img/flags/AU.png">
                                                    </div>
                                                </td>
                                                <td>Australia</td>
                                                <td class="text-right">
                                                    760
                                                </td>
                                                <td class="text-right">
                                                    10.35%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../assets/img/flags/GB.png">
                                                    </div>
                                                </td>
                                                <td>United Kingdom</td>
                                                <td class="text-right">
                                                    690
                                                </td>
                                                <td class="text-right">
                                                    7.87%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../assets/img/flags/RO.png">
                                                    </div>
                                                </td>
                                                <td>Romania</td>
                                                <td class="text-right">
                                                    600
                                                </td>
                                                <td class="text-right">
                                                    5.94%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="../assets/img/flags/BR.png">
                                                    </div>
                                                </td>
                                                <td>Brasil</td>
                                                <td class="text-right">
                                                    550
                                                </td>
                                                <td class="text-right">
                                                    4.34%
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-1">
                                <div id="worldMap" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}



        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Tỉ lệ nợ học phí</h4>
                        
                    </div>
                    <div class="content">
                        <div id="chartPreferences" class="ct-chart "></div>
                    </div><hr>
                    <div class="footer">
                        <div class="legend"> 
                            <i class="fa fa-circle text-info"></i> Hoàn thành<br>
                            <i style="color:#9368e9" class="fa fa-circle"></i> từ 1 đến 5 đợt<br>
                            <i class="fa fa-circle text-warning"></i> 6 đợt <br>
                            <i class="fa fa-circle text-danger"></i> 7 đợt trở lên<br>
                        </div>
                        
                        {{-- <div class="stats">
                            <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                        </div> --}}
                    </div>

                </div>
            </div>

            <div class="col-md-8">
                <div class="card ">
                    <div class="header">
                        @php
                             date_default_timezone_set('Asia/Ho_Chi_Minh');
                                $year = date('Y', time());
                        @endphp
                        <h4 class="title">Doanh số năm {{$year}} </h4>
                        {{-- <p class="category">(Triệu/tháng)</p> --}}
                    </div>
                    <div class="content">
                       <a style="font-size: 10px;color: gray; margin-left: 5px;">(Triệu VNĐ)</a>
                        <div id="chartViews" style="margin-top: 0px;" class="ct-chart"></div>
                    </div>
                    {{-- <div class="footer">
                        <div class="legend">
                            <i class="fa fa-circle text-info"></i> Doanh thu
                             <i class="fa fa-circle text-danger"></i> BMW 5 Series
                        </div>
                        <hr>
                        <div class="stats">
                            <i class="fa fa-check"></i> Data information certified
                        </div>
                    </div>  --}}
                </div>
            </div>
        </div>



    



    </div>
</div>

<script>
type = ['', 'info', 'success', 'warning', 'danger'];
var owe5 = {{$owe5}} , owe6= {{$owe6}},owe7= {{$owe7}};
var ok = 100 - owe5 - owe6 - owe7; 
var time = new Date();
 var year= time.getFullYear();
 
 var array = <?php echo json_encode($array); ?>;
console.log(array);
 
demo = {
    
    initDashboardPageCharts: function () {
        var dataPreferences = {
        series: [
            [25, 30, 20, 25]
        ]
        };

        var optionsPreferences = {
        donut: true,
        donutWidth: 40,
        startAngle: 0,
        height: "245px",
        total: 100,
        showLabel: false,
        axisX: {
            showGrid: false
        }
        };

        Chartist.Pie('#chartPreferences', dataPreferences, optionsPreferences);

        Chartist.Pie('#chartPreferences', {
        labels: [ ok+"%", owe7+"%", owe6+"%", owe5+"%"],
        series: [ok,owe7, owe6, owe5]
        }); 
//biểu đồ cột
       
        var dataViews = {
        labels: [
            "01/"+year, "02/"+year, "03/"+year, "04/"+year, "05/"+year, "06/"+year, "07/"+year, "08/"+year, "09/"+year, "10/"+year, "11/"+year, "12/"+year
           
        ],
        series: [
            [array[1], array[2], array[3], array[4], array[5], array[6], array[7], array[8], array[9], array[10], array[11], array[12]]
      ]
    };

    var optionsViews = {
      seriesBarDistance: 10,
      classNames: {
        bar: 'ct-bar ct-azure'
      },
      axisX: {
        showGrid: false
      }
    };

    var responsiveOptionsViews = [
      ['screen and (max-width: 640px)', {
        seriesBarDistance: 5,
        axisX: {
          labelInterpolationFnc: function (value) {
            return value[0];
          }
        }
      }]
    ];

    Chartist.Bar('#chartViews', dataViews, optionsViews, responsiveOptionsViews);
 
    },
}

</script>
    @endsection