<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="{{route('admin.password/change_pasword')}}"><i data-feather="settings"></i></a><img
                class="img-90 rounded-circle" src="{{asset('assets/backend/images/dashboard/1.png')}}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div>
        <a href="">
            <h6 class="mt-3 f-14 f-w-600">{{\Illuminate\Support\Facades\Auth::user()->name}}</h6></a>
        <p class="mb-0 font-roboto">Army Officers Club</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('admin.adminDashboard')}}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>
                    
                    
                    @if(count(menu_check('Member')) !== 0 and count(menu_check('ServingUnit')) !== 0 and count(menu_check('Designation')) !== 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Member</h6>
                            </div>
                        </li>
                        <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="user-plus"></i><span>Members</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{route('admin.member/create_member')}}">Create Member</a></li>
                                <li><a href="{{route('admin.member/create_guest_from')}}">Create Guest Member</a></li>
                                <li><a href="{{route('admin.member/all_member')}}">All Member</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="user-plus"></i><span>Others</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{route('admin.all_contact')}}">All Contact</a></li>
                                <li><a href="{{route('admin.all_notice_info')}}">All Notice/Info</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.servingunit/index')}}"><i data-feather="airplay"></i><span>Serving Unit</span></a>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.designation/index')}}"><i data-feather="tag"></i><span>Designation</span></a>
                        </li>
                        
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Staff member</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.staffmember/create')}}"><i data-feather="users"></i><span>Create Staff member</span></a>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.staffmember/index')}}"><i data-feather="users"></i><span>All Staff Member</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Movie')) !== 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Movie</h6>
                            </div>
                        </li>
                        
                        <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="film"></i><span>Movie</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{route('admin.movie/create')}}">Create Movie</a></li>
                                <li><a href="{{route('admin.movie/index')}}">All Movie</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.movie/see_available_seat',date('Y-m-d'))}}"><i data-feather="git-pull-request"></i><span>Available Seat</span></a>
                        </li>
                        
                        
                        <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="tag"></i><span>Sell ticket</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{route('admin.movie/booking')}}">Sell ticket</a></li>
                                <li><a href="{{route('admin.movie/booking_for_guest_member')}}">Sell ticket for guest</a></li>
                            </ul>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.report/movie_ticketing_report_index')}}"><i
                                        data-feather="check-circle"></i><span>Sales History</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Books')) !== 0 and menu_check('Library'))
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Library</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.book/index')}}"><i data-feather="book-open"></i><span>Books / Items</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.library/library_booking_form')}}"><i data-feather="slack"></i><span>Sell book</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.library/all_library_booking_index')}}"><i data-feather="trending-up"></i><span>Sales
                                    Report</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('HallBooking')) !== 0)
                        
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Hall Booking</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.hall_booking/create_bokking_form')}}"><i data-feather="clock"></i><span>New Booking</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.hall_booking/index')}}"><i data-feather="clock"></i><span>Booking History</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.hall_booking/calender_view')}}"><i data-feather="calendar"></i><span>Calendar view</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Service')) !== 0 and in_array(admin_id(),['114', '92', '121']))
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Bowling</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.service/service_form','bowling')}}"><i data-feather="slack"></i><span>Sell ticket</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.service/service_report_index','bowling')}}"><i
                                        data-feather="trending-up"></i><span>Sales Report</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Service')) !== 0 and in_array(admin_id(),['118','92', '121']))
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Tennis</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.service/service_form','tennis')}}"><i data-feather="slack"></i><span>Sell ticket</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.service/service_report_index','tennis')}}"><i
                                        data-feather="trending-up"></i><span>Sales Report</span></a>
                        </li>
                    
                    @endif
                    @if(count(menu_check('salon')) !== 0 )
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Salon</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.salon/service_form')}}"><i data-feather="hexagon"></i><span>Sell a Service</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.salon/service_report')}}"><i data-feather="trello"></i><span>Sales Report</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('swim')) !== 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Swim,Gym,Bath</h6>
                            </div>
                        </li>
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.swim/service_form')}}"><i data-feather="trello"></i><span>Sell a service</span></a>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.swim/service_report')}}"><i data-feather="trello"></i><span>Sales Report</span></a>
                        </li>
                    
                    @endif

                    @if(count(menu_check('DeviceManager')) !== 0)
                        
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Device Management</h6>
                            </div>
                        </li>
                        
                        <li>
                            <a class="nav-link menu-title link-nav" href="{{route('admin.device/index')}}"><i data-feather="smartphone"></i><span>All Device</span></a>
                        </li>
                    
                    @endif
                    
                    @if(count(menu_check('Report')) !== 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Report</h6>
                            </div>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.report/payment_history_index')}}"><i
                                        data-feather="dollar-sign"></i><span>Payment History Report</span></a>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.report/movie_ticketing_report_index')}}"><i
                                        data-feather="activity"></i><span>Cineplex Sales Report</span></a>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.library/all_library_booking_index')}}"><i data-feather="bold"></i><span>Library Sales
                                    report</span></a>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.service/service_report_index','no_value')}}"><i data-feather="clipboard"></i><span>Service Sales
                                Report</span></a>
                        </li>
                    
                    @endif
                    
                    
                    @if(count(menu_check('Attendance')) !== 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Attendance</h6>
                            </div>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.attendance/att_index')}}"><i data-feather="log-in"></i><span>Attendance Report</span></a>
                        </li>
                        
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.attendance/show_data')}}"><i data-feather="log-in"></i><span>Employee list device</span></a>
                        </li>
                    
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.attendance/member_assign_device_show')}}"><i data-feather="log-in"></i><span>Member assign device</span></a>
                        </li>
                        <li class="dropdown">
                            <a class="nav-link menu-title link-nav" href="{{route('admin.attendance/member_device_managment')}}"><i data-feather="log-in"></i><span>Member Device Managment</span></a>
                        </li>
                    
                    @endif
                    {{-- /////////////////////////////////////////////////////////////////////////////--}}
                    @if(count(menu_check('Role')) !== 0)
                        <li class="sidebar-main-title">
                            <div>
                                <h6>Route Permission</h6>
                            </div>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Menu')) !== 0)
                        <li class="dropdown"><a class="nav-link menu-title active" href="javascript:void(0)"><i
                                        data-feather="list"></i><span>Menu</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{route('admin.menu/menu_create')}}" class="active">Create Menu</a></li>
                                <li><a href="{{route('admin.menu/all_menu')}}" class="{{Request::is('*/*/all_menu')?'active': ''}}">All Menu</a></li>
                            </ul>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Route')) !== 0)
                        <li class="dropdown"><a class="nav-link menu-title link-nav {{Request::is('*/dynamic_route')?'active': ''}}" href="{{route('admin.dynamic_route')}}"><i
                                        data-feather="home"></i><span>Module/Route</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('User')) !== 0)
                        <li class="dropdown"><a class="nav-link menu-title link-nav {{Request::is('*/all_user')?'active': ''}}" href="{{route('admin.all_user')}}"><i
                                        data-feather="user-plus"></i><span>Admin Users</span></a>
                        </li>
                    @endif
                    
                    @if(count(menu_check('Role')) !== 0)
                        <li class="dropdown"><a class="nav-link menu-title {{Request::is('*/role/*')?'active': ''}}" href="javascript:void(0)"><i
                                        data-feather="list"></i><span>Roles</span></a>
                            <ul class="nav-submenu menu-content">
                                <li><a href="{{route('admin.role/all_role')}}" class="{{Request::is('*/*/all_role')?'active': ''}}">All role</a></li>
                                <li><a href="{{route('admin.role/add_role')}}" class="{{Request::is('*/*/add_role')?'active': ''}}">Add role</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
