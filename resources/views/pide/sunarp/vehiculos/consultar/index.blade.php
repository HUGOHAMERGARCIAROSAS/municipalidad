@extends('layouts.main')
@section('style')
    <style>
        #exitoRazonSocial {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #alertaRazonSocial {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #exitoTitularidad {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #alertaTitularidad {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #exitoAsientos {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #alertaAsientos {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #exitoVehiculos {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        #alertaVehiculos {
            position: relative !important;
            left: 35% !important;
            text-align: center;
            display: none;
        }

        .down-box{
            margin-top: 2.3%!important;
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
                        Busqueda de Vehículos Sunarp
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group-sm">
                                    <label>Oficina</label>
                                    <select class="form-control input-sm" name="oficina" id="oficina">
                                        <option value="0">Seleccione</option>
                                        @foreach($oficinas as $of)
                                            <option value="{{$of['codZona']}} {{$of['codOficina']}}">{{$of['descripcion']}}
                                                - {{$of['codZona']}} - {{$of['codOficina']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group-sm">
                                    <label>Nro de Placa</label>
                                    <input type="text" class="form-control input-sm" id="numero_placa"
                                        placeholder="Ingresa una placa">
                                </div>
                            </div>
                            <div class="col-sm-1 text-center down-box">
                                <div class="form-group-sm">
                                    <button class="btn btn-primary btn-sm" type="button" onclick="cargar();"><span
                                                class="fa fa-search"></span> Buscar
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center down-box">
                                <div class="form-group-sm">
                                    <button type="button" class="btn btn-block btn-default btn-sm" id="imprimir"
                                            data-href="{{url('/pide/sunarp/vehiculos/imprimir')}}" onclick="imprimir();">
                                        <i class="fa fa-print"></i> Imprimir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Propietarios y Vehículos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cargandoVehiculo" class="text-center">
                                    <img width="200"
                                        src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}"/>
                                    <p>
                                        Cargando contenido
                                    </p>
                                </div>

                                <div class="table-responsive" id="contenedor_vehiculo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cargando" class="text-center">
                                    <img width="200"
                                        src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}"/>
                                    <p>
                                        Cargando contenido
                                    </p>
                                </div>

                                <div class="table-responsive" id="contenedor_propietarios">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </section>

    </div>
</div>

<!--Inicio del modal Buscar Titular-->
<div class="modal fade" id="AbrirBuscarTitular" style="overflow-y: scroll;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CONSULTAR TITULARIDAD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('pide.sunarp.vehiculos.consultar.consultarTitularidad')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal-->

<!--Inicio del modal Buscar Asiento-->
<div class="modal fade" id="AbrirBuscarAsiento" style="z-index: 1600;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CONSULTAR ASIENTOS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('pide.sunarp.vehiculos.consultar.consultarAsientos')
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Fin del modal-->

@endsection
@section('scripts')
    <script type="text/javascript">
        function imprimir() {
            var codZona;
            var codOficina;
            var selected = $('#oficina option:selected');
            oficina = selected.val();
            var separa = oficina.split(" ");
            codZona = separa[0];
            codOficina = separa[1];
            var placa = document.getElementById('numero_placa').value;
            var href = $("#imprimir").data('href');
            var url;
            url = href + "?codZona=" + codZona + "&codOficina=" + codOficina + "&numero_placa=" + placa;
            w = window.open(url);
            w.document.close(); // necessary for IE >= 10
            w.focus(); // necessary for IE >= 10
            return true;
        }

        $("#cargando").hide();
        $("#cargandoVehiculo").hide();
        var oficina;
        var numero_placa;
        var codZona;
        var codOficina;

        $("#numero_placa").keypress(function (e) {
            if (e.which == 13) {
                $('#contenedor_propietarios').empty();
                $('#contenedor_vehiculo').empty();

                numero_placa = $("#numero_placa").val();
                $("#cargando").show();

                $("#listo").hide();
                console.log(numero_placa);
                var selected = $('#oficina option:selected');
                oficina = selected.val();
                var separa = oficina.split(" ");
                codZona = separa[0];
                codOficina = separa[1];
                console.log(codZona);
                console.log(codOficina);
                cargarAjax();
            }
        });

        function cargar() {
            $('#contenedor_propietarios').empty();
            $('#contenedor_vehiculo').empty();

            numero_placa = $("#numero_placa").val();
            $("#cargando").show();

            $("#listo").hide();
            console.log(numero_placa);
            var selected = $('#oficina option:selected');
            oficina = selected.val();
            var separa = oficina.split(" ");
            codZona = separa[0];
            codOficina = separa[1];
            console.log(codZona);
            console.log(codOficina);
            cargarAjax();
        }

        function mostrarAlerta() {
            $("#cargando").hide();
            var alert = "No se encontraron datos.";
            var options = {
                style: {
                    main: {
                        background: "red",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        }

        function mostrarExito() {
            $("#cargando").hide();
            var alert = "Datos encontrados satisfactoriamente";
            var options = {
                style: {
                    main: {
                        background: "green",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        }

        $('#AbrirBuscarTitular').on('show.bs.modal', function (event) {


        });

        $('#AbrirBuscarTitular').on('hide.bs.modal', function (event) {


        });

        function cargarAjax() {
            if (oficina == null) {
                alert("Selecciona una oficina");
                $("#cargando").hide();
                $("#cargandoVehiculo").hide();

            }
            else if (oficina == 0) {
                alert("Recuerda que debes seleccionar una oficina");
                $("#cargando").hide();
                $("#cargandoVehiculo").hide();

            } else {
                $.ajax({
                    url: "{{url('pide/sunarp/vehiculos/consultar/show')}}",
                    data: {
                        codZona: codZona,
                        codOficina: codOficina,
                        numero_placa: numero_placa
                    },
                    dataType: "json",
                    type: "get",

                })
                    .done(function (response) {
                        console.log("respuesta", response);
                        var htmlPropietarios;
                        var htmVehiculo;
                        var nombre;
                        var materno;
                        var paterno;
                        $('#contenedor_propietarios').empty();
                        $('#contenedor_vehiculo').empty();
                        $.each(response, function (index, element) {

                            if (element.verDetalleRPVResponse.vehiculo.placa == null) {
                                mostrarAlerta();
                            }
                            else {
                                htmVehiculo = '<table class="table table-bordered table-striped  text-center">';
                                htmVehiculo += '<thead class="bg-gray" style="font-size: 14px">';
                                htmVehiculo += '<th>#</th>';
                                htmVehiculo += '<th>PLACA</th>';
                                htmVehiculo += '<th>SERIE</th>';
                                htmVehiculo += '<th>VIN</th>';
                                htmVehiculo += '<th>NRO. MOTOR</th>';
                                htmVehiculo += '<th>COLOR</th>';
                                htmVehiculo += '<th>MARCA</th>';
                                htmVehiculo += '<th>MODELO</th>';
                                htmVehiculo += '<th>ESTADO</th>';
                                htmVehiculo += '<th>SEDE</th>';

                                htmVehiculo += '</thead> ';
                                htmVehiculo += '<tr style="font-size: 12px">';
                                htmVehiculo += '<td>1</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.placa + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.serie + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.vin + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.nro_motor + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.color + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.marca + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.modelo + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.estado + '</td>';
                                htmVehiculo += '<td>' + element.verDetalleRPVResponse.vehiculo.sede + '</td>';
                                htmVehiculo += '</tr>';
                                htmVehiculo += '</table>';
                                $('#contenedor_vehiculo').append(htmVehiculo);
                                $("#cargandoVehiculo").hide();
                                $("#listo").show();


                                var cant_propietarios = element.verDetalleRPVResponse.vehiculo.propietarios.nombre[0].length;
                                htmlPropietarios = '<table class="table table-bordered table-striped  text-center" id="datapropietario">';
                                htmlPropietarios += '<thead class="bg-gray" style="font-size: 14px">';
                                htmlPropietarios += '<th>#</th>';
                                htmlPropietarios += '<th>ACCION</th>';
                                htmlPropietarios += '<th>NOMBRE</th>';
                                htmlPropietarios += '</thead> ';
                                if (cant_propietarios > 1) {
                                    var len = element.verDetalleRPVResponse.vehiculo.propietarios.nombre.length;
                                    console.log("Hay mas de un titular");
                                    for (var i = 0; i < len; i++) {
                                        var aux = 1 + i;
                                        var separa = element.verDetalleRPVResponse.vehiculo.propietarios.nombre[i].split(" ");
                                        console.log("Separa: ", separa);
                                        console.log("Longitud: ", separa.length);
                                        if (separa.length == 5) {
                                            nombre = separa[0] + " " + separa[1];
                                            paterno = separa[2];
                                            materno = separa[3] + " " + separa[4];
                                        }
                                        else if (separa.length == 4) {
                                            nombre = separa[0] + " " + separa[1];
                                            paterno = separa[2];
                                            materno = separa[3];
                                            console.log("nombres: ", nombre);
                                            console.log("paterno: ", paterno);
                                            console.log("materno: ", materno);
                                        } else if (separa.length == 3) {
                                            nombre = separa[0];
                                            paterno = separa[1];
                                            materno = separa[2];
                                            console.log("nombres: ", nombre);
                                            console.log("paterno: ", paterno);
                                            console.log("materno: ", materno);
                                        }
                                        //var razon_social=nombre+" "+paterno+" "+materno;
                                        htmlPropietarios += '<tr style="font-size: 12px">';
                                        htmlPropietarios += '<td>' + aux + '</td>';
                                        htmlPropietarios += '<td><button type="button" class="btn btn-warning btn-md" data-nombres_persona="' + nombre + '" data-apellido_paterno_persona="' + paterno + '" data-apellido_materno_persona="' + materno + '" data-razon_social="' + element.verDetalleRPVResponse.vehiculo.propietarios.nombre[i] + '" data-toggle="modal" data-target="#AbrirBuscarTitular"> <i class="fa fa-eye"></i> Ver titularidad </button></td>';
                                        if (element.verDetalleRPVResponse.vehiculo.propietarios.nombre[i] == null) {
                                            htmlPropietarios += '<td></td>';
                                        } else {
                                            htmlPropietarios += '<td>' + element.verDetalleRPVResponse.vehiculo.propietarios.nombre[i] + '</td>';
                                        }
                                        htmlPropietarios += '</tr>';
                                    }


                                } else {
                                    console.log("Solo es un titular");
                                    var separa = element.verDetalleRPVResponse.vehiculo.propietarios.nombre.split(" ");
                                    console.log("Separa: ", separa);
                                    console.log("Longitud: ", separa.length);
                                    if (separa.length == 5) {
                                        nombre = separa[0] + " " + separa[1];
                                        paterno = separa[2];
                                        materno = separa[3] + " " + separa[4];
                                    }
                                    else if (separa.length == 4) {
                                        nombre = separa[0] + " " + separa[1];
                                        paterno = separa[2];
                                        materno = separa[3];
                                        console.log("nombres: ", nombre);
                                        console.log("paterno: ", paterno);
                                        console.log("materno: ", materno);
                                    } else if (separa.length == 3) {
                                        nombre = separa[0];
                                        paterno = separa[1];
                                        materno = separa[2];
                                        console.log("nombres: ", nombre);
                                        console.log("paterno: ", paterno);
                                        console.log("materno: ", materno);
                                    }
                                    //var razon_social=nombre+" "+paterno+" "+materno;
                                    htmlPropietarios += '<tr style="font-size: 12px">';
                                    htmlPropietarios += '<td>1</td>';
                                    htmlPropietarios += '<td><button type="button" class="btn btn-warning btn-sm" data-nombres_persona="' + nombre + '" data-apellido_paterno_persona="' + paterno + '" data-apellido_materno_persona="' + materno + '" data-razon_social="' + element.verDetalleRPVResponse.vehiculo.propietarios.nombre + '" data-toggle="modal" data-target="#AbrirBuscarTitular"> <i class="fa fa-eye"></i> Ver titularidad </button></td>';
                                    htmlPropietarios += '<td>' + element.verDetalleRPVResponse.vehiculo.propietarios.nombre + '</td>';
                                    htmlPropietarios += '</tr>';

                                }
                                htmlPropietarios += '</table>';
                                $('#contenedor_propietarios').append(htmlPropietarios);
                                $("#cargando").hide();
                                $("#listo").show();
                                mostrarExito();
                            }

                            $('#datapropietario').DataTable({
                                language: {
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "zeroRecords": "No se encontraron resultados",
                                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "sSearch": "Buscar:",
                                    "oPaginate": {
                                        "sFirst": "Primero",
                                        "sLast": "Último",
                                        "sNext": "Siguiente",
                                        "sPrevious": "Anterior"
                                    },
                                    "sProcessing": "Procesando...",
                                }
                            });

                        });
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {

                        alert("error");
                    });
            }

        }

        $('#AbrirBuscarTitular').on('show.bs.modal', function (event) {

            //console.log('modal abierto');
            /*el button.data es lo que está en el button de editar*/
            var button = $(event.relatedTarget)
            var nombres_persona_modal_editar = button.data('nombres_persona')
            var apellido_paterno_persona_modal_editar = button.data('apellido_paterno_persona')
            var apellido_materno_persona_modal_editar = button.data('apellido_materno_persona')
            var razon_social_juridica_modal_editar = button.data('razon_social');
            var modal = $(this)
            // modal.find('.modal-title').text('New message to ' + recipient)
            /*los # son los id que se encuentran en el formulario*/
            modal.find('.modal-body #nombres_persona').val(nombres_persona_modal_editar);
            modal.find('.modal-body #apellido_paterno_persona').val(apellido_paterno_persona_modal_editar);
            modal.find('.modal-body #apellido_materno_persona').val(apellido_materno_persona_modal_editar);
            modal.find('.modal-body #razon_social').val(razon_social_juridica_modal_editar);
        });
    </script>
    <script>
        $('#AbrirBuscarTitular').appendTo("body").modal('show');
        </script>
@endsection
