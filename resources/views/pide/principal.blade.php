<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

<link rel="stylesheet" href="{{asset('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

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
			<button type="button" data-target="#AbrirCambiarContraseña" data-toggle="modal" class=" btn btn-block btn-secondary btn-sm"><i class="fa fa-search fa-1x"></i> Cambiar Contraseña</button>
			</div>
    	</div>
    </form>

    


  </nav>
  <!-- /.navbar -->

  <!--Inicio del modal Buscar Asiento-->
            <div class="modal fade" id="AbrirCambiarContraseña" style="display: none;" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">CAMBIAR CONTRASEÑA</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('home.update','test')}}" id="form" method="post" enctype="multipart/form-data" class="form-horizontal" autocomplete="off">
                      {{csrf_field()}}
                    @include('configuracion.cambiarContraseña.index')
                    </form>
                  </div>
                 <!-- <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>-->
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-5">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset('img/escudo.png')}}" alt="MDVLH Logo" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">WS CONSUMER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-1 pb-1 mb-1 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info text-center">
          <a href="{{url('/')}}" class="d-block">{{ Auth::user()->nombres }}</a>
          <p style="color:white">{{ Auth::user()->usuario }}</p>
          
        </div>
      </div>

      <!-- Sidebar Menu -->
      @if(Auth::check())
            @if (Auth::user()->idrol == 1)
              <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{url('admin/mantenedorPersona')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Personas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('admin/mantenedorUser')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Usuarios
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{url('admin/mantenedorRol')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Roles
              </p>
            </a>
          </li>


          
          

        </ul>
      </nav>  

            @endif

      @endif
      

      
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




<!-- Script -->
<script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js')}}"></script>

<script type="text/javascript">
  /*EDITAR PERSONA EN VENTANA MODAL*/
        $('#abrirmodalEditarPersona').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        /*el button.data es lo que está en el button de editar*/
        var button = $(event.relatedTarget)
        
        
        var tipo_documento_modal_editar = button.data('tipo_documento')
        var documento_modal_editar = button.data('documento')
        var direccion_modal_editar = button.data('direccion')
        var telefono_modal_editar = button.data('telefono')
        var nombres_modal_editar = button.data('nombres')
        var apellidos_modal_editar = button.data('apellidos')
        var fecha_nacimiento_modal_editar = button.data('fecha_nacimiento')
        var idpersona = button.data('idpersona')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        /*los # son los id que se encuentran en el formulario*/
        modal.find('.modal-body #nombres').val(nombres_modal_editar);
        modal.find('.modal-body #fecha_nacimiento').val(fecha_nacimiento_modal_editar);
        modal.find('.modal-body #tipo_documento').val(tipo_documento_modal_editar);
        modal.find('.modal-body #documento').val(documento_modal_editar);
        modal.find('.modal-body #direccion').val(direccion_modal_editar);
        modal.find('.modal-body #telefono').val(telefono_modal_editar);
        modal.find('.modal-body #apellidos').val(apellidos_modal_editar);
        modal.find('.modal-body #idpersona').val(idpersona);
        })
        /*FIN MODAL EDITAR PERSONA*/





     /*INICIO ventana modal para cambiar el estado de la persona*/
        
        $('#cambiarEstado').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        
        var button = $(event.relatedTarget) 
        var idpersona = button.data('idpersona')
        var modal = $(this)
        // modal.find('.modal-title').text('New message to ' + recipient)
        
        modal.find('.modal-body #idpersona').val(idpersona);
        })
         
        /*FIN ventana modal para cambiar estado de la persona*/



        /*EDITAR USUARIO EN VENTANA MODAL*/
        $('#abrirmodalEditar').on('show.bs.modal', function (event) {
        
        //console.log('modal abierto');
        /*el button.data es lo que está en el button de editar*/
        var button = $(event.relatedTarget)
        
        var nombres_modal_editar = button.data('nombres')
        var apellidos_modal_editar = button.data('apellidos')
        var email_modal_editar = button.data('email')
        var usuario_modal_editar = button.data('usuario')
        var idrol_modal_editar = button.data('idrol')
        var idusuario = button.data('idusuario')
        var idpersona = button.data('idpersona')
        var modal = $(this)
        
        // modal.find('.modal-title').text('New message to ' + recipient)
        /*los # son los id que se encuentran en el formulario*/
        modal.find('.modal-body #nombres').val(nombres_modal_editar);
        modal.find('.modal-body #apellidos').val(apellidos_modal_editar);
        modal.find('.modal-body #usuario').val(usuario_modal_editar);
        modal.find('.modal-body #email').val(email_modal_editar);
        modal.find('.modal-body #idrol').val(idrol_modal_editar);
        modal.find('.modal-body #idusuario').val(idusuario);
        modal.find('.modal-body #idpersona').val(idpersona);
        })
        /*FIN EDITAR USUARIO*/


        /*INICIO ventana modal para cambiar el estado del usuario*/
        
        $('#cambiarEstado').on('show.bs.modal', function (event) {
        
        
        var button = $(event.relatedTarget) 
        var idusuario = button.data('idusuario')
        var modal = $(this)
        
        modal.find('.modal-body #idusuario').val(idusuario);
        })
         
        /*FIN ventana modal para cambiar estado del usuario*/
</script>
</body>

</html>
