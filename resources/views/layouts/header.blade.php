<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">MSP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ config ('app.name')}}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
    
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">
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
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                
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
              </li>
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>