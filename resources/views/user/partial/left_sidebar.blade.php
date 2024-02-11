<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="{{ route('user.change_password') }}"><i
                data-feather="settings"></i></a><img class="img-90 rounded-circle"
            src="{{ course_member()->other_file ? asset('uploads/course_member_Photograph/' . course_member()->other_file->photograph_file_name) : asset('assets/backend/images/dashboard/1.png') }}"
            alt="" height="100px">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::guard('user')->user()->name }}</h6>
        </a>
        <a href="" class="btn btn-sm btn-success">Update</a>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>User Panel</h6>
                        </div>
                    </li>
                    @if (!check_user_data_valid(user_id()))
                        <li class="dropdown"><a class="nav-link menu-title link-nav"
                                href="{{ route('user.userdashboard') }}"><i
                                    data-feather="home"></i><span>Dashboard</span></a>
                        </li>
                    @else
                        <li class="dropdown"><a class="nav-link menu-title link-nav"
                                href="{{ route('user.userdashboard') }}"><i
                                    data-feather="home"></i><span>Dashboard</span></a>
                        </li>

                        <li class="dropdown"><a class="nav-link menu-title link-nav"
                                href="{{ route('user.user_profile') }}"><i data-feather="home"></i><span>User
                                    profile</span></a>
                        </li>

                        <li class="dropdown"><a class="nav-link menu-title link-nav"
                                href="{{ route('user.pay_bill') }}"><i data-feather="home"></i><span>Pay bill</span></a>
                        </li>

                        <li class="dropdown"><a class="nav-link menu-title link-nav btn-warning"
                                href="{{ route('user.change_password') }}"><i
                                    data-feather="lock"></i><span>ChangePassword</span></a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
