<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("img/avatar-default.jpeg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->nombre }}</p>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            @if(Entrust::hasRole('administracion'))
                <li class="header">Administración</li>
                <li class="">
                    <a href="{{ url('admin/home') }}"><span>Home</span></a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Usuarios</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ url('admin/administracion/lista') }}" class="" alt="Usuarios"><i class="fa fa-university"></i><span>Administración</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <span>Contabilidad</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/recaudaciones/lista') }}" class="" alt="Ingresos"><i class="fa fa-hand-o-left"></i><span>Recaudación</span></a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>