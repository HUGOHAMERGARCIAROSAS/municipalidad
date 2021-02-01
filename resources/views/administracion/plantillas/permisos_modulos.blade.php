@extends('layout.index3')
@section('content')
    <div class="content-header"></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <div class="card-header">
                    <h3 class="card-title">Para Plantilla "{{$plantilla['0']->plarol_nombre}}"</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                    class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card" style="padding: 2%">
                                <!-- checkbox -->
                                {!! Form::open(['url' => 'administracion/plantillas/permisos_modulos/'.$plantilla['0']->plarol_id,'method'=>'POST']) !!}
                                {!! Form::token() !!}
                                <div class="row">
                                    <input type="hidden" value="asd" name="asd">
                                    @foreach($modulos as $m)
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="Modulos[]"
                                                       value="{{$m->mod_codigo}}"
                                                       @foreach($mod_pla as $n)
                                                       @if($n->mod_codigo==$m->mod_codigo)
                                                       checked
                                                        @endif
                                                        @endforeach
                                                >
                                                <label class="form-check-label">{{$m->mod_descripcion}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <a href="{{url('administracion/plantillas')}}"><input type="button"
                                                                                              class="btn btn-danger"
                                                                                              value="Cancelar"></a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <input type="submit" class="btn btn-primary" value="Guardar">
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
