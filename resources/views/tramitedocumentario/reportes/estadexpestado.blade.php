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
                            {!! Form::open(['url'=>'tramitedocumentario/restadexpest','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row" style="padding-bottom: 0.5%">
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
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Mes</th>
                                                            <th>Ingresados</th>
                                                            <th>Recibidos</th>
                                                            <th>Derivados</th>
                                                            <th>Archivados</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($sumI=0)
                                                        @php($sumR=0)
                                                        @php($sumD=0)
                                                        @php($sumA=0)
                                                        @foreach($expedientes as $i)
                                                            <tr>
                                                                <td>
                                                                    @if($i->Mes==1) Enero @endif
                                                                    @if($i->Mes==2) Febrero @endif
                                                                    @if($i->Mes==3) Marzo @endif
                                                                    @if($i->Mes==4) Abril @endif
                                                                    @if($i->Mes==5) Mayo @endif
                                                                    @if($i->Mes==6) Junio @endif
                                                                    @if($i->Mes==7) Julio @endif
                                                                    @if($i->Mes==8) Agosto @endif
                                                                    @if($i->Mes==9) Setiembre @endif
                                                                    @if($i->Mes==10) Octubre @endif
                                                                    @if($i->Mes==11) Noviembre @endif
                                                                    @if($i->Mes==12) Diciembre @endif
                                                                </td>
                                                                <td id="{{'MI-'.$i->Mes}}">{{$i->Ingresado}}</td>
                                                                <td id="{{'MR-'.$i->Mes}}">{{$i->Recibido}}</td>
                                                                <td id="{{'MD-'.$i->Mes}}">{{$i->Derivado}}</td>
                                                                <td id="{{'MA-'.$i->Mes}}">{{$i->Archivado}}</td>
                                                                <td id="{{'MI-'.$i->Mes}}">{{$i->Ingresado+$i->Recibido+$i->Derivado+$i->Archivado}}</td>
                                                            </tr>
                                                            @php($sumI=$sumI+$i->Ingresado)
                                                            @php($sumR=$sumR+$i->Recibido)
                                                            @php($sumD=$sumD+$i->Derivado)
                                                            @php($sumA=$sumA+$i->Archivado)
                                                        @endforeach
                                                        <tr>
                                                            <td>Total</td>
                                                            <td>{{$sumI}}</td>
                                                            <td>{{$sumR}}</td>
                                                            <td>{{$sumD}}</td>
                                                            <td>{{$sumA}}</td>
                                                            <td>{{$sumI+$sumR+$sumD+$sumA}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>Mes</th>
                                                            <th>Ingresados</th>
                                                            <th>Recibidos</th>
                                                            <th>Derivados</th>
                                                            <th>Archivados</th>
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
        ingresados = [];
        recibidos = [];
        derivados = [];
        archivados = [];
        title = "Esperando búsqueda...";
        if (document.getElementById('title')) {
            title = document.getElementById('title').value;
        }
        for (i = 1; i < 13; i++) {
            idi = "MI-" + i;
            idr = "MR-" + i;
            idd = "MD-" + i;
            ida = "MA-" + i;
            if (document.getElementById(idi)) {
                ingresados[i - 1] = document.getElementById(idi).innerHTML;
            } else {
                ingresados[i - 1] = 0;
            }
            if (document.getElementById(idr)) {
                recibidos[i - 1] = document.getElementById(idr).innerHTML;
            } else {
                recibidos[i - 1] = 0;
            }
            if (document.getElementById(idd)) {
                derivados[i - 1] = document.getElementById(idd).innerHTML;
            } else {
                derivados[i - 1] = 0;
            }
            if (document.getElementById(ida)) {
                archivados[i - 1] = document.getElementById(ida).innerHTML;
            } else {
                archivados[i - 1] = 0;
            }
        }
        console.log(ingresados);
        console.log(recibidos);
        console.log(derivados);
        console.log(archivados);
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Ingresados',
                    data: ingresados,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                    {
                        label: 'Recibidos',
                        data: recibidos,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Derivados',
                        data: derivados,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Archivados',
                        data: archivados,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: title
                }
            }
        });
    </script>
@endsection
