@extends('layouts.main')
@section('style')
<style>
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
                        Busqueda de Razón Social Sunarp
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-11">
                                <div class="form-group">
                                    <label>Razón Social</label>
                                    <input type="text" class="form-control input-sm" id="razon_social" name="razon_social"
                                        placeholder="Ingresa la razón social">
                                </div>
                            </div>
                            <div class="col-sm-1 text-center down-box">
                                <div class="form-group">
                                    <button type="button" onclick="cargarDatos();" class="btn btn-primary btn-sm"><i
                                                class="fa fa-search fa-1x"></i> Buscar
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
                    <!-- Desplegar y contraer contenido -->
                    <div class="card-header">
                        <h2 class="card-title">Lista de Razón Social</h2>
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
                                <div class="table-responsive" id="contenedor_razonsocial">
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
</div>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#alertaRazonSocial").fadeOut(0);
            $("#exitoRazonSocial").fadeOut(0);
            $("#cargando").hide();
            $("#razon_social").keypress(function (e) {
                if (e.which == 13) {
                    $('#contenedor_razonsocial').empty();
                    obtenerDatos();
                }
            });

        });

        function cargarDatos() {
            $('#contenedor_razonsocial').empty();
            obtenerDatos();
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

        function obtenerDatos() {
            $("#cargando").show();
            $("#listo").hide();
            var razon_social = $("#razon_social").val();
            console.log(razon_social);

            $.ajax({
                url: "{{url('pide/sunarp/razonsocial/consultar/show')}}",
                data: {
                    razon_social: razon_social
                },
                dataType: "json",
                type: "get",

            })

                .done(function (response) {
                    var html;
                    $('#contenedor_razonsocial').empty();
                    $.each(response, function (index, element) {
                        if (element.personaJuridica == null) {
                            $("#cargando").hide();
                            mostrarAlerta();
                        } else {
                            var len = element.personaJuridica.resultado.length;
                            console.log(len);
                            html = '<table class="table table-bordered table-striped  text-center" id="datarazonsocial">';
                            html += '<thead class="bg-gray" style="font-size: 14px">';
                            html += '<th style="vertical-align:middle;">#</th>';
                            html += '<th style="vertical-align:middle;">DENOMINACIÓN</th>';
                            html += '<th style="vertical-align:middle;">N° DE FICHA</th>';
                            html += '<th style="vertical-align:middle;">FOLIO</th>';
                            html += '<th style="vertical-align:middle;">OFICINA</th>';
                            html += '<th style="vertical-align:middle;">N° DE PARTIDA</th>';
                            html += '<th style="vertical-align:middle;">TIPO</th>';
                            html += '<th style="vertical-align:middle;">TOMO</th>';
                            html += '<th style="vertical-align:middle;">ZONA</th>';
                            html += '</thead> ';
                            for (var i = 0; i < len; i++) {
                                var aux = 1 + i;
                                html += '<tr style="font-size: 12px">';
                                html += '<td>' + aux + '</td>';
                                if (element.personaJuridica.resultado[i].denominacion == null) {
                                    html += '<td></td>';
                                } else {
                                    html += '<td>' + element.personaJuridica.resultado[i].denominacion + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].ficha == null) {
                                    html += '<td></td>';
                                }
                                else {
                                    html += '<td>' + element.personaJuridica.resultado[i].ficha + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].folio == null) {
                                    html += '<td></td>';
                                } else {
                                    html += '<td>' + element.personaJuridica.resultado[i].folio + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].oficina == null) {
                                    html += '<td></td>';
                                } else {
                                    html += '<td>' + element.personaJuridica.resultado[i].oficina + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].partida == null) {
                                    html += '<td></td>';
                                }
                                else {
                                    html += '<td>' + element.personaJuridica.resultado[i].partida + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].tipo == null) {
                                    html += '<td></td>';
                                } else {
                                    html += '<td>' + element.personaJuridica.resultado[i].tipo + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].tomo == null) {
                                    html += '<td></td>';
                                }
                                else {
                                    html += '<td>' + element.personaJuridica.resultado[i].tomo + '</td>';
                                }
                                if (element.personaJuridica.resultado[i].zona == null) {
                                    html += '<td></td>';
                                } else {
                                    html += '<td>' + element.personaJuridica.resultado[i].zona + '</td>';
                                }

                                html += '</tr>';

                                console.log(element.personaJuridica.resultado[i].tipo)

                            }
                            html += '</table>';
                            $('#contenedor_razonsocial').append(html);
                            $("#cargando").hide();
                            $("#listo").show();
                            console.log(element);
                            var text = "Existen: ";
                            var text2 = " en total";
                            var textonuevo = text + len + text2
                            console.log(textonuevo);
                            $('#lblexisten').val("textonuevo");
                            $("#lblexisten").html(textonuevo);
                            mostrarExito();
                            $('#datarazonsocial').DataTable({
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
                        }

                    });
                });
            5
        }
    </script>
@endsection
