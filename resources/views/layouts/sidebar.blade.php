<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
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
          <a href="{{route('dashboard.admin')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="header">MAIN</li>
        <li>
          <a href="{{route('kategori.admin')}}">
          <i class="fa fa-cube"></i> <span>Kategori</span>
          </a>
        </li>
        <li>
          <a href="{{route('produk.admin')}}">
          <i class="fa fa-cubes"></i> <span>Produk</span>
          </a>
        </li>
        <li>
          <a href="{{route('petugas.index')}}">
          <i class="fa fa-user"></i> <span>Petugas</span>
          </a>
        </li>
        <li class="header">Transaksi</li>
        <li>
          <a href="{{route('jenispay.index')}}">
          <i class="fa fa-money"></i> <span>Jenis Pembayaran</span>
          </a>
        </li>
        <!-- <li>
          <a href="#">
          <i class="fa fa-money"></i> <span>Pengeluaran</span>
          </a>
        </li>
        <li>
          <a href="#">
          <i class="fa fa-download"></i> <span>Pembelian</span>
          </a>
        </li>
        <li>
          <a href="#">
          <i class="fa fa-upload"></i> <span>Penjualan</span>
          </a>
        </li> -->
        <!-- <li>
          <a href="">
          <i class="fa fa-cart-arrow-down"></i> <span>Transaksi Baru</span>
          </a>
        </li> -->
        <li>
        <a href="{{ route('transaksiDetail.index') }}">
          <i class="fa fa-cart-arrow-down"></i> <span>Transaksi</span>
        </a>
        </li>
  
        <li class="header">Report</li>
         <li>
          <a href="{{ route('histori.index') }}">
          <i class="fa fa-file-pdf-o"></i> <span>Laporan</span>
          </a>
        </li> 
        <li>
          <a href="{{route('logout')}}">
          <i class="fa fa-file-pdf-o"></i> <span>Logout</span>
          </a>
        </li>
        

    </section>
    <!-- /.sidebar -->
  </aside>