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
                            {!! Form::open(['url'=>'tramitedocumentario/rtptraexp','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8">
                                    <label>Área:</label>
                                    <select class="form-control form-control-sm select2-blue" name="tptra" id="tptra">
                                        <option value="" selected>Seleccionar Tipo de Trámite</option>
                                        @foreach($tptras as $a)
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
                                    <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-search"></span> Buscar
                                    </button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                    <button type="button" class="btn btn-default btn-sm"><span class="fa fa-print"></span> Imprimir
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
                                                            <th>Tipo de Trámite</th>
                                                            <th>Total</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($expedientes as $i)
                                                            <tr>
                                                                <td>{{$i->tptra_descripcion}}</td>
                                                                <td>{{$i->total}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-hover text-nowrap">
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
