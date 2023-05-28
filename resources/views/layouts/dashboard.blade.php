<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-Surat Pengantar | @yield('page')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <link rel="stylesheet" href="{{asset('./dashboard-asset/customize.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="{{asset('./dashboard-asset/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">
  
  @yield('css-add-on')
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">ESP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">E-Surat Pengantar</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{Auth::user()->list_keluarga->profile?->photo ?? asset('./img/default_user.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->list_keluarga->profile?->nama ?? Auth::user()->no_kk}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{Auth::user()->list_keluarga->profile?->photo ?? asset('./img/default_user.png')}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->list_keluarga->profile?->nama ?? Auth::user()->no_kk}}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href={{route('profile', Auth::user()->list_keluarga->profile?->id ?? 0)}} class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU HALAMAN</li>
        <li class="{{$page === 'Beranda' ? 'active' : ''}}">
          <a href="{{route('beranda')}}">
            <i class="fa fa-home"></i> <span>Beranda</span>
          </a>
        </li>

        @if (Auth::user()->role === 'warga')
          <li class="{{$page === 'Tambah Surat' ? 'active' : ''}}">
            <a href={{route('tambahSuratPenghantar')}}>
              <i class="fa fa-pencil-square-o"></i> <span>Buat Surat Pengantar</span>
            </a>
          </li>
          <li class="{{$page === 'Surat' ? 'active' : ''}}">
            <a href="{{route('suratPenghantar')}}">
              <i class="fa fa-file-text"></i> <span>Daftar Pengajuan</span>
            </a>
          </li>
          <li class="{{$page === 'Keluarga' ? 'active' : ''}}">
            <a href="{{route('dataKeluarga')}}">
              <i class="fa fa-book"></i> <span>Data Keluarga</span>
            </a>
          </li>
        @endif

        @if (Auth::user()->role === 'rt' || Auth::user()->role === 'rw')

          @if (Auth::user()->role === 'rt')
             <li class="{{$page === 'Registrasi Warga' ? 'active' : ''}}">
              <a href="{{route('registrasiWarga')}}">
                <i class="fa fa-pencil-square-o"></i> <span>Registrasi Warga</span>
              </a>
            </li> 
          @endif

          
          <li class="{{$page === 'List Warga' ? 'active' : ''}}">
            <a href="{{route('listWarga')}}">
              <i class="fa fa-book"></i> <span>Data Warga</span>
            </a>
          </li> 
          <li class="{{$page === 'Surat' ? 'active' : ''}}">
            <a href="{{route('dataPengajuan')}}">
              <i class="fa fa-file-text"></i> <span>Data Pengajuan</span>
            </a>
          </li>      
        @endif

        @if (Auth::user()->role === 'lurah')
          <li class="{{$page === 'Registrasi RT/RW' ? 'active' : ''}}">
            <a href="{{route('registrasiRTRW')}}">
              <i class="fa fa-pencil-square-o"></i> <span>Registrasi Ketua RT RW</span>
            </a>
          </li> 
          <li class="{{$page === 'RT/RW' ? 'active' : ''}}">
            <a href="{{route('listRw')}}">
              <i class="fa fa-book"></i> <span>Data Ketua RT RW</span>
            </a>
          </li> 
          <li class="{{$page === 'Surat' ? 'active' : ''}}">
            <a href="{{route('dataPengajuan')}}">
              <i class="fa fa-file-text"></i> <span>Data Pengajuan</span>
            </a>
          </li> 
          <li class="{{$page === 'Kepentingan' ? 'active' : ''}}">
            <a href="{{route('kepentingan')}}">
              <i class="fa fa-book"></i> <span>Data Kepentingan Surat</span>
            </a>
          </li> 
        @endif
        
        <li>
          <a href={{asset('./document/PanduanAplikasiSuratPenghantar.docx')}} download>
            <i class="fa fa-info-circle "></i> <span>Panduan Aplikasi</span>
          </a>
        </li>
        <li class="{{$page === 'Profile' ? 'active' : ''}}">
          <a href={{route('profile', Auth::user()->list_keluarga->profile?->id ?? 0)}}>
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        <li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> <span>Keluar</span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('page')
      </h1>
    </section>

    <section class="content">
      @yield('content')
    </section>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer footer-customize">
    <div class="row txt-white">
      <div class="col-md-6">
        <h3>Sistem Informasi Layanan Surat Pengantar Kelurahan Bulan, Wonosari, Klaten.</h3>
        <p>Aplikasi yang dapat digunakan dalam membantu masyarakat Bulan dalam membuat surat pengantar / surat keterangan.</p>
      </div>
      <div class="col-md-6">
        <div class="my-20">
          <i class="mr-33 fa fa-phone"></i> <span>0272-5566483</span>
        </div>
        <div class="my-20">
          <i class="mr-33 fa fa-map-marker"></i> <span>Jl. Delanggu-Juwiring, karanganom, pedan, klaten jawa tengah</span>
        </div>
        <div class="my-20">
          <i class="mr-33 fa fa-envelope"></i> <span>kelurahanbulan@gmail.com</span>
        </div>
      </div>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('./dashboard-asset/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('./dashboard-asset/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('./dashboard-asset/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{asset('./dashboard-asset/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('./dashboard-asset/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('./dashboard-asset/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('./dashboard-asset/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('./dashboard-asset/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('./dashboard-asset/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('./dashboard-asset/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('./dashboard-asset/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('./dashboard-asset/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('./dashboard-asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('./dashboard-asset/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('./dashboard-asset/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('./dashboard-asset/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('./dashboard-asset/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('./dashboard-asset/dist/js/demo.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('./dashboard-asset/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('./dashboard-asset/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

@yield('js-add-on')
</body>
</html>
