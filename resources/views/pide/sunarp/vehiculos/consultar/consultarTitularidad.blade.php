<section class="content">
<div class="container-fluid">
<div class="card card-gray">
		<!-- Desplegar y contraer contenido -->
          <div class="card-header">
            <h3 class="card-title">Busqueda de Razón Social Sunarp</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.Fin de desplegar y contraer contenido -->
          <div class="card-body">
            <div class="row">

	            <div class="col-sm-3">
	                <div class="form-group">
		                 <label>Tipo Persona</label>
		                  <!--<input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingresa una placa">-->
		                 <select class="form-control input-sm" name="tipoParticipante" id="tipoParticipante">
	                                                
		                    <!--<option value="0" disabled="disabled">Seleccione</option>-->
		                    <option value="N" selected="selected">Persona Natural</option>
		                    <option value="J">Persona Jurídica</option>
		                </select>
	                </div>
	            </div>

	            <div class="col-sm-4" id="div_razon_social">
	              <div class="form-group">
	                <label>Razón Social</label>
	                <input type="text" class="form-control input-sm" id="razon_social" name="razon_social" placeholder="Ingresa la razón social">
	              </div>
	            </div>

	            <div class="col-sm-3" id="div_paterno">
	              <div class="form-group">
	                <label>Apellido Paterno</label>
	                <input type="text" class="form-control input-sm" id="apellido_paterno_persona" name="apellido_paterno_persona" placeholder="Ingresa apellido paterno">
	              </div>
	            </div>

	            <div class="col-sm-3" id="div_materno">
	              <div class="form-group">
	                <label>Apellido Paterno</label>
	                <input type="text" class="form-control input-sm" id="apellido_materno_persona" name="apellido_materno_persona" placeholder="Ingresa apellido materno">
	              </div>
	            </div>

	            <div class="col-sm-3" id="div_nombre">
	              <div class="form-group">
	                <label>Nombres</label>
	                <input type="text" class="form-control input-sm" id="nombres_persona" name="nombres_persona" placeholder="Ingresa nombres">
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
            <h2 class="card-title">Lista de Razón Social</h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.Fin de desplegar y contraer contenido -->
 <!--Inicio Tabla-->
 <!--<div class="card-body">
 	<div class="row">
 		<div class="col-md-6">
 			<div class="form-group"><label id="lblexisten" value="">Existen: 0 en total</label> </div>
 		</div>
 	</div>
 </div>-->

 <div class="card-body">
  <div class="row">
    <div class="col-md-12">
      	<div id="cargandoTitularidad" class="text-center">
        	<img width="200" src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}" />
	        <p>
	          Cargando contenido
	        </p>
      	</div>

        <div class="table-responsive" id="contenedor_titularidad">   
    	</div>
    
  </div>
  </div>
 </div>
 <!-- /.card -->
</div>
</div>
</section>






