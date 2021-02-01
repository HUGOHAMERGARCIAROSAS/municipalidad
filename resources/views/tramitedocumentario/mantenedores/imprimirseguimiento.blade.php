<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>Imprimir </title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="{{url('dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/icheck-bootstrap/icheck-bootstrap.min.css"')}}">
    <script type="text/javascript">
        function imprimir()
        {
            window.print();
            ventana = window.self;
            ventana.opener = window.self;
        }
    </script>
</head>
<body onLoad="imprimir();">
<img src="{{asset('img/Escudo_Victor_Larco_Herrera.png')}}" style="width: 80px; height: 100px; float: left;" alt=""/>
<h2 class="text-center">MUNICIPALIDAD DISTRITAL DE VICTOR LARCO HERRERA</h2>
<h4 class="text-center">SEGUIMIENTO DE EXPEDIENTE</h4>
<h5 class="text-center">Datos Generales del Expediente Administrativo</h5>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-2">
        <label>Expediente: </label> {{$expediente[0]->coddocumento}}
    </div>
    <div class="col-lg-3 col-md-3 col-sm-2">
        <label>Año: </label> {{$expediente[0]->anio}}
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <label>Interesado: </label> {{$expediente[0]->remitente}}
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <label>Asunto: </label> {{$expediente[0]->asunto}}
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <label>Referencia: </label> {{$expediente[0]->referencia}}
    </div>
</div>
<h5 class="text-center">Movimientos</h5>
<table class="table table-hover text-center table-sm">
    <thead>
    <tr style="font-size: 14px">
        <th>Nro Movimiento</th>
        <th>Folios</th>
        <th>Observaciones</th>
        <th>Área</th>
        <th>Copia</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @php($k=$cant_moves)
    @foreach($movimientos as $e)
        <?php if($e->areaderiv!="" && $e->trabderiva!=""){$vaa=" a ".$e->areaderiv." que atienda ".$e->trabderiva;}
        else
            if($e->areaderiv!=""){$vaa=" a ".$e->areaderiv;}
            else {$vaa="";}?>
        <tr style="font-size: 12px">
            <td>{{$k}}</td>
            <td>{{$e->folios}}</td>
            <td>{{$e->observacion}}</td>
            <td>{{$e->are_descripcion}}</td>
            <td>{{$e->copia}}</td>
            <td>{{$e->fecha." ".$e->hora}}</td>
            <td>{{$e->estadodocs." ".$vaa}}</td>
        </tr>
        @php($k--)
    @endforeach
    </tbody>
</table>
<br><h5 class="text-center">Días en Área</h5>
<table class="table table-hover text-center table-sm">
    <thead>
    <tr>
        <th>Nro</th>
        <th>N° Expediente</th>
        <th>Fecha Recepción</th>
        <th>Área que Recibe el Expediente </th>
        <th>Cantidad en Días que Tuvo el Expediente en Área</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nrodias as $n)
        <tr>
            <td>{{$n->ids}}</td>
            <td>{{$n->coddocumento}}</td>
            <td>{{$n->fecha}}</td>
            <td>{{$n->remitente}}</td>
            <td>{{$n->dias}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h4>Emitido el día {{$fecha[0]->fecha}} a las {{$hora[0]->hora}} por el usuario {{$usuario}}</h4>
</body>
</html>