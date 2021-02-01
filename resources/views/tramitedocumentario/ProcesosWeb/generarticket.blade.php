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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="container-fluid card" style="padding: 1%">
                            {!! Form::open(['url'=>'tramitedocumentario/expediente/registrar','method'=>'post']) !!}
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
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>DNI del Solicitante</label>
                                            <input class="form-control" type="text" name="dni" id="dni">
                                        </div>
                                        <div class=" col-lg-3 col-md-3 col-sm-3">
                                            <button type="button" id="validar" class="btn btn-primary">Validar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Paterno</label>
                                            <input class="form-control" type="text" name="paterno" id="paterno"
                                                   readonly>
                                        </div>
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Materno</label>
                                            <input class="form-control" type="text" name="materno" id="materno"
                                                   readonly>
                                        </div>
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Nombres</label>
                                            <input class="form-control" type="text" name="nombres" id="nombres"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Correo Confirmación</label>
                                            <input class="form-control" type="text" name="correo" id="paterno">
                                        </div>
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Correo Confirmación 1</label>
                                            <input class="form-control" type="text" name="correo1" id="materno">
                                        </div>
                                        <div class="form-group-lg col-lg-3 col-md-3 col-sm-3">
                                            <label>Monto</label>
                                            <input class="form-control" type="text" name="monto" id="nombres">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Area Tramita</label>
                                            <select class="form-control select2bs4 select2-blue" name="destino"
                                                    id="destino">
                                                <option value="0">Seleccionar</option>
                                                @foreach($areas as $a)
                                                    <option value="{{$a->valor}}">{{$a->texto}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group-lg col-lg-6 col-md-6 col-sm-6">
                                            <label>Seleccionar Tributo</label>
                                            <select class="form-control  select2-blue" name="tributo" id="tributo">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 1%">
                                        <div class="col-lg-6 col-md-6 col-sm-6 text-center">
                                            <a href="{{url('tramitedocumentario/tickets')}}"><input type="button"
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
        $('#validar').click(function () {
            var dni = document.getElementById('dni').value;
            if (dni == "") {
                alert('Ingrese su DNI');
            } else {
                $.ajax({
                    url: 'https://sistema.munivictorlarco.gob.pe/visa/prueba1.php',
                    data: {'dni': dni},
                    type: 'get',
                    success: function (response) {
                        var json = JSON.parse(response);
                        //console.log(json.Dato);
                        document.getElementById('paterno').value = json.Dato.ApellidoPaterno
                        document.getElementById('materno').value = json.Dato.ApellidoMaterno
                        document.getElementById('nombres').value = json.Dato.Nombres
                    },
                    statusCode: {
                        404: function () {
                            alert('Error al validar');
                        }
                    },
                    error: function (x, xs, xt) {
                        //window.open(JSON.stringify(x));
                        //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                        alert('Error al validar');
                    }
                });
            }

        });
        $("#tributo").select2({
            minimumInputLength: 3,
            language: {
                inputTooShort: function (args) {
                    // args.minimum is the minimum required length
                    // args.input is the user-typed text
                    return "Escribe al menos 3 caracteres";
                },
                inputTooLong: function (args) {
                    // args.maximum is the maximum allowed length
                    // args.input is the user-typed text
                    return "Demasiados caracteres";
                },
                errorLoading: function () {
                    return "Error cargando los resultados";
                },
                loadingMore: function () {
                    return "Cargando más resultados";
                },
                noResults: function () {
                    return "Sin resultados";
                },
                searching: function () {
                    return "Buscando...";
                },
                maximumSelected: function (args) {
                    // args.maximum is the maximum number of items the user may select
                    return "Error loading results";
                }
            },
            ajax: {
                url: "{{url('/tramitedocumentario/tributos')}}",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log(params.term);
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    console.log(response);
                    return {
                        results: response
                        //results: data.items
                    };
                },
                cache: true
            }

        });
    </script>
@endsection
