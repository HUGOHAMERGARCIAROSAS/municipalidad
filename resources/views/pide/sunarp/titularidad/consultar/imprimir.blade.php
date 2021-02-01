<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <title>Document</title>
</head>
<body onload="window.print()">
    <br><h2 class='text-center'>BÚSQUEDA DE TITULARIDAD</h2><br><br>
    <div class="table table-hover table-bordered" id="contenedor_titularidad">
    </div>
    <table class="table table-bordered table-striped  text-center align-items-center">
        <thead class="bg-gray" style="font-size: 14px">
            <th style="vertical-align:middle;" >#</th>
            <th style="vertical-align:middle;" >Nombre</th>
            <th style="vertical-align:middle;" >Apellido Paterno</th>
            <th style="vertical-align:middle;" >Apellido Materno</th>
            <th style="vertical-align:middle;" >Dirección</th>
            <th style="vertical-align:middle;" >Estado</th>
            <th style="vertical-align:middle;" >Mensaje</th>
            <th style="vertical-align:middle;" >Libro</th>
            <th style="vertical-align:middle;" >N° Documento</th>
            <th style="vertical-align:middle;" >N° Partida</th>
            <th style="vertical-align:middle;" >N° Placa</th>
            <th style="vertical-align:middle;" >N° Oficina</th>
            <th style="vertical-align:middle;" >Razón Social</th>
            <th style="vertical-align:middle;" >Registro</th>
            <th style="vertical-align:middle;" >Tipo Documento</th>
            <th style="vertical-align:middle;" >Zona</th>
        </thead>
        <tbody>

            @if(!isset($titularidad->respuestaTitularidad->estado))
                @foreach($titularidad as $t)
                    @php($m=count($t))
                    @for($i=0;$i<$m;$i++)
                        <tr>
                            <td>{{$i+1}}</td>
                            @if(isset($t[$i]->nombre))
                                <td>{{$t[$i]->nombre}}</td>
                            @else
                                <td></td>
                            @endif
                            @if(isset($t[$i]->apPaterno))
                                <td>{{$t[$i]->apPaterno}}</td>
                            @else
                                <td></td>
                            @endif
                            @if(isset($t[$i]->apMaterno))
                                <td>{{$t[$i]->apMaterno}}</td>
                            @else
                                <td></td>
                            @endif
                            @if(isset($t[$i]->direccion))
                                <td>{{$t[$i]->direccion}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$t[$i]->estado}}</td>
                            <td>{{$t[$i]->estado}}</td>
                            <td>{{$t[$i]->libro}}</td>
                            <td>{{$t[$i]->numeroDocumento}}</td>
                            <td>{{$t[$i]->numeroPartida}}</td>
                            @if(isset($t[$i]->numeroPlaca))
                                <td>{{$t[$i]->numeroPlaca}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$t[$i]->oficina}}</td>
                            @if(isset($t[$i]->razonSocial))
                                <td>{{$t[$i]->razonSocial}}</td>
                            @else
                                <td></td>
                            @endif
                            <td>{{$t[$i]->registro}}</td>
                            <td>{{$t[$i]->tipoDocumento}}</td>
                            <td>{{$t[$i]->zona}}</td>
                        </tr>
                    @endfor
                @endforeach
            @else
                @foreach($titularidad as $v)
                <tr>
                    <td>1</td>
                    @if(isset($v->nombre))
                        <td>{{$v->nombre}}</td>
                    @else
                        <td></td>
                    @endif
                    @if(isset($v->apPaterno))
                        <td>{{$v->apPaterno}}</td>
                    @else
                        <td></td>
                    @endif
                    @if(isset($v->apMaterno))
                        <td>{{$v->apMaterno}}</td>
                    @else
                        <td></td>
                    @endif
                    @if(isset($v->direccion))
                        <td>{{$v->direccion}}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{$v->estado}}</td>
                    <td>{{$v->estado}}</td>
                    <td>{{$v->libro}}</td>
                    <td>{{$v->numeroDocumento}}</td>
                    <td>{{$v->numeroPartida}}</td>
                    @if(isset($v->numeroPlaca))
                        <td>{{$v->numeroPlaca}}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{$v->oficina}}</td>
                    @if(isset($v->razonSocial))
                        <td>{{$v->razonSocial}}</td>
                    @else
                        <td></td>
                    @endif
                    <td>{{$v->registro}}</td>
                    <td>{{$v->tipoDocumento}}</td>
                    <td>{{$v->zona}}</td>
                </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</body>
</html>
