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
                        {{$pagina}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="container-fluid card" style="padding: 1%">
                            {!! Form::open(['url'=>'tramitedocumentario/gestionexpedientes','method'=>'GET']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <label>Expediente:</label>
                                            <input type="text" name="expediente" class="form-control form-control-sm"
                                                placeholder="Expediente" value="{{old('expediente')}}"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <label>Año:</label>
                                            <input type="text" name="anio" class="form-control form-control-sm" placeholder="Año"
                                                value="2020"/>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <button type="reset" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span>
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
                                            <div class="card">
                                                @if(isset($expediente))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Expediente</th>
                                                            <th>Interesado</th>
                                                            <th>Asunto</th>
                                                            <th>Folios</th>
                                                            <th>Estado</th>
                                                            <th>Área</th>
                                                            <th>Observación Registrada</th>
                                                            <th>Fecha</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($expediente as $e)
                                                            <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->numero}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->remitente}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->asunto}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->folios}}</td>
                                                                @if($e->arderiva!="" && $e->trabderiva!="")
                                                                    @php($vaa=" a ".$e->arderiva." que atienda ".$e->trabderiva)
                                                                @else
                                                                    @if($e->arderiva!="")
                                                                        @php($vaa=" a ".$e->arderiva)
                                                                    @else
                                                                        @php($vaa="")
                                                                    @endif
                                                                @endif
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->estadodocs."".$vaa}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->are_descripcion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->observacion}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->fecha." ".$e->hora}}</td>
                                                                <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                                    @include('tramitedocumentario.ProcesosTramite.recibirexpediente')
                                                                    <button type="button" class="btn btn-default btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="{{"#modal-recibir-".$e->coddocumento}}"
                                                                            title="Recibir"><span
                                                                                class="fa fa-thumbs-up"></span></button>
                                                                    @include('tramitedocumentario.ProcesosTramite.derivarexpediente')
                                                                    <button type="button" class="btn btn-default btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="{{"#modal-derivar-".$e->coddocumento}}"
                                                                            title="Derivar"><span
                                                                                class="fa fa-arrow-right"></span></button>
                                                                    @include('tramitedocumentario.ProcesosTramite.archivarexpediente')
                                                                    <button type="button" class="btn btn-default btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="{{"#modal-archivar-".$e->coddocumento}}"
                                                                            title="Archivar"><span
                                                                                class="fa fa-archive"></span></button>
                                                                    @include('tramitedocumentario.ProcesosTramite.proveerexpediente')
                                                                    <button type="button" class="btn btn-default btn-sm"
                                                                            data-toggle="modal"
                                                                            data-target="{{"#modal-proveer-".$e->coddocumento}}"
                                                                            title="Proveer"><span class="fa fa-file"></span>
                                                                    </button>
                                                                    <button type="button"
                                                                            onclick="{{"Printt(".$e->coddocumento.",".$e->anio.")"}}"
                                                                            class="btn btn-default btn-sm"
                                                                            title="Codigo de Barras"><span
                                                                                class="fa fa-barcode"></span></button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Expediente</th>
                                                            <th>Interesado</th>
                                                            <th>Asunto</th>
                                                            <th>Folios</th>
                                                            <th>Estado</th>
                                                            <th>Área</th>
                                                            <th>Observación Registrada</th>
                                                            <th>Fecha</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        function Printt(expe, annn) {
            window.open("expedientes/verbarcode?exped=" + expe + "&anio=" + annn, "", "width=350,height=180,menubar=yes,scrollbars=no");
        }

        function ConfirmarAnular(exped) {
            var id = "Aexped" + exped;
            console.log(id);
            form = document.getElementById(id);
            var opcion = confirm("¿Está seguro de anular el expediente?");
            if (opcion == true) {
                form.submit();
            }
        }

        $("#personaT").select2({
            minimumInputLength: 3,
            language: {
                inputTooShort: function (args) {
                    // args.minimum is the minimum required length
                    // args.input is the user-typed text
                    return "Escribe al menos 3 caracteres";
                },
                inputTooLong: function (args) {
                    // args.maximum is the maximum allowed length
                    // args.input is the user-typed text
                    return "Demasiados caracteres";
                },
                errorLoading: function () {
                    return "Error cargando los resultados";
                },
                loadingMore: function () {
                    return "Cargando más resultados";
                },
                noResults: function () {
                    return "Sin resultados";
                },
                searching: function () {
                    return "Buscando...";
                },
                maximumSelected: function (args) {
                    // args.maximum is the maximum number of items the user may select
                    return "Error loading results";
                }
            },
            ajax: {
                url: "{{url('/administracion/usuarios/buscar_trababajadores_area')}}",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log(params.term);
                    return {
                        search: params.term,
                        area: document.getElementById("areaT").value// search term

                    };
                },
                processResults: function (response) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    console.log(response);
                    return {
                        results: response
                        //results: data.items
                    };
                },
                cache: true
            }

        });
    </script>
@endsection
