<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('assets/images/no-avatar.jpg') }}" class="img-circle" alt="{{ auth()->guard()->user()->username }}">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->guard()->user()->first_name . ' ' . auth()->guard()->user()->last_name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> {{ auth()->guard()->user()->role === 1 ? 'Admin' : 'User' }}</a>
            </div>
        </div>
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <li @if(route('dashboard') == url()->current()) class="active" @endif>
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li @if(route('users.index') == url()->current()) class="active" @endif>
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                </a>
            </li>

            @php $routeNames = [route('article_categories.index'), route('articles.index')]; @endphp
            <li @if(in_array(url()->current(), $routeNames)) class="active treeview" @else class="treeview" @endif>
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Articles</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('article_categories.index') }}">Article Categories</a></li>
                    <li><a href="{{ route('articles.index') }}">Articles</a></li>
                </ul>
            </li>
        </ul>
        <!-- sidebar menu: : style can be found in sidebar.less -->
    </section>
    <!-- /.sidebar -->
</aside>
<!-- Left side column. contains the logo and sidebar -->
