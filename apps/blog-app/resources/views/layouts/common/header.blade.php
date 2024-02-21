<!-- header -->
<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Blog</b></span>

        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Blog Management App</b></span>
    </a>
    <!-- Logo -->

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Sidebar toggle button-->

        <!-- navbar-custom-menu -->
        <div class="navbar-custom-menu">
            <!-- nav navbar-nav -->
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/images/no-avatar.jpg') }}" class="user-image" alt="{{ auth()->guard()->user()->username }}">
                        <span class="hidden-xs">{{ auth()->guard()->user()->first_name . ' ' . auth()->guard()->user()->last_name }}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ asset('assets/images/no-avatar.jpg') }}" class="img-circle" alt="{{ auth()->guard()->user()->username }}">
                            <p>{{ auth()->guard()->user()->first_name . ' ' . auth()->guard()->user()->last_name }} - Admin</p>
                        </li>
                        <!-- User image -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Edit Account</a>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-default btn-flat">Sign out</button>
                                </form>
                            </div>
                        </li>
                        <!-- Menu Footer-->
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
            </ul>
            <!-- nav navbar-nav -->
        </div>
        <!-- navbar-custom-menu -->
    </nav>
    <!-- Header Navbar: style can be found in header.less -->
</header>
<!-- header -->
