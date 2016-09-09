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
                <li class="">
                    <a href="{{ url('admin/sucursales/lista') }}"><span>Sucursales</span></a>
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
                        <li class="">
                            <a href="{{ url('admin/recaudaciones/informe_mensual') }}" class="" alt="Ingresos"><i class="fa fa-hand-o-left"></i><span>Informe Mensual</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/recaudaciones/informe_anual') }}" class="" alt="Ingresos"><i class="fa fa-hand-o-left"></i><span>Informe Anual</span></a>
                        </li>
                    </ul>
                </li>
                 <li class="treeview">
                    <a href="#">
                        <span>Inventario</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="">
                            <a href="{{ url('admin/proveedores/lista') }}" class="" alt="Proveedores"><i class="fa fa-industry"></i><span>Proveedores</span></a>
                        </li>
                        <li class="">
                            <a href="{{ url('admin/productos/lista') }}" class="" alt="Productos"><i class="fa fa-industry"></i><span>Productos</span></a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>