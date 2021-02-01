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
                            {!! Form::open(['url'=>'tramitedocumentario/tipotramite/registrar','method'=>'post']) !!}
                            {!! Form::token() !!}
                            <div class="card card-gray">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group-lg col-lg-8 col-md-8 col-sm8">
                                            <label>Descripción</label>
                                            <input type="text" class="form-control" name="descripcion">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-8 col-md-8 col-sm-8">
                                            <label>Área</label>
                                            <select class="form-control select2bs4 select2-blue" name="area">
                                                @foreach($areas as $a)
                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group-lg form-check col-lg-6 col-md-6 col-sm-6" style="padding-left: 2.5%; padding-top:1%">
                                            <input type="checkbox" class="form-check-input" name="online">
                                            <label class="form-check-label">Online</label>
                                        </div>
                                    </div>
                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <a href="{{url('tramitedocumentario/tipotramites')}}"><input type="button"
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
