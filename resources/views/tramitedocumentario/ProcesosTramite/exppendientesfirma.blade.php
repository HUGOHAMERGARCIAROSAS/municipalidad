@extends('layout.index3')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="container-fluid card" style="padding: 1%">
                        {!! Form::open(['url'=>'tramitedocumentario/expedientes','method'=>'GET']) !!}
                        {!! Form::token() !!}
                        <div class="card card-gray">
                            <div class="card-header text-center">
                                <h3 class="card-title">{{$pagina}}</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label>Expediente:</label>
                                        <input type="text" name="expediente" class="form-control input-lg"
                                               placeholder="Expediente" value="{{old('expediente')}}"/>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label>Año:</label>
                                        <input type="text" name="anio" class="form-control input-lg" placeholder="Año"
                                               value="2020"/>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label>Interesado:</label>
                                        <input type="text" name="interesado" class="form-control input-lg"
                                               placeholder="Interesado" value="{{old('interesado')}}"/>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <label>Asunto:</label>
                                        <input type="text" name="asunto" class="form-control input-lg"
                                               placeholder="Asunto" value="{{old('asunto')}}"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <label>Área:</label>
                                        <select class="form-control  select2-blue" name="area" id="modulo1">
                                            <option value="" selected>Seleccionar Área</option>
                                            @foreach($areas as $a)
                                                <option value="{{$a->valor}}">{{$a->texto}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                        <button type="submit" class="btn btn-primary btn-sm"><span
                                                    class="fa fa-search"></span> Buscar
                                        </button>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                        <button type="button" class="btn btn-success btn-sm"><span
                                                    class="fa fa-file"></span> Nuevo
                                        </button>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                        <button type="button" class="btn btn-warning btn-sm"><span
                                                    class="fa fa-search"></span> Limpiar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        @if(isset($expedientes))
                            <table class="table table-hover text-nowrap text-center table-responsive">
                                <thead>
                                <tr style="font-size: 14px">
                                    <th>Expediente</th>
                                    <th>Fecha Derivado</th>
                                    <th>Remitente</th>
                                    <th>Asunto</th>
                                    <th>Estado Expediente</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=1)
                                <input type="hidden" id="cant" name="cant" value="{{count($expedientes)}}">
                                @foreach($expedientes as $e)

                                    @if($e->idinforme!="")
                                        <tr class="table-danger"
                                            style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                    @else
                                        <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                            @endif
                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;"
                                                id="ID{{$i}}">{{$e->expediente}}</td>
                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->fechadrv}}</td>
                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->remitente}}</td>
                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->asunto}}</td>
                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;"
                                                id="{{$e->expediente}}"></td>
                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                @include('tramitedocumentario.ProcesosTramite.recibirexpediente')
                                                <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="{{"#modal-recibir-".$e->coddocumento}}"
                                                        title="recibir"><span class="fa fa-edit"></span></button>
                                                {!! Form::open(['url'=>'tramitedocumentario/seguimiento','method'=>'POST','style'=>'display: inline;']) !!}
                                                {!! Form::token() !!}
                                                <input type="hidden" name="exped" value="{{$e->coddocumento}}">
                                                <input type="hidden" name="anio" value="{{$e->anio}}">
                                                <button type="submit" class="btn btn-default btn-sm" title="Detalles">
                                                    <span class="fa fa-download"></span></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                        @php($i++)

                                        @endforeach
                                </tbody>
                            </table>
                            <div class="row" style="text-align: center;">
                                <div class="col-lg-4 col-md-4 col-sm-4" style="margin-left: auto; margin-right: auto">
                                    {{$expedientes->appends(request()->input())->links()}}
                                </div>
                            </div>
                        @else
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Expediente</th>
                                    <th>Fecha Derivado</th>
                                    <th>Remitente</th>
                                    <th>Asunto</th>
                                    <th>Estado Expediente</th>
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
@endsection
@section('scripts')
    <script>
        function estado(id, cantidad) {
            id = id + 1;
            //console.log(id);
            exp = document.getElementById("ID" + id).innerHTML;
            est = document.getElementById(exp).innerHTML;
            //console.log(est);
            var cadena = exp.split("-");
            expp = cadena[0].trim();
            anio = cadena[1].trim();
            //console.log(expp);
            //console.log(anio);
            $.ajax({
                url: 'exppendientes/estado',
                data: {'exp': expp, 'anio': anio},
                type: 'get',
                success: function (response) {
                    console.log(id);
                    console.log(exp);
                    console.log(response);
                    document.getElementById(exp).innerHTML = response;
                    if (id < cantidad) {
                        estado(id, cantidad);
                    }
                },
                statusCode: {
                    404: function () {
                        console.log('web not found');
                    }
                },
                error: function (x, xs, xt) {
                    //nos dara el error si es que hay alguno
                    //window.open(JSON.stringify(x));
                    console.log(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        }

        $(document).ready(function () {
            cantidad = document.getElementById("cant").value;
            i = 0;
            estado(i, cantidad);
        });
    </script>
@endsection
