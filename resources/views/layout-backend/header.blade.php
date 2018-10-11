<div class="wrapper admin-menu">
    <header class="main-header">
        <nav class="navbar navbar-static-top header-admin" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="user user-menu" style="margin-right:10px;">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa  fa-sign-out"></i>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
                        </form>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar admin-menu">
        <section class="sidebar">
            <div class="user-panel" style="margin-bottom:10px;">
                <div class="pull-left info" style="margin-top:15px">
                    <p></p>
                    <p><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa  fa-sign-out"></i>Logout</a></p>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="treeview">
                    <a href="/dashboard">
                        <i class="fa fa-home"></i>
                        <span>DASHBOARD</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="/products">
                        <i class="fa fa-database"></i>
                        <span>PRODUCTS</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="/categories">
                        <i class="fa fa-database"></i>
                        <span>CATEGORIES</span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>