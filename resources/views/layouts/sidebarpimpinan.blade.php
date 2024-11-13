<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            @if (Auth::guard('admin')->check())
                {{ Auth::guard('admin')->user()->name }}
            @elseif (Auth::guard('petugas')->check())
                {{ Auth::guard('petugas')->user()->name }}
            @elseif (Auth::guard('pimpinan')->check())
                {{ Auth::guard('pimpinan')->user()->name }}
            @elseif (Auth::guard('konsumen')->check())
                {{ Auth::guard('konsumen')->user()->name }}
            @else
                Guest
            @endif
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="{{route('dashboard.petugas')}}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('histori.index') }}">
            <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
          </a>
        </li> 
        

    </section>
  </aside>