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
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <div class="info-box ">
                                                <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Bandeja de Entrada</span>
                                                    <span class="info-box-number">{{$cant[0]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-secondary"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Bandeja de Personal</span>
                                                    <span class="info-box-number">{{$cant[1]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-warning"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Memorandum</span>
                                                    <span class="info-box-number">{{$cant[2]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-green"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Invitaciones</span>
                                                    <span class="info-box-number">{{$cant[3]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-light"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Recibidos</span>
                                                    <span class="info-box-number">{{$cant[4]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-lightblue"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Pendientes Rpta.</span>
                                                    <span class="info-box-number">{{$cant[5]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-orange"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Archivados</span>
                                                    <span class="info-box-number">{{$cant[6]}}</span>
                                                </div>
                                            </div>
                                            <div class="info-box">
                                                <span class="info-box-icon bg-red"><i class="far fa-envelope"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Eliminados</span>
                                                    <span class="info-box-number">{{$cant[7]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-9 col-sm-9">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Bandeja de Entrada</h3>
                                                </div>
                                                @php($i=1)
                                                <input type="hidden" id="cant" name="cant"
                                                    value="{{count($bandeja)}}">

                                                <div class="card-body">
                                                    <div id="accordion">
                                                        @foreach($bandeja as $b)
                                                        <div class="card card-light">
                                                            <div class="card-header">
                                                                <h4 class="card-title">
                                                                    <input type="hidden" value="{{$b->expediente}}" id="{{"ID".$i}}">
                                                                    <a data-toggle="collapse" data-parent="#accordion" href="{{"#collapse".$i}}" class="collapsed" aria-expanded="false" onclick="{{"detalle($b->coddocumento,$b->anio,$b->idbandeja,$i)"}}" >
                                                                        <span style="font-size:15px;">
                                                                        @if($b->leido==1)
                                                                            <b style="color:#900;">
                                                                        @else
                                                                            <b style="color:#C09;">
                                                                        @endif
                                                                        {{$b->fechadrv." a las ".$b->hora}}</b></span><br/>
                                                                        <p id="{{"Span".$i}}"><span style="font-size:15px;">{{"Expediente ".$b->expediente." Emitido por ".$b->remitente." sobre ".$b->asunto." derivado por ".$b->Are_Descripcion}} </span></p>
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="{{"collapse".$i}}" class="panel-collapse in collapse" style="">
                                                                <div class="card-body" id="{{"Body".$i}}">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php($i++)
                                                        @endforeach
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
    </div>
</div>
@endsection
@section('scripts')
    <script>
        function detalle(exp, anio,bandeja,id) {
            //console.log(expp);
            //console.log(anio);
            //console.log(bandeja);
            $.ajax({
                url: 'detallebandeja',
                data: {'exp': exp, 'anio': anio,'bandeja': bandeja},
                type: 'get',
                success: function (response) {
                    console.log(exp);
                    console.log(anio);
                    console.log(bandeja);
                    cod="Body"+id;
                    document.getElementById(cod).innerHTML = response;
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

        function estado(id,cantidad){
            id = id + 1;
            exp = document.getElementById("ID" + id).value;
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
                    //console.log(id);
                    //console.log(cantidad);
                    cod="Span"+id;
                    //console.log(cod);
                    //console.log(response.substring(0,1));
                    color="";
                    etiqueta="";
                    if(response.substring(0,1)==="R"){
                        color="#3C9";
                    }
                    if(response.substring(0,1)==="D"){
                        color="#0CF";
                    }
                    if(response.substring(0,1)==="A"){
                        color="#906";
                    }
                    etiqueta="<span style='font-size: 12px; color:"+color+" ;'>";
                    etiqueta+=" -->> "+response;
                    etiqueta+="</span>";
                    document.getElementById(cod).innerHTML += etiqueta;
                    //console.log(response);
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
            estado(0,cantidad);
        });
    </script>
@endsection
