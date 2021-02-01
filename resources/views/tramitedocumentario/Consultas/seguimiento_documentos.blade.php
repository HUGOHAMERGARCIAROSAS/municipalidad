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
                            {!! Form::open(['url'=>'tramitedocumentario/seguimiento','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row" style="padding-bottom: 0.5%">

                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <div class="form-group-sm">
                                                <label>Expediente:</label>
                                                <input type="text" name="expediente" class="form-control form-control-sm"
                                                    placeholder="Expediente" value="{{old('expediente')}}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <div class="form-group-sm">
                                                <label>Año:</label>
                                                <input type="text" name="anio" class="form-control form-control-sm" placeholder="Año"
                                                    value="2020"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <div class="form-group-sm">
                                                <label>Interesado:</label>
                                                <input type="text" name="interesado" class="form-control form-control-sm"
                                                    placeholder="Interesado" value="{{old('interesado')}}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <div class="form-group-sm">
                                                <label>Asunto:</label>
                                                <input type="text" name="asunto" class="form-control form-control-sm"
                                                    placeholder="Asunto" value="{{old('asunto')}}"/>
                                            </div>
                                        </div>
                                        <div class=" col-md-2 col-sm-2 col-xs-2">
                                            <div class="form-group-sm">
                                                <label>Desde:</label>
                                                <input type="date" name="finicio" class="form-control form-control-sm ui-datepicker"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-2">
                                            <div class="form-group-sm">
                                                <label>Hasta:</label>
                                                <input type="date" name="ffin" class="form-control form-control-sm ui-datepicker"
                                                style="display: inline"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-bottom: 0.5%">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Referencia:</label>
                                            <input type="text" name="referencia" class="form-control form-control-sm input-sm"
                                                placeholder="Referencia" value="{{old('referencia')}}"/>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Descripción:</label>
                                            <textarea type="text" class="form-control form-control-sm" cols="40" rows="1" name="desc"
                                                    style="font-size: 12px;"></textarea>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <label>Tipo de Trámite:</label>
                                            <select class="form-control form-control-sm select2bs4 select2-blue" name="tptra">
                                                <option value="0">Seleccionar</option>
                                                @foreach($tipotra as $t)
                                                    <option value="{{$t->valor}}">{{$t->texto}}</option>
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
                                            <button type="reset" class="btn btn-warning btn-sm"><span class="fa fa-brush"></span>
                                                Limpiar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            <div class="card card-gray">
                                <div class="card-header">
                                    <h4 class="card-title">Datos Generales del Expediente Administrativo</h4>
                                </div>
                                <div class="card-body">
                                    @if(isset($cant_expe))
                                        @if($cant_expe>0)
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Expediente: </label> {{$expediente[0]->coddocumento}}
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Año: </label> {{$expediente[0]->anio}}
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <label>Imprimir:</label>
                                                    <button type="button" class="btn btn-default btn-sm"
                                                            onclick="{{"Printt(".$expediente[0]->coddocumento.",".$expediente[0]->anio.")"}}">
                                                        <span class="fa fa-print"></span> Imprimir
                                                    </button>
                                                    </a>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label>Descargables:</label>
                                                    <button type="button" class="btn btn-default btn-sm"
                                                            onclick="{{"printpdf(".$expediente[0]->coddocumento.",".$expediente[0]->anio.")"}}">
                                                        <span class="fa fa-download"></span> Individual
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-sm"
                                                            onclick="{{"printpdfacum(".$expediente[0]->coddocumento.",".$expediente[0]->anio.")"}}">
                                                        <span class="fa fa-file-pdf"></span> Acumulados
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <label>Interesado: </label> {{$expediente[0]->remitente}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <label>Asunto: </label> {{$expediente[0]->asunto}}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <label>Referencia: </label> {{$expediente[0]->referencia}}
                                                </div>
                                            </div>
                                            @if($cant_archivos>0)
                                                <h5 class="text-center">Archivos Adjuntos</h5>
                                                @foreach($archivos as $a)
                                                    <?php $vs1 = 1; $ext = explode(".", $a->archivo);$num = count($ext) - 1;  $ext = strtolower($ext[$num]);?>
                                                    <a href='#' onclick='{{"printpdf(".$expediente[0]->coddocumento.",".$expediente[0]->anio.")"}}'>{{"Archivo".$vs1."-".$ext}}</a>
                                                    <?php $vs1++;?>
                                                @endforeach
                                            @endif
                                            <h5 class="text-center">Movimientos</h5>
                                            @if($cant_moves>0)
                                                <table class="table table-hover text-center table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th>Nro Movimiento</th>
                                                        <th>Folios</th>
                                                        <th>Observaciones</th>
                                                        <th>Área</th>
                                                        <th>Copia</th>
                                                        <th>Fecha</th>
                                                        <th>Estado</th>
                                                        <th>Archivos</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody style="font-size: 0.75rem">
                                                    @php($k=$cant_moves)
                                                    @foreach($movimientos as $e)
                                                        <?php if ($e->areaderiv != "" && $e->trabderiva != "") {
                                                            $vaa = " a " . $e->areaderiv . " que atienda " . $e->trabderiva;
                                                        } else
                                                            if ($e->areaderiv != "") {
                                                                $vaa = " a " . $e->areaderiv;
                                                            } else {
                                                                $vaa = "";
                                                            }?>
                                                        <tr>
                                                            <td>{{$k}}</td>
                                                            <td>{{$e->folios}}</td>
                                                            <td>{{$e->observacion}}</td>
                                                            <td>{{$e->are_descripcion}}</td>
                                                            <td>{{$e->copia}}</td>
                                                            <td>{{$e->fecha." ".$e->hora}}</td>
                                                            <td>{{$e->estadodocs." ".$vaa}}</td>
                                                            <td>
                                                                @if($e->idinform!="" && $e->idinform!="0")
                                                                    <input type="hidden" name="exped"
                                                                        value="{{$e->coddocumento}}">
                                                                    <input type="hidden" name="anio" value="{{$e->anio}}">
                                                                    @if($e->archivo=="")
                                                                        <button type="submit" class="btn btn-default btn-xs"
                                                                                title="Detalles"
                                                                                onclick="{{"printpdfE('',".$e->idinform.");"}}">
                                                                            <span class="fa fa-download"></span></button>
                                                                    @else
                                                                        <button type="submit" class="btn btn-default btn-xs"
                                                                                title="Detalles"
                                                                                onclick="{{"printpdfE(".$e->archivo.",".$e->idinform.");"}}">
                                                                            <span class="fa fa-download"></span></button>
                                                                    @endif
                                                                @endif
                                                                @if($e->archivv!="")
                                                                    <input type="hidden" name="exped"
                                                                        value="{{$e->coddocumento}}">
                                                                    <input type="hidden" name="anio" value="{{$e->anio}}">
                                                                    <button type="submit" class="btn btn-default btn-xs"
                                                                            title="Detalles"
                                                                            onclick="{{"printpdfE(".$e->archivv.");"}}">
                                                                        <span class="fa fa-download"></span></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @php($k--)
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                        <h5>No se encontraron movimientos</h5>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($cantnrodias>0)
                                                <br><h5 class="text-center">Días en Área</h5>
                                                <table class="table table-hover text-nowrap text-center table-sm">
                                                    <thead>
                                                    <tr>
                                                        <th>Nro</th>
                                                        <th>N° Expediente</th>
                                                        <th>Fecha Recepción</th>
                                                        <th>Área que Recibe el Expediente</th>
                                                        <th>Cantidad en Días que Tuvo el Expediente en Área</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody style="font-size: 0.75rem">
                                                    @foreach($nrodias as $n)
                                                        <tr>
                                                            <td>{{$n->ids}}</td>
                                                            <td>{{$n->coddocumento}}</td>
                                                            <td>{{$n->fecha}}</td>
                                                            <td>{{$n->remitente}}</td>
                                                            <td>{{$n->dias}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                        <h5>No se encontraron registros de días</h5>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                    <h5>No se encontraron resultados</h5>
                                                </div>
                                            </div>
                                        @endif
                                    @else
                                        @if(isset($cant_expes))
                                            @if($cant_expes>0)
                                                <table class="table table-hover text-nowrap text-center table-responsive">
                                                    <thead>
                                                    <tr style="font-size: 14px">
                                                        <th>Expediente</th>
                                                        <th>Interesado</th>
                                                        <th>Asunto</th>
                                                        <th>Referencia</th>
                                                        <th>Folio</th>
                                                        <th>Observaciones</th>
                                                        <th>Área</th>
                                                        <th>Fecha</th>
                                                        <th>Opciones</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody style="font-size: 0.75rem">
                                                    @foreach($expedientes as $e)
                                                        <tr style="font-size: 12px; padding-top: 3px; padding-bottom: 3px; height: 10px;">
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->numero}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->remitente}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->asunto}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->referencia}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->folios}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->descdocumento}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->are_descripcion}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">{{$e->fecha." ".$e->hora}}</td>
                                                            <td style=" padding-top: 3px; padding-bottom: 3px; height: 10px;">

                                                                {!! Form::open(['url'=>'tramitedocumentario/seguimiento','method'=>'POST','style'=>'display: inline;']) !!}
                                                                {!! Form::token() !!}
                                                                <input type="hidden" name="expediente"
                                                                    value="{{$e->coddocumento}}">
                                                                <input type="hidden" name="anio" value="{{$e->anio}}">
                                                                <button type="submit" class="btn btn-default"
                                                                        title="Detalles"><span class="fa fa-search"></span>
                                                                </button>
                                                                {!! Form::close() !!}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="row" style="text-align: center;">
                                                    <div class="col-lg-4 col-md-4 col-sm-4"
                                                        style="margin-left: auto; margin-right: auto">
                                                        {{$expedientes->appends(request()->input())->links()}}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                                        <h5>No se encontraron resultados</h5>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
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
@endsection
@section('scripts')
    <script>
        function Printt(expe, annn) {
            window.open("seguimiento/imprimir?exp=" + expe + "&anio=" + annn, "", "width=1100,height=600,menubar=yes,scrollbars=no");
        }

        function printpdf(expe, ann) {
            var t3 = screen.width;
            var t4 = screen.height;
            window.open("http://192.168.3.133/Sistemas/TramiteExterno/reportes/ver_pdf.php?criterio=" + expe + "&anioo=" + ann + "&baja=" + t4, "", "width=" + t3 + ",height=" + t4 + ",menubar=yes,scrollbars=no");
        }

        function printpdfacum(expe, ann) {
            var t3 = screen.width;
            var t4 = screen.height;
            window.open("http://192.168.3.133/Sistemas/TramiteExterno/reportes/acumula/index.php?criterio=" + expe + "&anioo=" + ann + "&baja=" + t4, "", "width=" + t3 + ",height=" + t4 + ",menubar=yes,scrollbars=no");
        }

        function printpdfE(expe, id) {
            var t3 = screen.width;
            var t4 = screen.height;
            window.open("http://192.168.3.133/Sistemas/TramiteExterno/ajax/seguimiento_documento.php?task=verfirm&exp=" + expe + "&id=" + id, "", "width=" + t3 + ",height=" + t4 + ",menubar=yes,scrollbars=no");
        }
    </script>
@endsection
