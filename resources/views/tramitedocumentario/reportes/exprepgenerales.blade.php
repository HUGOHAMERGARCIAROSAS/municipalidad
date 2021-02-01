@extends('layouts.main')
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
                        {{-- {{$pagina}} --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container-fluid card" style="padding-top: 0.5%">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card card-gray card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                        href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                        aria-selected="true">Expedientes Modificados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-one-profile" role="tab"
                                        aria-controls="custom-tabs-one-profile"
                                        aria-selected="false">Expedientes Eliminados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-one-messages" role="tab"
                                        aria-controls="custom-tabs-one-messages"
                                        aria-selected="false">Movimientos Modificados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-one-settings" role="tab"
                                        aria-controls="custom-tabs-one-settings"
                                        aria-selected="false">Movimientos Eliminados</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-one-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-home-tab">
                                        <div class="container-fluid card" style="padding: 1%">
                                            {!! Form::open(['url'=>'#','method'=>'post']) !!}
                                            {!! Form::token() !!}
                                            <div class="card card-gray">
                                                <div class="card-header text-center">
                                                    <h3 class="card-title">Expedientes Modificados</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row" style="padding-bottom: 0.5%;">
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Desde:</label>
                                                            <input type="date" name="finicio"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="finicioEM"/>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Hasta:</label>
                                                            <input type="date" name="ffin"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="ffinEM"/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="obtenerDatosEM();">
                                                                <span class="fa fa-search"></span>
                                                                Buscar
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="reset" class="btn btn-warning btn-sm"><span
                                                                        class="fa fa-brush"></span>
                                                                Limpiar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                            <div class="card card-gray">
                                                <div class="card-header">
                                                    <h3 class="card-title">Resultados de Búsqueda</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="table-responsive" id="resultadosExpM">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-profile-tab">
                                        <div class="container-fluid card" style="padding: 1%">
                                            {!! Form::open(['url'=>'#','method'=>'post']) !!}
                                            {!! Form::token() !!}
                                            <div class="card card-gray">
                                                <div class="card-header text-center">
                                                    <h3 class="card-title">Expedientes Eliminados</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row" style="padding-bottom: 0.5%;">
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Desde:</label>
                                                            <input type="date" name="finicio"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="finicioEE"/>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Hasta:</label>
                                                            <input type="date" name="ffin"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="ffinEE"/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="obtenerDatosEE();"><span
                                                                        class="fa fa-search"></span>
                                                                Buscar
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="reset" class="btn btn-warning btn-sm"><span
                                                                        class="fa fa-brush"></span>
                                                                Limpiar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                            <div class="card card-gray">
                                                <div class="card-header">
                                                    <h3 class="card-title">Resultados de Búsqueda</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="card" id="resultadosExpE">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-messages-tab">
                                        <div class="container-fluid card" style="padding: 1%">
                                            {!! Form::open(['url'=>'#','method'=>'post']) !!}
                                            {!! Form::token() !!}
                                            <div class="card card-gray">
                                                <div class="card-header text-center">
                                                    <h3 class="card-title">Movimientos Modificados</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row" style="padding-bottom: 0.5%;">
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Desde:</label>
                                                            <input type="date" name="finicio"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="finicioMM"/>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Hasta:</label>
                                                            <input type="date" name="ffin"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="ffinMM"/>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label>Área:</label>
                                                            <select class="form-control form-control-sm select2-blue" name="area"
                                                                    id="areaMM">
                                                                <option value="0" selected>Seleccionar Área</option>
                                                                @foreach($areas as $a)
                                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="obtenerDatosMM();"><span
                                                                        class="fa fa-search"></span>
                                                                Buscar
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="reset" class="btn btn-warning btn-sm"><span
                                                                        class="fa fa-brush"></span>
                                                                Limpiar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                            <div class="card card-gray">
                                                <div class="card-header">
                                                    <h3 class="card-title">Resultados de Búsqueda</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="card" id="resultadosMovM">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-settings" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-settings-tab">
                                        <div class="container-fluid card" style="padding: 1%">
                                            {!! Form::open(['url'=>'#','method'=>'post']) !!}
                                            {!! Form::token() !!}
                                            <div class="card card-gray">
                                                <div class="card-header text-center">
                                                    <h3 class="card-title">Movimientos Eliminados</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row" style="padding-bottom: 0.5%;">
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Desde:</label>
                                                            <input type="date" name="finicio"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="finicioME"/>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                                            <label>Hasta:</label>
                                                            <input type="date" name="ffin"
                                                                class="form-control form-control-sm ui-datepicker"
                                                                id="ffinME"/>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label>Área:</label>
                                                            <select class="form-control form-control-sm select2-blue" name="area"
                                                                    id="areaME">
                                                                <option value="0" selected>Seleccionar Área</option>
                                                                @foreach($areas as $a)
                                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                    onclick="obtenerDatosME();"><span
                                                                        class="fa fa-search"></span>
                                                                Buscar
                                                            </button>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                                            <button type="button" class="btn btn-warning btn-sm"><span
                                                                        class="fa fa-brush"></span>
                                                                Limpiar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                            <div class="card card-gray">
                                                <div class="card-header">
                                                    <h3 class="card-title">Resultados de Búsqueda</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="card" id="resultadosMovE">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
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

        function obtenerDatosEM() {
            var finicio = $("#finicioEM").val();
            var ffin = $("#ffinEM").val();
            $.ajax({
                url: "{{url('tramitedocumentario/expmodificados')}}",
                data: {
                    finicio: finicio,
                    ffin: ffin
                },
                dataType: "json",
                type: "get"

            }).done(function (response) {
                var html;
                console.log(response.length);
                if (response.length > 0) {
                    $('#resultadosExpM').empty();
                    html = '<table class="table table-bordered table-striped text-center table-sm" id="tableEM">';
                    html += '<thead class="bg-gray" style="font-size: 14px;">';
                    html += '<th>#</th>';
                    html += '<th>Expediente</th>';
                    html += '<th>Remitente</th>';
                    html += '<th>Asunto</th>';
                    html += '<th>Fecha Registro</th>';
                    html += '<th>Fecha Modifica</th>';
                    html += '<th>Usuario</th>';
                    html += '</thead>';
                    html += '<tbody style="font-size: 12px;">';
                    var i = 1;
                    $.each(response, function (index, element) {
                        //console.log(element);
                        html += '<tr>';
                        html += '<td>' + i + '</td>';
                        html += '<td>' + element.coddocumento + '-' + element.anio + '</td>';
                        html += '<td>' + element.remitente + '</td>';
                        html += '<td>' + element.asunto + '</td>';
                        html += '<td>' + element.fechregistra + ' ' + element.horaregistra + '</td>';
                        html += '<td>' + element.fechmodifica + ' ' + element.horamodifica + '</td>';
                        html += '<td>' + element.usuario_insert + '</td>';
                        html += '</tr>';
                        i = i + 1;
                    });
                    html += '</tbody>';
                    html += '</table>';
                    mostrarExito();
                    $('#resultadosExpM').append(html);
                    $('#tableEM').DataTable({
                        //bFilter: false,
                        //bPaginate: false,
                        //bInfo: false,
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
                } else {
                    mostrarAlerta();
                }
            });
        }

        function obtenerDatosEE() {
            var finicio = $("#finicioEM").val();
            var ffin = $("#ffinEM").val();
            $.ajax({
                url: "{{url('tramitedocumentario/expeliminados')}}",
                data: {
                    finicio: finicio,
                    ffin: ffin
                },
                dataType: "json",
                type: "get"

            }).done(function (response) {
                var html;
                console.log(response.length);
                if (response.length > 0) {
                    console.log("Resultados");
                    $('#resultadosExpE').empty();
                    html = '<table class="table table-bordered table-striped text-center table-sm" id="tableEE">';
                    html += '<thead class="bg-gray" style="font-size: 14px;">';
                    html += '<th>#</th>';
                    html += '<th>Expediente</th>';
                    html += '<th>Remitente</th>';
                    html += '<th>Asunto</th>';
                    html += '<th>Fecha Registro</th>';
                    html += '<th>Fecha Elimina</th>';
                    html += '<th>Usuario</th>';
                    html += '</thead>';
                    html += '<tbody style="font-size: 12px;">';
                    var i = 1;
                    $.each(response, function (index, element) {
                        //console.log(element);
                        html += '<tr>';
                        html += '<td>' + i + '</td>';
                        html += '<td>' + element.coddocumento + '-' + element.anio + '</td>';
                        html += '<td>' + element.remitente + '</td>';
                        html += '<td>' + element.asunto + '</td>';
                        html += '<td>' + element.fechregistra + ' ' + element.horaregistra + '</td>';
                        html += '<td>' + element.fechmodifica + ' ' + element.horamodifica + '</td>';
                        html += '<td>' + element.usuario_delete + '</td>';
                        html += '</tr>';
                        i = i + 1;
                    });
                    html += '</tbody>';
                    html += '</table>';
                    $('#resultadosExpE').append(html);
                    $('#tableEE').DataTable({
                        //bFilter: false,
                        //bPaginate: false,
                        //bInfo: false,
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
                    mostrarExito();
                } else {
                    mostrarAlerta();
                }
            });
        }

        function obtenerDatosMM() {
            var finicio = $("#finicioMM").val();
            var ffin = $("#ffinMM").val();
            var area = $("#areaMM").val();
            $.ajax({
                url: "{{url('tramitedocumentario/movmodificados')}}",
                data: {
                    finicio: finicio,
                    ffin: ffin,
                    area: area
                },
                dataType: "json",
                type: "get"

            }).done(function (response) {
                console.log(finicio);
                console.log(ffin);
                console.log(area);
                var html;
                console.log(response);
                if (response.length > 0) {
                    console.log("Resultados");
                    $('#resultadosMovM').empty();
                    html = '<table class="table table-bordered table-striped text-center table-sm" id="tableMM">';
                    html += '<thead class="bg-gray" style="font-size: 14px;">';
                    html += '<th>#</th>';
                    html += '<th>Expediente</th>';
                    html += '<th>Remitente</th>';
                    html += '<th>Asunto</th>';
                    html += '<th>Oservación</th>';
                    html += '<th>Fecha Registro</th>';
                    html += '<th>Fecha Modifica</th>';
                    html += '<th>Usuario</th>';
                    html += '</thead>';
                    html += '<tbody style="font-size: 12px;">';
                    var i = 1;
                    $.each(response, function (index, element) {
                        //console.log(element);
                        html += '<tr>';
                        html += '<td>' + i + '</td>';
                        html += '<td>' + element.documento_coddocumento + '-' + element.documento_anio + '</td>';
                        html += '<td>' + element.remitente + '</td>';
                        html += '<td>' + element.asunto + '</td>';
                        html += '<td>' + element.observacion + '</td>';
                        html += '<td>' + element.fechregistra + ' ' + element.horaregistra + '</td>';
                        html += '<td>' + element.fechmodifica + ' ' + element.horamodifica + '</td>';
                        html += '<td>' + element.usuario_insert + '</td>';
                        html += '</tr>';
                        i = i + 1;
                    });
                    html += '</tbody>';
                    html += '</table>';
                    $('#resultadosMovM').append(html);
                    $('#tableMM').DataTable({
                        //bFilter: false,
                        //bPaginate: false,
                        //bInfo: false,
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
                    mostrarExito();
                } else {
                    mostrarAlerta();
                }
            });
        }

        function obtenerDatosME() {
            var finicio = $("#finicioME").val();
            var ffin = $("#ffinME").val();
            var area = $("#areaME").val();
            $.ajax({
                url: "{{url('tramitedocumentario/moveliminados')}}",
                data: {
                    finicio: finicio,
                    ffin: ffin,
                    area: area
                },
                dataType: "json",
                type: "get"

            }).done(function (response) {
                console.log(finicio);
                console.log(ffin);
                console.log(area);
                var html;
                console.log(response);
                $('#resultadosMovE').empty();
                if (response.length > 0) {
                    console.log("Resultados");
                    html = '<table class="table table-bordered table-striped text-center table-sm" id="tableME">';
                    html += '<thead class="bg-gray" style="font-size: 14px;">';
                    html += '<th>#</th>';
                    html += '<th>Expediente</th>';
                    html += '<th>Remitente</th>';
                    html += '<th>Asunto</th>';
                    html += '<th>Oservación</th>';
                    html += '<th>Fecha Registro</th>';
                    html += '<th>Fecha Elimina</th>';
                    html += '<th>Usuario</th>';
                    html += '</thead>';
                    html += '<tbody style="font-size: 12px;">';
                    var i = 1;
                    $.each(response, function (index, element) {
                        //console.log(element);
                        html += '<tr>';
                        html += '<td>' + i + '</td>';
                        html += '<td>' + element.documento_coddocumento + '-' + element.documento_anio + '</td>';
                        html += '<td>' + element.remitente + '</td>';
                        html += '<td>' + element.asunto + '</td>';
                        html += '<td>' + element.observacion + '</td>';
                        html += '<td>' + element.fechregistra + ' ' + element.horaregistra + '</td>';
                        html += '<td>' + element.fechmodifica + ' ' + element.horamodifica + '</td>';
                        html += '<td>' + element.usuario_delete + '</td>';
                        html += '</tr>';
                        i = i + 1;
                    });
                    html += '</tbody>';
                    html += '</table>';
                    $('#resultadosMovE').append(html);
                    $('#tableME').DataTable({
                        //bFilter: false,
                        //bPaginate: false,
                        //bInfo: false,
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
                    mostrarExito();
                } else {
                    mostrarAlerta();
                }
            });
        }

    </script>
@endsection

