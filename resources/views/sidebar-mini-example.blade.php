<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard PRO by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="../assets/css/light-bootstrap-dashboard.css?v=1.4.1" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body class="sidebar-mini">

<div class="wrapper">
    
<div class="sidebar" data-color="azure" data-image="../assets/img/full-screen-image-3.jpg">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        <a href="/" class="simple-text logo-mini" style="margin-left: 40px;">
            Mi
        </a>

        <a href="/" class="simple-text logo-normal">
            <img id='bkacad' style='width: 118px; margin-left: 10px;'
             src="../assets/img/logo_1591255072.png">
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="info">
                <div class="photo">
                    <img src="../assets/img/default-avatar.png" />
                </div>

                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        Tania Andrew
                        <b class="caret"></b>
                    </span>
                </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="#pablo">
                                <span class="sidebar-mini">MP</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="#pablo">
                                <span class="sidebar-mini">EP</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>

                        <li>
                            <a href="#pablo">
                                <span class="sidebar-mini">S</span>
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            <li class="collapse">
                <a href="/">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            {{-- sinh viên --}}
            <li>
                <a href="{{ route('students.index') }}">
                    <i class="pe-7s-user-female"></i>
                    <p>Sinh Viên</p>
                </a>
            </li>
            {{-- lớp --}}
            <li>
                <a href="calendar.html">
                    <i class="pe-7s-date"></i>
                    <p>Lớp</p>
                </a>
            </li>
            {{-- khóa --}}
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="pe-7s-study"></i>
                    <p>khóa
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li>
                            <a href="buttons">
                                <span class="sidebar-mini">B</span>
                                <span class="sidebar-normal">Đang theo học</span>
                            </a>
                        </li>
                        <li>
                            <a href="grid">
                                <span class="sidebar-mini">GS</span>
                                <span class="sidebar-normal">Đã tốt nghiệp</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            
            {{-- thống kê --}}
            <li>
                <a data-toggle="collapse" href="#tablesExamples">
                    <i class="pe-7s-graph1"></i>
                    <p>Thống kê
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablesExamples">
                    <ul class="nav">
                        <li>
                            <a href="tables/regular.html">
                                <span class="sidebar-mini">RT</span>
                                <span class="sidebar-normal">Theo tháng</span>
                            </a>
                        </li>
                        <li>
                            <a href="tables/extended.html">
                                <span class="sidebar-mini">ET</span>
                                <span class="sidebar-normal">Theo lớp</span>
                            </a>
                        </li>
                        <li>
                            <a href="tables/bootstrap-table.html">
                                <span class="sidebar-mini">BT</span>
                                <span class="sidebar-normal">Nợ học phí</span>
                            </a>
                        </li>
                        <li>
                            <a href="tables/datatables.net.html">
                                <span class="sidebar-mini">DT</span>
                                <span class="sidebar-normal">DataTables.net</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- nhân viên --}}
            <li>
                <a data-toggle="collapse" href="#mapsExamples">
                    <i class="pe-7s-users"></i>
                    <p>Nhân Viên
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="mapsExamples">
                    <ul class="nav">
                        <li>
                            <a href="maps/google.html">
                                <span class="sidebar-mini">GM</span>
                                <span class="sidebar-normal">Giáo vụ</span>
                            </a>
                        </li>
                        <li>
                            <a href="maps/vector.html">
                                <span class="sidebar-mini">VM</span>
                                <span class="sidebar-normal">Kế toán</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            {{-- Học Bổng --}}
            <li>
                <a href="calendar.html">
                    <i class="pe-7s-date"></i>
                    <p>Học bổng</p>
                </a>
            </li>
                     {{-- lớp --}}
            <li>
                <a data-toggle="collapse" href="#formsExamples">
                    <i class="pe-7s-note2"></i>
                    <p>lớp
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formsExamples">
                    <ul class="nav">
                        <li>
                            <a href="forms/regular.html">
                                <span class="sidebar-mini">Rf</span>
                                <span class="sidebar-normal">Regular Forms</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms/extended.html">
                                <span class="sidebar-mini">Ef</span>
                                <span class="sidebar-normal">Extended Forms</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms/validation.html">
                                <span class="sidebar-mini">Vf</span>
                                <span class="sidebar-normal">Validation Forms</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms/wizard.html">
                                <span class="sidebar-mini">W</span>
                                <span class="sidebar-normal">Wizard</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li>
                <a data-toggle="collapse" href="#pagesExamples">
                    <i class="pe-7s-gift"></i>
                    <p>Pages
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li>
                            <a href="pages/user.html">
                                <span class="sidebar-mini">UP</span>
                                <span class="sidebar-normal">User Page</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages/login.html">
                                <span class="sidebar-mini">LP</span>
                                <span class="sidebar-normal">Login Page</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages/register.html">
                                <span class="sidebar-mini">RP</span>
                                <span class="sidebar-normal">Register Page</span>
                            </a>
                        </li>
                        <li>
                            <a href="pages/lock.html">
                                <span class="sidebar-mini">LSP</span>
                                <span class="sidebar-normal">Lock Screen Page</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
</div>


</body>
    <!--   Core JS Files  -->
    <script src="../assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="../assets/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>


	<!--  Forms Validations Plugin -->
	<script src="../assets/js/jquery.validate.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="../assets/js/moment.min.js"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="../assets/js/bootstrap-datetimepicker.min.js"></script>

    <!--  Select Picker Plugin -->
    <script src="../assets/js/bootstrap-selectpicker.js"></script>

	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
		<script src="../assets/js/bootstrap-switch-tags.min.js"></script>

	<!--  Charts Plugin -->
	<script src="../assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
	<script src="../assets/js/sweetalert2.js"></script>

    <!-- Vector Map plugin -->
	<script src="../assets/js/jquery-jvectormap.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

	<!-- Wizard Plugin    -->
    <script src="../assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  bootstrap Table Plugin    -->
    <script src="../assets/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
    <script src="../assets/js/jquery.datatables.js"></script>


    <!--  Full Calendar Plugin    -->
    <script src="../assets/js/fullcalendar.min.js"></script>

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="../assets/js/light-bootstrap-dashboard.js?v=1.4.1"></script>

	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="../assets/js/demo.js"></script>


</html>
