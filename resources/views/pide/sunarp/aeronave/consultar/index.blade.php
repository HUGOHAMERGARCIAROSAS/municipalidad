@extends('principalsunarp')
@section('contenido')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Consultar aeronaves</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('homesunarp')}}">Home</a></li>
              <li class="breadcrumb-item active">Consultar Aeronaves</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
</div>
<section class="content">
<div class="container-fluid">
<div class="card card-primary">
		<!-- Desplegar y contraer contenido -->
          <div class="card-header">
            <h3 class="card-title">Busqueda de Aeronaves Sunarp</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.Fin de desplegar y contraer contenido -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nro de Placa</label>
                  <input type="text" class="form-control" id="numero_placa" placeholder="Ingresa una placa">
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <div class="form-group">
                  <label>Acción</label>
                  <button type="button" class="btn btn-block btn-primary"><i class="fa fa-search fa-1x"></i> Buscar</button>
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
<div class="card card-primary">
		<!-- Desplegar y contraer contenido -->
          <div class="card-header">
            <h3 class="card-title">Lista de Aeronaves</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.Fin de desplegar y contraer contenido -->
 <!--Inicio Tabla-->
 <div class="card-body">
 	<div class="row">
 		<div class="col-md-6">
 			<div class="form-group"><label>Existen: 0 en total</label> </div>
 		</div>
 	</div>
 </div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-borderless  text-center">
				<thead class="bg-primary">
					<th>#</th>
                    <th>LIBRO</th>
                    <th>N° DE MATRÍCULA</th>
                    <th>MENSAJE</th>
                    <th>MODELO</th>
                    <th>N° DE FICHA</th>
                    <th>N° DE PARTIDA</th>
                    <th>N° DE SERIE</th>
                    <th>OFICINA</th>
                    <th>REGISTRO</th>
                    <th>TIPO BIEN</th>
                    <th>TOMO</th>
				</thead>
               
				<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                     
                <td></td>
                <td></td>
                <td></td>
                <td></td>                     
                <td></td>
                <td></td>
				</tr>
            </table>
		</div>
		
	</div>
</div>

 <!--Fin Tabla-->
          
</div>
        <!-- /.card -->
</div>
</section>
@endsection