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
    <th>#</th>
    <th>PLACA</th>
    <th>SERIE</th>
    <th>VIN</th>
    <th>NRO. MOTOR</th>
    <th>COLOR</th>
    <th>MARCA</th>
    <th>MODELO</th>
    <th>ESTADO</th>
    <th>SEDE</th>
    </thead>
    <tbody>

    @foreach($vehiculos as $ve)
        @foreach($ve as $v)

            <tr>
                <td>{{1}}</td>
                <td>{{$v['placa']}}</td>
                <td>{{$v['serie']}}</td>
                <td>{{$v['vin']}}</td>
                <td>{{$v['nro_motor']}}</td>
                <td>{{$v['color']}}</td>
                <td>{{$v['marca']}}</td>
                <td>{{$v['modelo']}}</td>
                <td>{{$v['estado']}}</td>
                <td>{{$v['sede']}}</td>
            </tr>
    </tbody>
</table>
<table class="table table-bordered table-striped  text-center align-items-center">
    <thead class="bg-gray" style="font-size: 14px">
    <th style="vertical-align:middle;" >#</th>
    <th style="vertical-align:middle;" >Nombre</th>
    </thead>
    <tbody>
    @php($i=1)
    @foreach($v['propietarios']  as $p)
        <tr>
            <td>{{$i}}</td>
            <td>{{$p}}</td>
        </tr>
        @php($i++)
    @endforeach
    </tbody>
</table>
        @endforeach
    @endforeach

</body>
</html>
