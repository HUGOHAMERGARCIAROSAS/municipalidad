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
                            {!! Form::open(['url'=>'tramitedocumentario/expediente/editar','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <input type="hidden" name="codcontri" value="{{$expediente[0]->codcontri}}">
                                    <input type="hidden" name="estado" value="{{$expediente[0]->estado}}">
                                    <input type="hidden" name="exped" value="{{$expediente[0]->coddocumento}}">
                                    <input type="hidden" name="anio" value="{{$expediente[0]->anio}}">
                                    <div class="row">
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Fecha</label>
                                        </div>
                                        <div class=" col-lg-3 col-md-3 col-sm-3">
                                            <p><span class="fa fa-calendar-day"></span> {{$expediente[0]->fecha}} <span
                                                        class="fa fa-clock"></span> {{$expediente[0]->hora}}</p>
                                        </div>
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Expediente</label>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <p>{{$expediente[0]->expediente}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Tipo de Expediente</label>
                                            <select class="form-control select2bs4 select2-blue" name="tipodoc">
                                                @foreach($tipoexp as $e)
                                                    @if($e->valor==$expediente[0]->tipodoc)
                                                        <option value="{{$e->valor}}" selected>{{$e->texto}}</option>
                                                    @else
                                                        <option value="{{$e->valor}}">{{$e->texto}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Remitente</label>
                                            <textarea class="form-control" cols="40" rows="1" name="remitente"
                                                    placeholder="Ingresar remitente"
                                                    style="font-size: 12px;">{{trim($expediente[0]->remitente)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-12 col-md-12 col-sm-12">
                                            <label>Tipo de trámite</label>
                                            <select class="form-control select2bs4 select2-blue" name="tptra_ids">
                                                @foreach($tipotramite as $t)
                                                    @if($t->valor==$expediente[0]->tptra_id)
                                                        <option value="{{$t->valor}}" selected>{{$t->texto}}</option>
                                                    @else
                                                        <option value="{{$t->valor}}">{{$t->texto}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-12 col-md-12 col-sm-12">
                                            <label>Seleccionar Contribuyente</label>
                                            <select class="form-control  select2-blue" name="persona" id="persona">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Descripción</label>
                                            <textarea type="text" class="form-control" cols="40" rows="1" name="observ"
                                                    placeholder="Ingresar descripción"
                                                    style="font-size: 12px;">{{trim($expediente[0]->descdocumento)}}</textarea>
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Asunto</label>
                                            <textarea type="text" class="form-control" cols="40" rows="1" name="asunto"
                                                    placeholder="Ingresar asunto"
                                                    style="font-size: 12px;">{{trim($expediente[0]->asunto)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Referencia</label>
                                            <textarea type="text" class="form-control" cols="40" rows="1" name="refer"
                                                    placeholder="Ingresar contraseña"
                                                    style="font-size: 12px;">{{trim($expediente[0]->referencia)}}</textarea>
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Folios</label>
                                            <input type="text" class="form-control" value="{{$expediente[0]->folios}}"
                                                name="folios" placeholder="Ingresar contraseña">
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


