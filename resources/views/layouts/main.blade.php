<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistema de Victor Larco Herrera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Administrador del sistema de la municipalidad de Victor Larco Herrera">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('admin/main.d810cf0ae7f39f28f336.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('js/toast.js')}}"></script>
    @yield('style')
    @yield('css')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        @include('layouts.header')
        @include('cambiarpass')
        <div class="app-main">
            @if (!(Request::is('home')))
             @include('layouts.menu')
            @endif
            @yield('content')
        </div>
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <script type="text/javascript" src="{{asset('admin/scripts/main.d810cf0ae7f39f28f336.js')}}"></script>
    @if (session('inicio'))
    <input type="hidden" id="alert" value="{{session('inicio')}}">
    <script>
        console.log(document.getElementById('alert').value);
        $(document).ready(function () {
            var alert = document.getElementById('alert').value;
            var options = {
                style: {
                    main: {
                        background: "green",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        });
    </script>
@endif
@if (session('alert'))

    <input type="hidden" id="alert" value="{{session('alert')}}">
    <script>
        console.log(document.getElementById('alert').value);
        $(document).ready(function () {
            var alert = document.getElementById('alert').value;
            var options = {
                style: {
                    main: {
                        background: "green",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        });
    </script>
@endif
@if (session('error'))

    <input type="hidden" id="error" value="{{session('error')}}">
    <script>
        console.log(document.getElementById('error').value);
        $(document).ready(function () {
            var alert = document.getElementById('error').value;
            var options = {
                style: {
                    main: {
                        background: "red",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        });
    </script>
@endif
    <script>
        $('#modulo').change(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('/administracion/listar_grupos') }}", //ruta donde enviaras el id del area para listar luego los cargos
                type: 'get',
                dataType: 'json',
                data: {"mod_codigo": $("#modulo").val()},
                success: function (data) {
                    $('#grupo').empty();
                    for (var i = 0; i < data.length; i++) {
                        $('#grupo').append('<option value="' + data[i].grupo_id + '">' + data[i].gru_nombre + '</option>');
                    }
                }
            });
        });
        $('#modulo1').change(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ url('/administracion/listar_grupos') }}", //ruta donde enviaras el id del area para listar luego los cargos
                type: 'get',
                dataType: 'json',
                data: {"mod_codigo": $("#modulo1").val()},
                success: function (data) {
                    $('#grupo1').empty();
                    for (var i = 0; i < data.length; i++) {
                        $('#grupo1').append('<option value="' + data[i].grupo_id + '">' + data[i].gru_nombre + '</option>');
                    }
                }
            });
        });
    </script>
    <script type='text/javascript'>
        $(document).ready(function () {
            $('#modal-default').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nombre = button.data('nombre')
                var estado = button.data('estado')
                var modal = $(this)
                modal.find('.modal-nombre').text(nombre)
                modal.find('#id').val(id)
                modal.find('#estado').val(estado)
            });

            $("#persona").select2({
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
                    url: "{{url('/administracion/usuarios/buscar_trababajadores')}}",
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
        });
        function validarPass() {
            n = document.getElementById("new").value;
            a = document.getElementById("confirm").value;
            fo = document.getElementById("CambiarPassForm");
            if(n===a){
                fo.submit();
            }else{
                alert("La nueva contraseña debe coincidir con el campo de confirmación de contraseña")
            }
        }
    </script>
    @yield('scripts')
</body>
</html>
