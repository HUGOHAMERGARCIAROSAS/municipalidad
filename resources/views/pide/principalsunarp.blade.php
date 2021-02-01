<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PIDE | MDVLH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">


<link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css')}}">
    

  <!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
   <style>
#exitoRazonSocial{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}

#alertaRazonSocial{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}

#exitoTitularidad{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}

#alertaTitularidad{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}

#exitoAsientos{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}

#alertaAsientos{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}
#exitoVehiculos{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}

#alertaVehiculos{
  position :relative !important; 
  left: 35% !important;
  text-align:center;
  display:none;
}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" class="nav-link">Home</a>
      </li>
      
      
    </ul>

    

    <!--<form class="form-inline ml-3" style="left: 45px; position: relative;">
    	<div class="input-group input-group-sm">
			<div class="input-group input-group-sm">
			<a href="{{url('/')}}"><button type="button" class="navbar-toggle btn btn-block btn-secondary btn-sm"><i class="fas fa-sign-out-alt fa-1x"></i> Regresar a menu principal</button></a>
			</div>
    	</div>
    </form>-->

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="left: 65px; position: relative;">
      @csrf
      <div class="input-group input-group-sm">
      <div class="input-group input-group-sm">
      <button type="submit" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="navbar-toggle btn btn-block btn-secondary btn-sm"><i class="fas fa-sign-out-alt fa-1x"></i> Cerrar Sesión</button>
      </div>
      </div>
    </form>

    <form class="form-inline ml-6" style="left: 105px; position: relative;">
    	<div class="input-group input-group-sm">
			<div class="input-group input-group-sm">
			<button type="button" class="navbar-toggle btn btn-block btn-secondary btn-sm"><i class="fa fa-search fa-1x"></i> Cambiar Contraseña</button>
			</div>
    	</div>
    </form>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="text-center" style="padding-top: 10px;">
      <img src="{{url('/img/Escudo_Victor_Larco_Herrera.png')}}" alt="Municipalidad de Victor Larco Herrera" class="brand-image elevation-3"
           style="opacity: .8" width="50px" height="75px">
    </div>

    <div class="brand-link">
      <h5 class="text-center">Municipalidad de Victor</h5>
      <h5 class="text-center"> Larco Herrera</h5>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-1 mb-1 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-center">
          <a href="#" class="d-block">{{Auth::user()->per_login}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!--<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('homesunarp')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
            </ul>
          </li>-->
          
          
          <!--<li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-plane"></i>
              <p>
                Aeronave
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sunarp/aeronave/consultar')}}" onclick="event.preventDefault(); 
                document.getElementById('consultar-form').submit();"  class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Consultar</p>
                </a>
                <form id="consultar-form" action="{{url('sunarp/aeronave/consultar')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
              </li>
            </ul>
          </li> -->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Razón Social
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a a href="{{url('sunarp/razonsocial/consultar')}}" onclick="event.preventDefault(); 
                document.getElementById('consultarrazonsocial-form').submit();"  class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Consultar</p>
                </a>
                <form id="consultarrazonsocial-form" action="{{url('sunarp/razonsocial/consultar')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
              </li>
            </ul>
          </li>   

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-credit-card"></i>
              <p>
                Titularidad
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sunarp/titularidad/consultar')}}" onclick="event.preventDefault(); 
                document.getElementById('consultartitularidad-form').submit();"  class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Consultar</p>
                </a>
                <form id="consultartitularidad-form" action="{{url('sunarp/titularidad/consultar')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
              </li>
            </ul>
          </li>  


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Oficinas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sunarp/oficinas/consultar')}}" onclick="event.preventDefault(); 
                document.getElementById('consultaroficinas-form').submit();"  class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Consultar</p>
                </a>
                <form id="consultaroficinas-form" action="{{url('sunarp/oficinas/consultar')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
              </li>
            </ul>
          </li>  


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gavel"></i>
              <p>
                Asientos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sunarp/asientos/consultar')}}" onclick="event.preventDefault(); 
                document.getElementById('consultarasientos-form').submit();"  class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Consultar</p>
                </a>
                <form id="consultarasientos-form" action="{{url('sunarp/asientos/consultar')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
              </li>
            </ul>
          </li> 

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-car"></i>
              <p>
                Vehículos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sunarp/vehiculos/consultar')}}" onclick="event.preventDefault(); 
                document.getElementById('consultarvehiculos-form').submit();"  class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Consultar</p>
                </a>
                <form id="consultarvehiculos-form" action="{{url('sunarp/vehiculos/consultar')}}" method="GET" style="display: none;">
                {{csrf_field()}} 
                </form>
              </li>
            </ul>
          </li>       

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- DashBoard -->
  <div class="content-wrapper">
  	@yield('contenido')
    <!-- Content Header (Page header) -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="https://munivictorlarco.gob.pe/">Municipalidad Distrital de Víctor Larco Herrera</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{asset('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
   if(document.location.hash) $('a[href="'+document.location.hash+'"]').addClass('select');
});
</script>


</body>
</html>
