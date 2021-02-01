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
                            {!! Form::open(['url'=>'tramitedocumentario/tipotramites','method'=>'GET']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                            <div class="row">
                                <div class="col-lg-0 col-md-0 col-sm-0 col-xs-0">
                                    <label>Descripción:</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <input type="text" name="desc" class="form-control input-lg" placeholder="Descripción" value="{{old('desc')}}"/>
                                </div>
                                <div class="col-lg-0 col-md-0 col-sm-0 col-xs-0">
                                    <label>Área:</label>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <select class="form-control  select2-blue" name="area" id="area">
                                        <option value="" selected>Seleccionar Área</option>
                                        @foreach($areas as $a)
                                            <option value="{{$a->valor}}">{{$a->texto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center" >
                                    <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span> Buscar</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center btn-sm" >
                                    <a href="{{url('tramitedocumentario/tipotramite/nuevo')}}"><button type="button" class="btn btn-success"><span class="fa fa-file"></span> Nuevo</button></a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-center">
                                    <button type="reset" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span> Limpiar</button>
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
                                                @if(isset($tipotramites))
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr style="font-size: 14px">
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                            <th>Área</th>
                                                            <th>Requisitos</th>
                                                            <th>Formatos</th>
                                                            <th>Ejemplos</th>
                                                            <th>Online</th>
                                                            <th>Estado</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($tipotramites as $t)
                                                            <tr style="padding-top: 1px; padding-bottom: 1px; height: 10px;">
                                                                <td>{{$t->tptra_id}}</td>
                                                                <td>{{$t->tptra_descripcion}}</td>
                                                                <td>{{$t->area}}</td>
                                                                <td>@if($t->tptra_requisitos!="")<a href="{{$t->tptra_requisitos}}" target='_blank'><span class='fa fa-file-pdf' title='Requisitos'></span></a>@else <span class="fa fa-close"></span> @endif</td>
                                                                <td>@if($t->tptra_formatos!="")<a href="{{$t->tptra_formatos}}" target='_blank'><span class='fa fa-file-pdf' title='Formatos'></span></a>@else <span class="fa fa-close"></span> @endif</td>
                                                                <td>@if($t->tptra_ejemplos!="")<a href="{{$t->tptra_ejemplos}}" target='_blank'><span class='fa fa-file-pdf' title='Ejemplos'></span></a>@else <span class="fa fa-close"></span> @endif</td>
                                                                <td>@if($t->tptra_online==1) <span class="fa fa-check"></span>  @else <span class="fa fa-close"></span> @endif</td>
                                                                <td>@if($t->tptra_estado==1) <span class="fa fa-check"></span>  @else <span class="fa fa-close"></span> @endif</td>
                                                                <td>
                                                                    {!! Form::open(['url'=>'tramitedocumentario/tipotramite','method'=>'GET','style'=>'display: inline;']) !!}
                                                                    {!! Form::token() !!}
                                                                    <input type="hidden" name="id" value="{{$t->tptra_id}}">
                                                                    <button type="submit" class="btn btn-default btn-xs" title="Editar"><span class="fa fa-edit"></span></button>
                                                                    {!! Form::close() !!}
                                                                    @if($t->tptra_estado==1)
                                                                        {!! Form::open(['url'=>'tramitedocumentario/tipotramite/anular','method'=>'post','id'=>$t->tptra_id,'style'=>'display: inline;']) !!}
                                                                        {!! Form::token() !!}
                                                                        <input type="hidden" name="id" value="{{$t->tptra_id}}">
                                                                        <input type="hidden" name="id" value="{{$t->tptra_estado}}">
                                                                        <button type="button" onclick="{{"ConfirmarAnular('".$t->tptra_id."')"}}" class="btn btn-default btn-xs"><span class="fa fa-times" title="Anular"></span></button>
                                                                        {!! Form::close() !!}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                    <div class="row" style="text-align: center;">
                                                        <div class="col-lg-4 col-md-4 col-sm-4" style="margin-left: auto; margin-right: auto">
                                                            {{$tipotramites->appends(request()->input())->links()}}
                                                        </div>
                                                    </div>
                                                @else
                                                    <table class="table table-hover text-center table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                            <th>Área</th>
                                                            <th>Requisitos</th>
                                                            <th>Formatos</th>
                                                            <th>Ejemplos</th>
                                                            <th>Online</th>
                                                            <th>Estado</th>
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
        function ConfirmarAnular(id){
            console.log(id);
            form=document.getElementById(id);
            var opcion = confirm("¿Está seguro de anular/activar el tipo de trámite?");
            if (opcion == true) {
                form.submit();
            }
        }
    </script>
@endsection
