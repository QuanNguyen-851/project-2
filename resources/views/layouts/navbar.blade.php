<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-info btn-fill btn-round btn-icon">
                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">MINISTRY</a>
        </div>
        <div class="collapse navbar-collapse">
            <a style="margin-right: 12px;margin-left: 21cm;" onclick="return confirm('Việc này sẽ không thể thay đổi được bạn xác nhận chứ ?')" href="{{ route('fee.addcount') }}" class="btn btn-success" type="button" title="Cập nhật số đợt phải đóng học phí" >Đợt mới</a>
            <a style="margin-right:25px" onclick="return confirm('Việc này sẽ không thể thay đổi được bạn xác nhận chứ ?')" href="{{ route('fee.subaddcount') }}" class="btn btn-success" type="button" title="Cập nhật số đợt phải đóng phụ phí (5 tháng một lần)">kỳ mới</a>
            <ul class="nav navbar-nav navbar-right">


                <li class="dropdown dropdown-with-icons">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-list"></i>
                        <p class="hidden-md hidden-lg">
                            More
                            <b class="caret"></b>
                        </p>
                    </a>
                    <ul class="dropdown-menu dropdown-with-icons">
                        <li>
                            <a href="{{ route('employee.index') }}">
                                <i class="pe-7s-mail"></i>Danh sách nhân viên
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}" class="text-danger" onclick="return confirm('Bạn chắc muốn đăng xuất chứ ?')">
                                <i class="pe-7s-close-circle"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>



        </div>
    </div>
</nav>
