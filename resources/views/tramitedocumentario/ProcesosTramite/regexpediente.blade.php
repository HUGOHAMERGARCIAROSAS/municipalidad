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
                            @if(isset($virtual))
                                {!! Form::open(['url'=>'tramitedocumentario/expediente/registrarv','method'=>'post']) !!}
                            @else
                                {!! Form::open(['url'=>'tramitedocumentario/expediente/registrar','method'=>'post']) !!}
                            @endif
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Fecha</label>
                                        </div>
                                        <div class=" col-lg-3 col-md-3 col-sm-3">
                                            <p><span class="fa fa-calendar-day"></span> {{$fecha}} <span
                                                        class="fa fa-clock"></span> {{$hora[0]->hora}}</p>
                                        </div>
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Expediente</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            @if(isset($expediente))
                                                <p>{{$expediente}}</p>
                                                <input type="hidden" name="exp" value="{{$expediente}}">
                                            @else
                                                <p>{{$nro_exp}}</p>
                                                <input type="hidden" name="exp" value="{{$nro_exp}}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(isset($virtual))
                                            <input type="hidden" name="tipoexp" value="2">
                                            <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                                <label>Tipo de Documento</label>
                                                <select class="form-control select2bs4 select2-blue" name="tipodoc"
                                                        id="tipodoc">
                                                    <option value="0">Seleccionar</option>
                                                    @foreach($tipodoc as $t)
                                                        @if(isset($solicitud))
                                                            @if($t->valor==38)
                                                                <option value="{{$t->valor}}"
                                                                        selected>{{$t->texto}}</option>
                                                            @else
                                                                <option value="{{$t->valor}}">{{$t->texto}}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{$t->valor}}">{{$t->texto}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                                <label>Tipo de Expediente</label>
                                                <select class="form-control select2bs4 select2-blue" name="tipoexp"
                                                        id="tipoexp" onchange="remitente();">
                                                    <option value="0">Seleccionar</option>
                                                    @foreach($tipoexp as $e)
                                                        @if(isset($expediente))
                                                            @if($e->valor==2)
                                                                <option value="{{$e->valor}}"
                                                                        selected>{{$e->texto}}</option>
                                                            @else
                                                                <option value="{{$e->valor}}">{{$e->texto}}</option>
                                                            @endif
                                                        @else
                                                            <option value="{{$e->valor}}">{{$e->texto}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                                <label>Tipo de Documento</label>
                                                <select class="form-control select2bs4 select2-blue" name="tipodoc"
                                                        id="tipodoc">
                                                    <option value="0">Seleccionar</option>
                                                    @foreach($tipodoc as $t)
                                                        <option value="{{$t->valor}}">{{$t->texto}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        @if(isset($solicitud))
                                            <div class="form-group-lg col-lg-6 col-md-6 col-sm-6" id="remitentet">
                                                <label>Remitente</label>
                                                <textarea class="form-control" cols="40" rows="1" name="remitentet"
                                                        style="font-size: 12px;">{{$solicitud[0]->nombres}}</textarea>
                                            </div>
                                        @else
                                            <div class="form-group-lg col-lg-6 col-md-6 col-sm-6" id="remitentet">
                                                <label>Remitente</label>
                                                <textarea class="form-control" cols="40" rows="1" name="remitentet"
                                                        style="font-size: 12px;">@if(isset($expediente)) {{$nomres}} @endif</textarea>
                                            </div>
                                            <div class="form-group-lg col-lg-6 col-md-6 col-sm-6" id="remitentea">
                                                <label>Remitente</label>
                                                <select class="form-control select2bs4 select2-blue" name="remitentea">
                                                    <option value="0">Seleccionar</option>
                                                    @foreach($areas as $a)
                                                        <option value="{{$a->texto}}">{{$a->texto}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6" disabled="true">
                                            <label>Destino</label>
                                            <select class="form-control select2bs4 select2-blue" name="destino" id="destino"
                                                    autocomplete="off">
                                                <option value="0">Seleccionar</option>
                                                @if(isset($expediente))
                                                    @foreach($areas as $ar)
                                                        @if($ar->valor==$area)
                                                            <option value="{{$ar->valor}}" selected>{{$ar->texto}}</option>
                                                        @else
                                                            <option value="{{$ar->valor}}">{{$ar->texto}}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @if(isset($solicitud))
                                                        @foreach($areas as $ar)
                                                            @if(trim($ar->valor)==trim($solicitud[0]->area) || strcmp(trim($ar->valor),trim($solicitud[0]->area))==0)
                                                                <option value="{{$ar->valor}}"
                                                                        selected>{{$ar->texto}}</option>
                                                            @else
                                                                <option value="{{$ar->valor}}">{{$ar->texto}}</option>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach($areas as $ar)
                                                            <option value="{{$ar->valor}}">{{$ar->texto}}</option>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Seleccionar Contribuyente</label>
                                            <select class="form-control  select2-blue" name="persona" id="persona">
                                            </select>
                                        </div>

                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Correo Confirmación</label>
                                            <input class="form-control" type="email" name="email" id="email"
                                                @if(isset($expediente)) value="{{$correo}}"
                                                @elseif(isset($solicitud)) value="{{$solicitud[0]->correo}}" @endif>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label>Tipo de Trámite</label>
                                        <select class="form-control select2bs4 select2-blue" name="tptra">
                                            <option value="0">Seleccionar</option>
                                            @if(isset($expediente))
                                                @foreach($tipotramite as $tr)
                                                    @if($tr->valor==$tipotramite)
                                                        <option value="{{$tr->valor}}" selected>{{$tr->texto}}</option>
                                                    @else
                                                        <option value="{{$tr->valor}}">{{$tr->texto}}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @if(isset($solicitud))
                                                    @foreach($tipotramite as $tr)
                                                        @if($tr->valor==trim($solicitud[0]->tptra))
                                                            <option value="{{$tr->valor}}" selected>{{$tr->texto}}</option>
                                                        @else
                                                            <option value="{{$tr->valor}}">{{$tr->texto}}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach($tipotramite as $tr)
                                                        <option value="{{$tr->valor}}">{{$tr->texto}}</option>
                                                    @endforeach
                                                @endif
                                            @endif

                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Descripción</label>
                                            <textarea type="text" class="form-control" cols="40" rows="1" name="desc"
                                                    style="font-size: 12px;"></textarea>
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Asunto</label>
                                            <textarea type="text" class="form-control" cols="40" rows="1" name="asunto"
                                                    style="font-size: 12px;"> @if(isset($expediente)) {{$asunto}} @elseif(isset($solicitud)) {{$solicitud[0]->asunto}} @endif</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Referencia</label>
                                            <textarea type="text" class="form-control" cols="40" rows="1" name="refer"
                                                    style="font-size: 12px;"></textarea>
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Folios</label>
                                            <input type="number" class="form-control" name="folios" placeholder=""
                                                @if(isset($expediente)) value="{{$folios}}" @endif>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <a href="{{url('tramitedocumentario/expedientes')}}"><input type="button"
                                                                                                        class="btn btn-danger"
                                                                                                        value="Cancelar"></a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <input type="submit" class="btn btn-primary" value="Guardar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
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
        $(document).ready(function () {
            document.getElementById('remitentea').style.display = "none";
            document.getElementById('remitentet').style.display = "none";
        });

        function remitente() {
            tipoexp = document.getElementById('tipoexp').value;
            ra = document.getElementById('remitentea');
            rt = document.getElementById('remitentet');
            if (tipoexp == 1) {
                document.getElementById('remitentea').style.display = "inline";
                document.getElementById('remitentet').style.display = "none";
            } else {
                if (tipoexp == 2) {
                    document.getElementById('remitentea').style.display = "none";
                    document.getElementById('remitentet').style.display = "inline";
                }
            }
        }
    </script>
@endsection
