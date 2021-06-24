

<div class="sidebar" data-color="azure" data-image="{{ asset('assets') }}/img/full-screen-image-3.jpg">
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
             src="{{ asset('assets') }}/img/logo_1591255072.png">
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="info">
                <div class="photo">
                    <img src="{{ asset('assets') }}/img/default-avatar.png" />
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
            <li >
                <a  href="/">
                    <i class="pe-7s-graph"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            {{-- sinh viên --}}
            <li>
                <a  href="{{ route('students.index') }}">
                    <i class="pe-7s-user-female"></i>
                    <p>Sinh Viên</p>
                </a>
            </li>
            {{-- lớp --}}
            <li>
                <a href="{{ route('class.index') }}">
                    <i class="pe-7s-date"></i>
                    <p>Lớp</p>
                </a>
            </li>
            {{-- khóa --}}
            <li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="pe-7s-note2"></i>
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
            </li>
            
            {{-- Ngành--}}
            <li>
                <a href="{{route('major.index')}}">
                    <i class="pe-7s-graph1"></i>
                    <p>Ngành</p>
                </a>
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