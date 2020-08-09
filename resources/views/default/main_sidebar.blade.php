<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{ asset('assets/adminlte3/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->photo ? asset('images/'.Auth::user()->photo): asset('assets/adminlte3/img/avatar.png') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('users.profile') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <?php 
            $array_dashboard = array(
                ['name'=>'Usuarios','href'=>route('users.index'),'active'=>strpos("$_SERVER[REQUEST_URI]","/admin/users")!==false?'active':''],
                ['name'=>'Medicos','href'=>route('medicos.index'),'active'=>strpos("$_SERVER[REQUEST_URI]","/admin/medicos")!==false?'active':''],
                ['name'=>'Especialidades','href'=>route('especialidades.index'),'active'=>strpos("$_SERVER[REQUEST_URI]","/admin/especialidades")!==false?'active':''])
        ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ route('home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Administración
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($array_dashboard as $ele)
                        <li class="nav-item">
                            <a href="{{ $ele['href'] }}" class="nav-link {{ $ele['active'] }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ $ele['name'] }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>