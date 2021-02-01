@extends('layouts.main')
@section('css')
    <style>
        .fixed-sidebar .app-main .app-main__outer {
            padding-left: 0px!important;
        }
    </style>
@endsection
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-keypad" style="color: #3f6ad8"></i>
                    </div>
                    <div>MÓDULOS
                        <div class="page-title-subheading">Seleccionar el módulo al cual desea ingresar.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .table th, .table td {
            padding: 1.55rem!important;
        }
    </style>
    <div class="" style="align-content: center">
        <table class="table" style="width: auto; margin-left: auto;
      margin-right: auto;">
            <?php
            $i=0;
            ?>
            @foreach($modulos as $m)
                @if($i==0)
                    <tr>
                        <td>
                            <div class="card card-primary" style="width: 220px;height: 220px;">
                                <div class="card-header text-center" style="justify-content: center!important"> {{$m->mod_descripcion}}</div>

                                <div class="card-body text-center">
                                    <a href="{{url('modulos/'.$m->mod_codigo)}}"><img height="140px" width="140px" src="{{url('img/'.$m->mod_descripcion.'.JPG')}}"></a>
                                </div>
                            </div>
                        </td>
                        <?php
                            $i++;
                        ?>
                @elseif($i==1||$i==2)
                        <td>
                            <div class="card card-primary" style="width: 220px;height: 220px;">
                                <div class="card-header text-center" style="justify-content: center!important">{{$m->mod_descripcion}}</div>

                                <div class="card-body text-center">
                                    <a href="{{url('modulos/'.$m->mod_codigo)}}"><img height="140px" width="140px" src="{{url('img/'.$m->mod_descripcion.'.JPG')}}"></a>
                                </div>
                            </div>
                        </td>
                        <?php
                        $i++;
                        ?>
                @elseif($i==3)
                        <td>
                            <div class="card card-primary" style="width: 220px;height: 220px;">
                                <div class="card-header text-center" style="justify-content: center!important">{{$m->mod_descripcion}}</div>

                                <div class="card-body text-center">
                                    <a href="{{url('modulos/'.$m->mod_codigo)}}"><img height="140px" width="140px" src="{{url('img/'.$m->mod_descripcion.'.JPG')}}"></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $i=0;
                    ?>
                @endif
            @endforeach

        </table>
    </div>
</div>
@endsection
