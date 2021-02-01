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
                            {!! Form::open(['url'=>'tramitedocumentario/rexppend','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <label>Área:</label>
                                            <select class="form-control form-control-sm select2-blue" name="area" id="areaT">
                                                <option value="" selected>Seleccionar Área</option>
                                                @foreach($areas as $a)
                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Trabajador:</label>
                                            <select class="form-control form-control-sm select2bs4 select2-blue" name="trab" id="personaT"
                                                    style="width: 100%">
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <label>Año:</label>
                                            <select class="form-control form-control-sm select2-blue" name="anio" id="anio">
                                                <option value="" selected>Todos</option>
                                                @foreach($anios as $an)
                                                    <option value="{{$an->anio}}">{{$an->anio}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span>
                                                Buscar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="button" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span>
                                                Limpiar
                                            </button>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                            <button type="button" class="btn btn-default btn-sm"><span class="fa fa-print"></span>
                                                Imprimir
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
                                                @if(isset($expedientes))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Año</th>
                                                            <th>Recibidos sin Archivar x Área</th>
                                                            <th>Derivados sin Recibir x Área</th>
                                                            <th>Derivados x Area por Trabajdor</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($k=1)
                                                        @php($recb=0)
                                                        @php($derv=0)
                                                        @php($pers=0)
                                                        @foreach($expedientes as $i)
                                                            <tr>
                                                                <td>{{$k}}</td>
                                                                <td>{{$i->anio}}</td>
                                                                @if($i->recib>0)
                                                                    <td>{{$i->recib}}</td>
                                                                @else
                                                                    <td>0</td>
                                                                @endif
                                                                @if($i->deriv>0)
                                                                    <td>{{$i->deriv}}</td>
                                                                @else
                                                                    <td>0</td>
                                                                @endif
                                                                @if($i->pers>0)
                                                                    <td>{{$i->pers}}</td>
                                                                @else
                                                                    <td>0</td>
                                                                @endif
                                                            </tr>
                                                            @php($k++)
                                                            @php($recb=$recb+$i->recib)
                                                            @php($derv=$derv+$i->deriv)
                                                            @php($pers=$pers+$i->pers)
                                                        @endforeach
                                                        <tr>
                                                            <td colspan="2">Total</td>
                                                            <td>{{$recb}}</td>
                                                            <td>{{$derv}}</td>
                                                            <td>{{$pers}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Año</th>
                                                            <th>Recibidos sin Archivar x Área</th>
                                                            <th>Derivados sin Recibir x Área</th>
                                                            <th>Derivados x Area por Trabajdor</th>
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
