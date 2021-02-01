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
                            {!! Form::open(['url'=>'tramitedocumentario/restadexparea','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Área:</label>
                                            <select class="form-control form-control-sm select2-blue" name="area" id="areaT">
                                                <option value="" selected>Seleccionar Área</option>
                                                @foreach($areas as $a)
                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <label>Año:</label>
                                            <select class="form-control form-control-sm select2-blue" name="anio" id="anio">
                                                @foreach($anios as $an)
                                                    <option value="{{$an->anio}}">{{$an->anio}}</option>
                                                @endforeach
                                            </select>
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
                                                    <table class="table table-hover text-center table-sm" id="tableT">
                                                        <thead>
                                                        <tr>
                                                            <th>Tipo de Trámite</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($suma=0)
                                                        @php($k=1)
                                                        @foreach($expedientes as $i)
                                                            <tr>
                                                                <td id="{{'TD-'.$k}}">{{$i->tptra_descripcion}}</td>
                                                                <td id="{{'TT-'.$k}}">{{$i->total}}</td>
                                                            </tr>
                                                            @php($suma=$suma+$i->total)
                                                            @php($k++)
                                                        @endforeach
                                                        <tr>
                                                            <td style="text-align: right;">Total</td>
                                                            <td>{{$suma}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-nowrap" id="tableT">
                                                        <thead>
                                                        <tr>
                                                            <th>Tipo de Trámite</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                @endif
                                                <canvas id="myChart" width="400px" height="110px"></canvas>
                                                @if(isset($title)) <input type="hidden" value="{{$title}}"
                                                                        id="title"> @endif
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
        var ctx = document.getElementById('myChart').getContext('2d');
        var rows = document.getElementById('tableT').getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
        etiquetas = [];
        valores = [];
        title = "Esperando búsqueda...";
        if (document.getElementById('title')) {
            title = document.getElementById('title').value;
        }
        colores = [];

        var dynamicColors = function () {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };
        for (i = 1; i < rows; i++) {
            idi = "TD-" + i;
            idr = "TT-" + i;
            if (document.getElementById(idi)) {
                etiquetas[i - 1] = document.getElementById(idi).innerHTML;
            }
            if (document.getElementById(idr)) {
                valores[i - 1] = document.getElementById(idr).innerHTML;
            }
            colores.push(dynamicColors());
        }

        console.log(etiquetas);
        console.log(valores);
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: etiquetas,
                datasets: [{
                    data: valores,
                    backgroundColor: colores
                }]
            },
            options: {
                title: {
                    display: true,
                    text: title
                }
            }
        });
    </script>
@endsection
