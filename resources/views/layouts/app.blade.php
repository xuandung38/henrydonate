<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Henry, cựu tuyển thủ đường giữa tài năng của SAJ ') }}</title>
    <meta name="description" content="Henry được đánh giá là một trong những người chơi đường giữa hay nhất của Việt Nam trong giai đoạn 2014 - 2015. Trong màu áo của Zotac 269, Henry cũng đã giành được những thành công đáng kể."/>
    <meta name="keywords" content="Cùng chơi với những game thủ chuyên nghiệp, hot streamer, hot girl và những người nổi tiếng."/>
   
    <meta property="og:title" content="'Henry, cựu tuyển thủ đường giữa tài năng của SAJ "/>
    <meta property="og:description" content="Henry được đánh giá là một trong những người chơi đường giữa hay nhất của Việt Nam trong giai đoạn 2014 - 2015. Trong màu áo của Zotac 269, Henry cũng đã giành được những thành công đáng kể."/>
    <meta property="og:image" content="{{ asset('panel/img/lg.jpg')}}"/>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('panel/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('panel/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/buttonLoader.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    {{--<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">--}}

      {{--<!-- Sidebar - Brand -->--}}
      {{--<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">--}}
        {{--<div class="sidebar-brand-icon rotate-n-15">--}}
          {{--<i class="fas fa-laugh-wink"></i>--}}
        {{--</div>--}}
        {{--<div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>--}}
      {{--</a>--}}

      {{--<!-- Divider -->--}}
      {{--<hr class="sidebar-divider my-0">--}}

      {{--<!-- Nav Item - Dashboard -->--}}
      {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="index.html">--}}
          {{--<i class="fas fa-fw fa-tachometer-alt"></i>--}}
          {{--<span>Dashboard</span></a>--}}
      {{--</li>--}}

      {{--<!-- Divider -->--}}
      {{--<hr class="sidebar-divider">--}}

      {{--<!-- Heading -->--}}
      {{--<div class="sidebar-heading">--}}
        {{--Interface--}}
      {{--</div>--}}

      {{--<!-- Nav Item - Pages Collapse Menu -->--}}
      {{--<li class="nav-item active">--}}
        {{--<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">--}}
          {{--<i class="fas fa-fw fa-cog"></i>--}}
          {{--<span>Components</span>--}}
        {{--</a>--}}
        {{--<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
          {{--<div class="bg-white py-2 collapse-inner rounded">--}}
            {{--<h6 class="collapse-header">Custom Components:</h6>--}}
            {{--<a class="collapse-item active" href="buttons.html">Buttons</a>--}}
            {{--<a class="collapse-item" href="cards.html">Cards</a>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}

      {{--<!-- Nav Item - Utilities Collapse Menu -->--}}
      {{--<li class="nav-item">--}}
        {{--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">--}}
          {{--<i class="fas fa-fw fa-wrench"></i>--}}
          {{--<span>Utilities</span>--}}
        {{--</a>--}}
        {{--<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">--}}
          {{--<div class="bg-white py-2 collapse-inner rounded">--}}
            {{--<h6 class="collapse-header">Custom Utilities:</h6>--}}
            {{--<a class="collapse-item" href="utilities-color.html">Colors</a>--}}
            {{--<a class="collapse-item" href="utilities-border.html">Borders</a>--}}
            {{--<a class="collapse-item" href="utilities-animation.html">Animations</a>--}}
            {{--<a class="collapse-item" href="utilities-other.html">Other</a>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}

      {{--<!-- Divider -->--}}
      {{--<hr class="sidebar-divider">--}}

      {{--<!-- Heading -->--}}
      {{--<div class="sidebar-heading">--}}
        {{--Addons--}}
      {{--</div>--}}

      {{--<!-- Nav Item - Pages Collapse Menu -->--}}
      {{--<li class="nav-item">--}}
        {{--<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">--}}
          {{--<i class="fas fa-fw fa-folder"></i>--}}
          {{--<span>Pages</span>--}}
        {{--</a>--}}
        {{--<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">--}}
          {{--<div class="bg-white py-2 collapse-inner rounded">--}}
            {{--<h6 class="collapse-header">Login Screens:</h6>--}}
            {{--<a class="collapse-item" href="login.html">Login</a>--}}
            {{--<a class="collapse-item" href="register.html">Register</a>--}}
            {{--<a class="collapse-item" href="forgot-password.html">Forgot Password</a>--}}
            {{--<div class="collapse-divider"></div>--}}
            {{--<h6 class="collapse-header">Other Pages:</h6>--}}
            {{--<a class="collapse-item" href="404.html">404 Page</a>--}}
            {{--<a class="collapse-item" href="blank.html">Blank Page</a>--}}
          {{--</div>--}}
        {{--</div>--}}
      {{--</li>--}}

      {{--<!-- Nav Item - Charts -->--}}
      {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="charts.html">--}}
          {{--<i class="fas fa-fw fa-chart-area"></i>--}}
          {{--<span>Charts</span></a>--}}
      {{--</li>--}}

      {{--<!-- Nav Item - Tables -->--}}
      {{--<li class="nav-item">--}}
        {{--<a class="nav-link" href="tables.html">--}}
          {{--<i class="fas fa-fw fa-table"></i>--}}
          {{--<span>Tables</span></a>--}}
      {{--</li>--}}

      {{--<!-- Divider -->--}}
      {{--<hr class="sidebar-divider d-none d-md-block">--}}

      {{--<!-- Sidebar Toggler (Sidebar) -->--}}
      {{--<div class="text-center d-none d-md-inline">--}}
        {{--<button class="rounded-circle border-0" id="sidebarToggle"></button>--}}
      {{--</div>--}}

    {{--</ul>--}}
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }} </span>
                        <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
                    </a>
                    <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ url('user') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Chỉnh sửa hồ sơ
                                </a>
                                <a class="dropdown-item" href="{{ route('donate') }}">
                                <i class="fas fa-flag fa-sm fa-fw mr-2 text-gray-400"></i>
                                Donate
                                </a>
                                <a class="dropdown-item" href="{{ route('transaciton') }}">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                               Lịch sử donate
                                </a>
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                                </a>
                        </div>
                </li>x
            @endguest

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid" id="app">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('panel/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('panel/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('panel/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('panel/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('panel/js/jquery.buttonLoader.js') }}"></script>
  <script src="{{ asset('panel/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('panel/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    @yield('script')
</body>

</html>