<script type="text/javascript">
	$(document).ready(function(){
		var nombre;
		var paterno;
		var materno;
		var razon_social;
		$("#cargandoTitularidad").hide();
		$("#div_razon_social").hide();
		$('#tipoParticipante').change(function() {
	    var selected = $('#tipoParticipante option:selected');
	    var tipoParticipante = selected.val();
	    	if(tipoParticipante=="N")
	    	{
	    		$("#div_razon_social").hide();
	    		$("#div_nombre").show();
	    		$("#div_materno").show();
	    		$("#div_paterno").show();
	    	}else{
	    		$("#div_razon_social").show();
	    		$("#div_nombre").hide();
	    		$("#div_materno").hide();
	    		$("#div_paterno").hide();
	    	}
		});

		$("#razon_social").keypress(function(e) {
        if(e.which == 13) {
          $('#contenedor_titularidad').empty();
          obtenerDatos();
        }
     	 });

		$("#nombres_persona").keypress(function(e) {
        if(e.which == 13) {
          $('#contenedor_titularidad').empty();
          obtenerDatos();
        }
     	 });

        function mostrarAlerta(){
            $("#cargandoAsientos").hide();
            $("#cargandoFicha").hide();
            $("#cargandoFolio").hide();
            var alert = "No se encontraron datos.";
            var options = {
                style: {
                    main: {
                        background: "red",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        }

        function mostrarExito(){
            $("#cargando").hide();
            var alert = "Datos encontrados satisfactoriamente";
            var options = {
                style: {
                    main: {
                        background: "green",
                        color: "white"
                    }
                }
            };
            iqwerty.toast.Toast(alert, options);
        }

		$('#AbrirBuscarTitular').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget)
	        var nombres_persona_modal_editar = button.data('nombres_persona')
	        var apellido_paterno_persona_modal_editar = button.data('apellido_paterno_persona')
	        var apellido_materno_persona_modal_editar = button.data('apellido_materno_persona')
	        var razon_social_juridica_modal_editar = button.data('razon_social');
	        var modal = $(this)
	        // modal.find('.modal-title').text('New message to ' + recipient)
	        /*los # son los id que se encuentran en el formulario*/
	        modal.find('.modal-body #nombres_persona').val(nombres_persona_modal_editar);
	        modal.find('.modal-body #apellido_paterno_persona').val(apellido_paterno_persona_modal_editar);
	        modal.find('.modal-body #apellido_materno_persona').val(apellido_materno_persona_modal_editar);
	        modal.find('.modal-body #razon_social').val(razon_social_juridica_modal_editar);
        		nombre = $('#nombres_persona').val();
				paterno = $('#apellido_paterno_persona').val();
				materno = $('#apellido_materno_persona').val();
				razon_social = $("#razon_social").val();
            $('#contenedor_titularidad').empty();
            obtenerDatos();
        
        });

    	$('#AbrirBuscarTitular').on('hide.bs.modal', function (event) {
        	$("#cargandoTitularidad").hide();
        	$('#contenedor_titularidad').empty();
        });

	    function obtenerDatos()
	    {
	    	//$('#tipoParticipante option:selected').val()
	    	var tipoParticipante = $('#tipoParticipante option:selected').val(); 
	    	console.log("tipoParticipante: ", tipoParticipante);
	      $("#cargandoTitularidad").show();
	      $("#listo").hide();
	        razon_social = $("#razon_social").val();
	        //console.log(razon_social);
	        if($('#tipoParticipante option:selected').val()=="N"){
				var separa = razon_social.split(" ");
				console.log(separa.length);
				/*if(separa.length==4){
				var nombre = separa[0] + " " + separa[1];
				var paterno = separa[2];
				var materno = separa[3];
				console.log("nombres: ",nombre);
				console.log("paterno: ",paterno);
				console.log("materno: ",materno);
				cargarAjax(nombre,paterno,materno);
				}else if (separa.length==3){
				var nombre = separa[0];
				var paterno = separa[1];
				var materno = separa[2];
				console.log("nombres: ",nombre);
				console.log("paterno: ",paterno);
				console.log("materno: ",materno);
				var nombre = $('#nombre').val();
				var paterno = $('#paterno').val();
				var materno = $('#materno').val();
				cargarAjax(nombre,paterno,materno);	
				}else{
					alert("Ingresa los datos completos")
				}*/
				nombre = $('#nombres_persona').val();
				paterno = $('#apellido_paterno_persona').val();
				materno = $('#apellido_materno_persona').val();

				console.log(nombre);
				console.log(paterno);
				console.log(materno);
				cargarAjax(nombre,paterno,materno);
				function cargarAjax(nombre, paterno, materno){
					//console.log("Nombre Completo:",nombre+paterno+materno);
					$.ajax({
			        url: "{{url('pide/sunarp/titularidad/consultar/show')}}",
			        data : {
			          nombre : nombre,
			          paterno: paterno,
			          materno: materno,
			          tipoParticipante: tipoParticipante
			      		},
			          dataType: "json",
			          type:"get",      
			        
			        })
			        .done(function(response){
			        var html;
			        $('#contenedor_titularidad').empty();
			          $.each(response, function(index, element){
			          	if(element.buscarTitularidadResponse.respuestaTitularidad==null){
			          		mostrarAlerta();
			          	}else{
			          	var len =  element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.length;
			          		if(len==null){
			          			construirTablaSingular(index, element);
			          			mostrarExito()
			          		}
			          		else{
			          			construirTabla(index, element);
			          			mostrarExito();
			          		}
			          	}
			          	
			          });
			      	});
				}
			}else if($('#tipoParticipante option:selected').val()=="J"){
				console.log("Razon Social: ",razon_social);
				$.ajax({
			        url: "{{url('pide/sunarp/titularidad/consultar/show')}}",
			        data : {
			          razon_social : razon_social,
			          tipoParticipante: tipoParticipante
			      		},
			          dataType: "json",
			          type:"get",      
			        
			        })
					.done(function(response){
			        var html;
			        $('#contenedor_titularidad').empty();
			          $.each(response, function(index, element){
			          	if(element.buscarTitularidadResponse.respuestaTitularidad==null){
			          		mostrarAlerta();
			          	}else{
			          	var len =  element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.length;
			          		if(len==null){
			          			construirTablaSingular(index, element);
			          			mostrarExito();
			          		}
			          		else{
			          			construirTabla(index, element);
			          			mostrarExito();
			          		}
			          	}
			          });
			      	});
			}else{
				alert("Selecciona una opcion");
			}

			function construirTablaSingular(index, element){
						html='<table class="table table-bordered table-striped  text-center" id="datatitularidadN">';
			            html+='<thead class="bg-gray">';
			            html+='<th>#</th>';
			            html+='<th>ASIENTO</th>';
			            html+='<th>NOMBRE</th>';
			            html+='<th>APELLIDO PATERNO</th>';
			            html+='<th>APELLIDO MATERNO</th>';
			            html+='<th>DIRECCION</th>';
			            html+='<th>ESTADO</th>';
			            html+='<th>MENSAJE</th>';
			            html+='<th>LIBRO</th>';
			            html+='<th>N° DOCUMENTO</th>';
			            html+='<th>N° PARTIDA</th>';
			            html+='<th>N° PLACA</th>';
			            html+='<th>N° OFICINA</th>';
			            html+='<th>RAZON SOCIAL</th>';
			            html+='<th>REGISTRO</th>';
			            html+='<th>TIPO_DOCUMENTO</th>';
			            html+='<th>ZONA</th>';
			            html+='</thead> ';
			            /*DATA PARA NUMERO_PARTIDA EN MODAL*/
			              var numero_partida = element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroPartida;
						  /*DATA PARA TIPO DE REGISTRO EN MODAL*/
			              var tipo_registro=element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.registro;
			              var separa = tipo_registro.split(" ");
			              var auxRegistro = separa[3];
			              if(auxRegistro=="MUEBLES"){
			              	var registro = "24000";
			              }else if(auxRegistro=="INMUEBLE"){
			              	var registro = "21000";
			              }

			              /*DATA PARA NUMERO OFICINA EN MODAL*/

			              var auxOficina =element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.oficina;
			              if(auxOficina=="LIMA"){
			              	var oficina="01 01";
			              }else if (auxOficina=="CALLAO"){
			              	var oficina="01 02";
			              }else if (auxOficina=="HUARAL"){
			              	var oficina="01 03";
			              }else if (auxOficina=="HUACHO"){
			              	var oficina="01 04";
			              }else if (auxOficina=="CAÑETE"){
			              	var oficina="01 05";
			              }else if (auxOficina=="BARRANCA"){
			              	var oficina="01 06";
			              }else if (auxOficina=="HUANCAYO"){
			              	var oficina="02 01";
			              }else if (auxOficina=="HUANUCO"){
			              	var oficina="02 02";
			              }else if (auxOficina=="PASCO"){
			              	var oficina="02 04";
			              }else if (auxOficina=="SATIPO"){
			              	var oficina="02 05";
			              }else if (auxOficina=="LA MERCED"){
			              	var oficina="02 06";
			              }else if (auxOficina=="TARMA"){
			              	var oficina="02 07";
			              }else if (auxOficina=="TINGO MARIA"){
			              	var oficina="02 08";
			              }else if (auxOficina=="HUANCAVELICA"){
			              	var oficina="02 09";
			              }else if (auxOficina=="AREQUIPA"){
			              	var oficina="03 01";
			              }else if (auxOficina=="CAMANA"){
			              	var oficina="03 02";
			              }else if (auxOficina=="CASTILLA_APLAO"){
			              	var oficina="03 03";
			              }else if (auxOficina=="ISLAY_MOLLENDO"){
			              	var oficina="03 04";
			              }else if (auxOficina=="HUARAZ"){
			              	var oficina="04 01";
			              }else if (auxOficina=="CASMA"){
			              	var oficina="04 02";
			              }else if (auxOficina=="CHIMBOTE"){
			              	var oficina="04 03";
			              }else if (auxOficina=="PIURA"){
			              	var oficina="05 01";
			              }else if (auxOficina=="SULLANA"){
			              	var oficina="05 02";
			              }else if (auxOficina=="TUMBES"){
			              	var oficina="05 03";
			              }else if (auxOficina=="CUSCO"){
			              	var oficina="06 01";
			              }else if (auxOficina=="ABANCAY"){
			              	var oficina="06 02";
			              }else if (auxOficina=="MADRE DE DIOS"){
			              	var oficina="06 03";
			              }else if (auxOficina=="QUILLABAMBA"){
			              	var oficina="06 04";
			              }else if (auxOficina=="SICUANI"){
			              	var oficina="06 05";
			              }else if (auxOficina=="ESPINAR"){
			              	var oficina="06 06";
			              }else if (auxOficina=="ANDAHUAYLAS"){
			              	var oficina="06 07";
			              }else if (auxOficina=="TACNA"){
			              	var oficina="07 01";
			              }else if (auxOficina=="ILO"){
			              	var oficina="07 02";
			              }else if (auxOficina=="JULIACA"){
			              	var oficina="07 03";
			              }else if (auxOficina=="MOQUEGUA"){
			              	var oficina="07 04";
			              }else if (auxOficina=="PUNO"){
			              	var oficina="07 05";
			              }else if (auxOficina=="TRUJILLO"){
			              	var oficina="08 01";
			              }else if (auxOficina=="CHEPEN"){
			              	var oficina="08 02";
			              }else if (auxOficina=="HUAMACHUCO"){
			              	var oficina="08 03";
			              }else if (auxOficina=="OTUZCO"){
			              	var oficina="08 04";
			              }else if (auxOficina=="SAN PEDRO"){
			              	var oficina="08 05";
			              }else if (auxOficina=="MAYNAS"){
			              	var oficina="09 01";
			              }else if (auxOficina=="ICA"){
			              	var oficina="10 01";
			              }else if (auxOficina=="CHINCHA"){
			              	var oficina="10 02";
			              }else if (auxOficina=="PISCO"){
			              	var oficina="10 03";
			              }else if (auxOficina=="NAZCA"){
			              	var oficina="10 04";
			              }else if (auxOficina=="CHICLAYO"){
			              	var oficina="11 01";
			              }else if (auxOficina=="CAJAMARCA"){
			              	var oficina="11 02";
			              }else if (auxOficina=="JAEN"){
			              	var oficina="11 03";
			              }else if (auxOficina=="BAGUA"){
			              	var oficina="11 04";
			              }else if (auxOficina=="CHACHAPOYAS"){
			              	var oficina="11 05";
			              }else if (auxOficina=="CHOTA"){
			              	var oficina="11 06";
			              }else if (auxOficina=="MOYOBAMBA"){
			              	var oficina="12 01";
			              }else if (auxOficina=="TARAPOTO"){
			              	var oficina="12 02";
			              }else if (auxOficina=="JUANJUI"){
			              	var oficina="12 03";
			              }else if (auxOficina=="YURIMAGUAS"){
			              	var oficina="12 04";
			              }else if (auxOficina=="PUCALLPA"){
			              	var oficina="13 01";
			              }else if (auxOficina=="AYACUCHO"){
			              	var oficina="14 01";
			              }else if (auxOficina=="HUANTA"){
			              	var oficina="14 02";
			              }


			              
			              html+='<tr>';
			              html+='<td>1</td>';
			              html+='<td><button type="button" class="btn btn-warning btn-md"  data-toggle="modal" data-numero_partida="'+numero_partida+'" data-registro="'+registro+'" data-oficina="'+oficina+'" data-target="#AbrirBuscarAsiento"> <i class="far fa-eye"></i> Ver Asientos </button></td>';
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.nombre==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.nombre+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.apPaterno==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.apPaterno+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.apMaterno==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.apMaterno+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.direccion==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.direccion+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.estado==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.estado+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.mensaje==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.mensaje+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.libro==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.libro+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroDocumento==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroDocumento+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroPartida==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroPartida+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroPlaca==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.numeroPlaca+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.oficina==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.oficina+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.razonSocial==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.razonSocial+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.registro==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.registro+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.tipoDocumento==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.tipoDocumento+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.zona==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.zona+'</td>';
			              }
			              
			              html+='</tr>';
			              html+='</table>';
			            $('#contenedor_titularidad').append(html);
			            $("#cargandoTitularidad").hide();
			            $("#listo").show();
			            $('#datatitularidadN').DataTable({
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

			function construirTabla(index,element){
					var len =  element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad.length;
            			console.log(len);
            			html='<table class="table table-bordered table-striped  text-center" id="datatitularidadJ">';
			            html+='<thead class="bg-gray" style="font-size: 14px">';
			            html+='<th>#</th>';
			            html+='<th>ASIENTO</th>';
			            html+='<th>NOMBRE</th>';
			            html+='<th>APELLIDO PATERNO</th>';
			            html+='<th>APELLIDO MATERNO</th>';
			            html+='<th>DIRECCION</th>';
			            html+='<th>ESTADO</th>';
			            html+='<th>MENSAJE</th>';
			            html+='<th>LIBRO</th>';
			            html+='<th>N° DOCUMENTO</th>';
			            html+='<th>N° PARTIDA</th>';
			            html+='<th>N° PLACA</th>';
			            html+='<th>N° OFICINA</th>';
			            html+='<th>RAZON SOCIAL</th>';
			            html+='<th>REGISTRO</th>';
			            html+='<th>TIPO_DOCUMENTO</th>';
			            html+='<th>ZONA</th>';
			            html+='</thead> ';
			            for(var i=0;i<len;i++ ){
			              /*DATA PARA NUMERO_PARTIDA EN MODAL*/
			              var numero_partida = element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroPartida;
						  /*DATA PARA TIPO DE REGISTRO EN MODAL*/
			              var tipo_registro=element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].registro;
			              var separa = tipo_registro.split(" ");
			              var auxRegistro = separa[3];
			              if(auxRegistro=="MUEBLES"){
			              	var registro = "24000";
			              }else if(auxRegistro=="INMUEBLE"){
			              	var registro = "21000";
			              }

			              /*DATA PARA NUMERO OFICINA EN MODAL*/

			              var auxOficina =element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].oficina;
			              if(auxOficina=="LIMA"){
			              	var oficina="01 01";
			              }else if (auxOficina=="CALLAO"){
			              	var oficina="01 02";
			              }else if (auxOficina=="HUARAL"){
			              	var oficina="01 03";
			              }else if (auxOficina=="HUACHO"){
			              	var oficina="01 04";
			              }else if (auxOficina=="CAÑETE"){
			              	var oficina="01 05";
			              }else if (auxOficina=="BARRANCA"){
			              	var oficina="01 06";
			              }else if (auxOficina=="HUANCAYO"){
			              	var oficina="02 01";
			              }else if (auxOficina=="HUANUCO"){
			              	var oficina="02 02";
			              }else if (auxOficina=="PASCO"){
			              	var oficina="02 04";
			              }else if (auxOficina=="SATIPO"){
			              	var oficina="02 05";
			              }else if (auxOficina=="LA MERCED"){
			              	var oficina="02 06";
			              }else if (auxOficina=="TARMA"){
			              	var oficina="02 07";
			              }else if (auxOficina=="TINGO MARIA"){
			              	var oficina="02 08";
			              }else if (auxOficina=="HUANCAVELICA"){
			              	var oficina="02 09";
			              }else if (auxOficina=="AREQUIPA"){
			              	var oficina="03 01";
			              }else if (auxOficina=="CAMANA"){
			              	var oficina="03 02";
			              }else if (auxOficina=="CASTILLA_APLAO"){
			              	var oficina="03 03";
			              }else if (auxOficina=="ISLAY_MOLLENDO"){
			              	var oficina="03 04";
			              }else if (auxOficina=="HUARAZ"){
			              	var oficina="04 01";
			              }else if (auxOficina=="CASMA"){
			              	var oficina="04 02";
			              }else if (auxOficina=="CHIMBOTE"){
			              	var oficina="04 03";
			              }else if (auxOficina=="PIURA"){
			              	var oficina="05 01";
			              }else if (auxOficina=="SULLANA"){
			              	var oficina="05 02";
			              }else if (auxOficina=="TUMBES"){
			              	var oficina="05 03";
			              }else if (auxOficina=="CUSCO"){
			              	var oficina="06 01";
			              }else if (auxOficina=="ABANCAY"){
			              	var oficina="06 02";
			              }else if (auxOficina=="MADRE DE DIOS"){
			              	var oficina="06 03";
			              }else if (auxOficina=="QUILLABAMBA"){
			              	var oficina="06 04";
			              }else if (auxOficina=="SICUANI"){
			              	var oficina="06 05";
			              }else if (auxOficina=="ESPINAR"){
			              	var oficina="06 06";
			              }else if (auxOficina=="ANDAHUAYLAS"){
			              	var oficina="06 07";
			              }else if (auxOficina=="TACNA"){
			              	var oficina="07 01";
			              }else if (auxOficina=="ILO"){
			              	var oficina="07 02";
			              }else if (auxOficina=="JULIACA"){
			              	var oficina="07 03";
			              }else if (auxOficina=="MOQUEGUA"){
			              	var oficina="07 04";
			              }else if (auxOficina=="PUNO"){
			              	var oficina="07 05";
			              }else if (auxOficina=="TRUJILLO"){
			              	var oficina="08 01";
			              }else if (auxOficina=="CHEPEN"){
			              	var oficina="08 02";
			              }else if (auxOficina=="HUAMACHUCO"){
			              	var oficina="08 03";
			              }else if (auxOficina=="OTUZCO"){
			              	var oficina="08 04";
			              }else if (auxOficina=="SAN PEDRO"){
			              	var oficina="08 05";
			              }else if (auxOficina=="MAYNAS"){
			              	var oficina="09 01";
			              }else if (auxOficina=="ICA"){
			              	var oficina="10 01";
			              }else if (auxOficina=="CHINCHA"){
			              	var oficina="10 02";
			              }else if (auxOficina=="PISCO"){
			              	var oficina="10 03";
			              }else if (auxOficina=="NAZCA"){
			              	var oficina="10 04";
			              }else if (auxOficina=="CHICLAYO"){
			              	var oficina="11 01";
			              }else if (auxOficina=="CAJAMARCA"){
			              	var oficina="11 02";
			              }else if (auxOficina=="JAEN"){
			              	var oficina="11 03";
			              }else if (auxOficina=="BAGUA"){
			              	var oficina="11 04";
			              }else if (auxOficina=="CHACHAPOYAS"){
			              	var oficina="11 05";
			              }else if (auxOficina=="CHOTA"){
			              	var oficina="11 06";
			              }else if (auxOficina=="MOYOBAMBA"){
			              	var oficina="12 01";
			              }else if (auxOficina=="TARAPOTO"){
			              	var oficina="12 02";
			              }else if (auxOficina=="JUANJUI"){
			              	var oficina="12 03";
			              }else if (auxOficina=="YURIMAGUAS"){
			              	var oficina="12 04";
			              }else if (auxOficina=="PUCALLPA"){
			              	var oficina="13 01";
			              }else if (auxOficina=="AYACUCHO"){
			              	var oficina="14 01";
			              }else if (auxOficina=="HUANTA"){
			              	var oficina="14 02";
			              }


			              var aux=1+i;
			              html+='<tr style="font-size: 12px">';
			              html+='<td>'+aux+'</td>';
			              html+='<td><button type="button" class="btn btn-warning btn-md"  data-toggle="modal" data-numero_partida="'+numero_partida+'" data-registro="'+registro+'" data-oficina="'+oficina+'" data-target="#AbrirBuscarAsiento"> <i class="far fa-eye"></i> Ver Asientos </button></td>';
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].nombre==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].nombre+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].apPaterno==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].apPaterno+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].apMaterno==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].apMaterno+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].direccion==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].direccion+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].estado==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].estado+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].mensaje==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].mensaje+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].libro==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].libro+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroDocumento==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroDocumento+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroPartida==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroPartida+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroPlaca==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].numeroPlaca+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].oficina==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].oficina+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].razonSocial==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].razonSocial+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].registro==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].registro+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].tipoDocumento==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].tipoDocumento+'</td>';
			              }
			              if(element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].zona==null){
			                html+='<td></td>';
			              }else{
			              html+='<td>'+element.buscarTitularidadResponse.respuestaTitularidad.respuestaTitularidad[i].zona+'</td>';
			              }
			              
			              html+='</tr>';
			              
			              //console.log(element.personaJuridica.resultado[i].tipo)
			              
			            }
			            html+='</table>';
			            $('#contenedor_titularidad').append(html);
			            $("#cargandoTitularidad").hide();
			            $("#listo").show();
			            $('#datatitularidadJ').DataTable({
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
			
	    }
	$('#AbrirBuscarAsiento').on('show.bs.modal', function (event) {
        	var button = $(event.relatedTarget)
	        var numero_partida_modal_editar = button.data('numero_partida')
	        var registro_modal_editar = button.data('registro')
	        var oficina_modal_editar = button.data('oficina')
	        var razon_social_juridica_modal_editar = button.data('razon_social_juridica');
	        var modal = $(this)
	        // modal.find('.modal-title').text('New message to ' + recipient)
	        /*los # son los id que se encuentran en el formulario*/
	        modal.find('.modal-body #numero_partida').val(numero_partida_modal_editar);
	        modal.find('.modal-body #registro').val(registro_modal_editar);
	        modal.find('.modal-body #oficinaAsiento').val(oficina_modal_editar);
	        modal.find('.modal-body #razon_social_juridica').val(razon_social_juridica_modal_editar);
        
        });

	});

</script>