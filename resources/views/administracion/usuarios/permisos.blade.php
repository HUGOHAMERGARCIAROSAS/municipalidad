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
                        Permisos de módulos para usuario {{$usuario['0']->texto}}
                            ({{$usuario['0']->per_login}}
                            )
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header"></div>
        <div class="content">
            <div class="container-fluid">
                <div class="card card-gray">
                    <div class="card-header">
                        <h3 class="card-title">Permisos para usuario {{$usuario['0']->texto}} ({{$usuario['0']->per_login}}
                            )</h3>

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
                                {!! Form::open(['url' => 'administracion/usuarios/permisos/'.$usuario['0']->per_codigo,'method'=>'POST']) !!}
                                {!! Form::token() !!}
                                <div class="card" style="padding: 2%">
                                    @php($k=1)
                                    @foreach($mod_men as $m)
                                        @if($k==1)<div class="row">@endif
                                        @if($k<3)
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <h3>{{$m->mod_descripcion}}</h3>
                                                @foreach($grupos1 as $g)
                                                    @if($g->mod_codigo==$m->mod_codigo)
                                                            <button class="accordion btn btn-info"
                                                                    type="button">{{$g->gru_nombre}}</button>
                                                            <div class="panel col-lg-12 col-md-12 col-sm-12">
                                                                <div class="row">
                                                                    @foreach($tareas1 as $t)
                                                                        @if($t->grupo_id==$g->grupo_id)
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input"
                                                                                        name="Tareas[]" value="{{$t->tarea_id}}"
                                                                                        @foreach($per_tar as $p)
                                                                                        @if($t->tarea_id==$p->tarea_id)
                                                                                        checked
                                                                                            @endif
                                                                                            @endforeach
                                                                                    >
                                                                                    <label class="form-check-label">{{$t->tar_nombre}}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            @php($k++)
                                        @else
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <h3>{{$m->mod_descripcion}}</h3>
                                                @foreach($grupos1 as $g)
                                                    @if($g->mod_codigo==$m->mod_codigo)
                                                            <button class="accordion btn btn-info"
                                                                    type="button">{{$g->gru_nombre}}</button>
                                                            <div class="panel col-lg-12 col-md-12 col-sm-12">
                                                                <div class="row">
                                                                    @foreach($tareas1 as $t)
                                                                        @if($t->grupo_id==$g->grupo_id)
                                                                            <div class="col-lg-3">
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input"
                                                                                        name="Tareas[]" value="{{$t->tarea_id}}"
                                                                                        @foreach($per_tar as $p)
                                                                                        @if($t->tarea_id==$p->tarea_id)
                                                                                        checked
                                                                                            @endif
                                                                                            @endforeach
                                                                                    >
                                                                                    <label class="form-check-label">{{$t->tar_nombre}}</label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @php($k=1)
                                        @endif
                                    @endforeach

                                </div>
                                <div class="row" style="padding-top: 10px">
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                        <a href="{{url('administracion/usuarios')}}"><input type="button"
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
</div>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
@endsection
