@extends('layouts.main')
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
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-keypad" style="color: #3f6ad8"></i>
                    </div>
                    <div>
                        Lista de Oficinas
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table  text-center" id="dataoficinas">
                                    {{-- <table class="table table-borderless  text-center" id="dataoficinas"> --}}
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
                </div>
            </div>
        </section>
    </div>
</div>

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
