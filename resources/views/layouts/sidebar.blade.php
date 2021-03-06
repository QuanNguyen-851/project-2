
<div class="sidebar" data-color="azure" data-image="{{ asset('assets') }}/img/full-screen-image-3.jpg">
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="logo">
        {{-- <a href="/dashboard);" class="simple-text logo-mini" style="margin-left: 40px;">
            
        </a> --}}

        <a href="/dashboard" class="simple-text logo-normal">
            <img id='bkacad' style='width: 160px;margin-left: 50px;'
             src="{{ asset('assets') }}/img/logo_1591255072.png">
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="info">
                

                <a  href="{{ route('employee.edit',Session::get('id')) }}" >
                   
                    <span style="font-size: large; text-align: center;">
                       
                        @if (Session::has('name'))
                            {{Session::get('name')}}
                        @endif
                        
                    </span>
                </a>

                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('employee.edit',Session::get('id')) }}">
                                <span class="sidebar-mini">
                                <i class="pe-7s-id"></i>
                                </span>
                                <span class="sidebar-normal">Cập nhật thông tin cá nhân</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('logout') }}">
                                <span class="sidebar-mini"><i class="pe-7s-next-2"></i></span>
                                <span class="sidebar-normal">Đăng xuất</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <ul class="nav">
            <li id = "dashboard">
                <a style="border-radius: 25px;"  href="/">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            {{-- sinh viên --}}
            <li id = "sinhvien">
                <a  style="border-radius: 25px;"  href="{{ route('students.index') }}">
                    <i class="pe-7s-study"></i>
                    <p>Sinh Viên</p>
                </a>
            </li>
            {{-- thống kê --}}
            <li id = "thongke">
                <a  style="border-radius: 25px;"  href="{{ route('fee.statistic',['month'=>0])}}">
                    <i class="pe-7s-graph3" ></i>
                    <p>Thống kê</p>
                </a>
            </li>
            
            {{-- danh sách nợ học phí--}}
            <li id= "no">
                <a  style="border-radius: 25px;"  href="{{ route('fee.listowefee', ['month'=>0]) }}">
                    <i class="pe-7s-delete-user" ></i> 
                    <p>Danh sách nợ học phí</p>
                </a>
            </li>
            {{-- lớp --}}
            <li id="lop">
                <a  style="border-radius: 25px;"  href="{{ route('class.index') }}">
                    <i class="pe-7s-albums"></i>
                    <p>Lớp</p>
                </a>
            </li>
            {{-- khóa --}}
            <li   id="khoa">
                <a style="border-radius: 25px;"href="{{route('course.index')}}">
                    <i class="pe-7s-bookmarks"></i>
                    <p>Khóa</p>
                </a>
            </li>
            {{-- <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="pe-7s-bookmarks"></i>
                    <p>khóa
                       <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li>
                            <a href="{{route('course.index')}}">
                                <span class="sidebar-mini"><i class="pe-7s-study"></i></span>
                                <span class="sidebar-normal">Đang theo học</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('course.passed')}}">
                                <span class="sidebar-mini"><i class="pe-7s-check"></i></span>
                                <span class="sidebar-normal">Đã tốt nghiệp</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li> --}}
            
            {{-- Ngành--}}
            <li id="nganh">
                <a  style="border-radius: 25px;"  href="{{route('major.index')}}">
                    <i class="pe-7s-box2"></i>
                    <p>Ngành</p>
                </a>
            </li>

            {{-- nhân viên --}}
            {{-- <li>
                <a href="{{ route('employee.index') }}">
                    <i class="pe-7s-user"></i>
                    <p>Nhân viên</p>
                </a>
            </li> --}}
            {{-- Học Bổng --}}
            <li id="hocbong">
                <a  style="border-radius: 25px;"  href="{{ route('scholarship.index') }}">
                    <i class="pe-7s-gift"></i>
                    <p>Học bổng</p>
                </a>
            </li>
            {{-- phương thức đóng học --}}
            <li  style="border-radius: 25px;"  id="phuongthuc"> 
                <a href="{{ route('payment.index') }}">
                    <i class="pe-7s-network"></i>
                    <p>phương thức đóng học</p>
                </a>
            </li>
            {{-- Thống kê --}}


           
        </ul>
    </div>
</div>