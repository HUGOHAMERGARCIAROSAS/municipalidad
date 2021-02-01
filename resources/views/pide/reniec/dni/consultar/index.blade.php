@extends('layout.index3')
@section('content')
    <div class="content-header">
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <!-- Desplegar y contraer contenido -->
                <div class="card-header">
                    <h3 class="card-title">Busqueda de DNI</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <!-- /.Fin de desplegar y contraer contenido -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label>Nro de DNI:</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input type="text" class="form-control input-sm" id="dni" name="dni" placeholder="Ingresa un número de DNI">
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-primary btn-sm" onclick="cargarDatos();"><i class="fa fa-search fa-1x"></i> Buscar</button>
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-default btn-sm" onclick="imprimir();"><i class="fa fa-print"></i> Imprimir</button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-gray">
                <!-- Desplegar y contraer contenido -->
                <div class="card-header">
                    <h3 class="card-title">Resultado de Busqueda</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>


                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="cargando" class="text-center">
                                <img
                                        width="200"
                                        src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}" />
                                <p>
                                    Cargando contenido
                                </p>
                            </div>
                            <div class="table-responsive" id="contenedor_dni">
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>


    <script type="text/javascript">

        function imprimir(){
            var printContents = document.getElementById('contenedor_dni').innerHTML;
            w = window.open();
            w.document.write("<link type=\"text/css\" rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css\"/>");
            w.document.write("<br><h2 class='text-center'>VALIDACIÓN DATOS RENIEC</h2><br><br>");
            w.document.write(printContents);
            w.document.close(); // necessary for IE >= 10
            w.focus(); // necessary for IE >= 10
            w.print();
            w.close();
            return true;
        }

        $(document).ready(function(){

            $("#cargando").hide();

        });

        function cargarDatos(){
            $('#contenedor_dni').empty();
            window.setTimeout(function () {
                $("#exitoRazonSocial").fadeOut(0)
            }, 0);
            window.setTimeout(function () {
                $("#alertaRazonSocial").fadeOut(0)
            }, 0);
            obtenerDatos();
        }
        function obtenerDatos()
        {
            $("#cargando").show();
            $("#listo").hide();
            var dni = $("#dni").val();
            console.log(dni);

            $.ajax({
                url: "{{url('pide/reniec/dni/consultar/show')}}",
                data : {
                    dni : dni},
                dataType: "json",
                type:"get",

            })

                .done(function(response){
                    var html;
                    $('#contenedor_dni').empty();
                    $.each(response, function(index, element){
                        if(element.consultarResponse==null){
                            $("#cargando").hide();
                            window.setTimeout(function () {
                                $("#exitoRazonSocial").fadeOut(0)
                            }, 0);
                            $("#alertaRazonSocial").fadeIn();
                            window.setTimeout(function () {
                                $("#alertaRazonSocial").fadeOut(0)
                            }, 6000);

                        }else{
                            var len =  1;

                            html='<table class="table table-bordered table-striped text-center" id="datarazonsocial">';
                            html+='<thead class="bg-gray">';
                            html+='<th>FOTO</th>';
                            html+='<th>DATOS</th>';
                            html+='</thead> ';
                            var aux=1;
                            html+='<tr>';
                            if(element.consultarResponse.return.datosPersona.foto==null){
                                html+='<td></td>';
                            }
                            else{
                                html+="<td><img width='240' height='336' src='data:image/png;base64,"+element.consultarResponse.return.datosPersona.foto+"'</td>";
                            }
                            html+='<td>';
                            html+='<table class="table table-bordered table-striped  text-center">';
                            html+='<tr>';
                            html+='<th>AP. PATERNO</th>';
                            if(element.consultarResponse.return.datosPersona.apPrimer==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.apPrimer+'</td>';
                            }
                            html+='</tr>';
                            html+='<tr>';
                            html+='<th>AP. MATERNO</th>';
                            if(element.consultarResponse.return.datosPersona.apSegundo==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.apSegundo+'</td>';
                            }
                            html+='</tr>';
                            html+='<tr>';
                            html+='<th>NOMBRES</th>';
                            if(element.consultarResponse.return.datosPersona.prenombres==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.prenombres+'</td>';
                            }
                            html+='</tr>';
                            html+='<tr>';
                            html+='<th>DIRECCIÓN</th>';
                            if(element.consultarResponse.return.datosPersona.direccion==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.direccion+'</td>';
                            }
                            html+='</tr>';
                            html+='<tr>';
                            html+='<th>UBIGEO</th>';
                            if(element.consultarResponse.return.datosPersona.ubigeo==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.ubigeo+'</td>';
                            }
                            html+='</tr>';
                            html+='<tr>';
                            html+='<th>ESTADO CIVIL</th>';
                            if(element.consultarResponse.return.datosPersona.estadoCivil==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.estadoCivil+'</td>';
                            }
                            html+='</tr>';
                            html+='<tr>';
                            html+='<th>RESTRICCIÓN</th>';
                            if(element.consultarResponse.return.datosPersona.restriccion==null){
                                html+='<td></td>';
                            }else{
                                html+='<td>'+element.consultarResponse.return.datosPersona.restriccion+'</td>';
                            }
                            html+='</tr>';

                            html+='</table>';
                            html+='</td>';



                            html+='</tr>';
                            html+='</table>';
                            $('#contenedor_dni').append(html);
                            $("#cargando").hide();
                            $("#listo").show();
                            console.log(element);
                            var text= "Existen: ";
                            var text2 = " en total";
                            var textonuevo= text+len+text2
                            console.log(textonuevo);
                            $('#lblexisten').val("textonuevo");
                            $("#lblexisten").html(textonuevo);
                            window.setTimeout(function () {
                                $("#alertaRazonSocial").fadeOut(0)
                            },0);
                            $("#exitoRazonSocial").fadeIn();
                            window.setTimeout(function () {
                                $("#exitoRazonSocial").fadeOut(0)
                            }, 6000);
                            $('#datarazonsocial').DataTable({
                                bFilter: false,
                                bPaginate: false,
                                bInfo: false,
                                language: {
                                    "lengthMenu": "Mostrar _MENU_ registros",
                                    "zeroRecords": "No se encontraron resultados",
                                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                    "sSearch": "Buscar:",
                                    "oPaginate": {
                                        "sFirst": "Primero",
                                        "sLast":"Último",
                                        "sNext":"Siguiente",
                                        "sPrevious": "Anterior"
                                    },
                                    "sProcessing":"Procesando...",
                                }
                            });
                        }
                    });
                });
        }
    </script>

@endsection
