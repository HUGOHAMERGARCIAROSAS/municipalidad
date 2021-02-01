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
                            {!! Form::open(['url'=>'tramitedocumentario/restadexpmensual','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
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
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Mes</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($suma=0)
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
                                                                <td id="{{'TT-'.$i->Mes}}">{{$i->expe}}</td>
                                                            </tr>
                                                            @php($suma=$suma+$i->expe)
                                                        @endforeach
                                                        <tr>
                                                            <td style="text-align: right;">Total</td>
                                                            <td>{{$suma}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-nowrap">
                                                        <thead>
                                                        <tr>
                                                            <th>Mes</th>
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
        valores = [];
        title = "Esperando búsqueda...";
        if (document.getElementById('title')) {
            title = document.getElementById('title').value;
        }
        for (i = 1; i < 13; i++) {
            idi = "TT-" + i;
            if (document.getElementById(idi)) {
                valores[i - 1] = document.getElementById(idi).innerHTML;
            } else {
                valores[i - 1] = 0;
            }
        }
        console.log(valores);
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                datasets: [{
                    label: 'Expedientes',
                    data: valores,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0
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
