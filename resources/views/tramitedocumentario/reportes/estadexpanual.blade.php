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
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="card">
                                                @if(isset($expedientes))
                                                    <table class="table table-hover text-center table-sm" id="tableT">
                                                        <thead>
                                                        <tr>
                                                            <th>Año</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($suma=0)
                                                        @php($k=1)
                                                        @foreach($expedientes as $i)
                                                            <tr>
                                                                <td id="{{'TD-'.$k}}">{{$i->anio}}</td>
                                                                <td id="{{'TT-'.$k}}">{{$i->expe}}</td>
                                                            </tr>
                                                            @php($suma=$suma+$i->expe)
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
                                                            <th>Año</th>
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
