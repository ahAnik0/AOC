<div class="page-main-header">
    <div class="main-header-right row m-0">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="{{ route('user.userdashboard') }}"><img class="img-fluid css1"
                        src="{{ asset('assets/backend/images/logo/logo.PNG') }}" alt=""></a></div>
            <div class="dark-logo-wrapper"><a href="{{ route('user.userdashboard') }}"><img class="img-fluid css2"
                        src="{{ asset('assets/backend/images/logo/logo.PNG') }}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle" data-feather="align-center"
                    id="sidebar-toggle"></i></div>
        </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <h3 class="font-success css3">Army Officers Club</h3>
                </li>
            </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li><a class="text-dark" href="#" onclick="javascript:toggleFullScreen()"><i
                            data-feather="maximize"></i></a></li>
                <li>
                    <div class="mode"><i class="fa fa-moon-o"></i></div>
                </li>

                <li class="onhover-dropdown p-0">
                    <button
                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                        class="btn btn-primary-light" type="button"><a href="login_two.html"><i
                                data-feather="log-out"></i>Log out</a></button>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="css4">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
    </div>
</div>
