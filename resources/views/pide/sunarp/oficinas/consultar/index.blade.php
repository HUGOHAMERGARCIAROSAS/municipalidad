@extends('layout.index3')
@section('style')
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
@endsection
@section('content')
<div class="content-header">
      <div class="container-fluid">
      </div><!-- /.container-fluid -->
</div>


          <!-- /.Fin de desplegar y contraer contenido -->
<section class="content">
<div class="container-fluid">
<div class="card card-gray">
    <!-- Desplegar y contraer contenido -->
          <div class="card-header">
            <h2 class="card-title">Lista de Oficinas</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>

 <div class="card-body">
  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
      <table class="table table-borderless  text-center" id="dataoficinas">
        <thead class="bg-gray" style="font-size: 14px">
          <th>#</th>
                  <th>COD OFICINA</th>
                  <th>COD ZONA</th>
                  <th>DESCRIPCION</th>
                  
        </thead>
@php
$aux=0; 
@endphp
        @foreach($oficinas['oficina']['oficina'] as $of)  
@php


$aux=$aux+1; 
@endphp   
        <tr style="font-size: 12px">
                  <td>{{$aux}}</td>
                  <td>{{$of['codOficina']}}</td>
                  <td>{{$of['codZona']}}</td>
                  <td>{{$of['descripcion']}}</td>
         
        </tr>
        @endforeach
            </table>
    </div>
    
  </div>
  </div>
 </div>
 <!-- /.card -->
</div>
</div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    $('#dataoficinas').DataTable({
        scrollY: "45vh",
        language: {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast":"Último",
            "sNext":"Siguiente",
            "sPrevious": "Anterior"
         },
         "sProcessing":"Procesando...",
          }
    });
  });
</script>



@endsection