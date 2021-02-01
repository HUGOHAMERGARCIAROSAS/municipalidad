<section class="content">
<div class="container-fluid">
<div class="card card-gray">
		<!-- Desplegar y contraer contenido -->
          <div class="card-header">
            <h3 class="card-title">Busqueda de Asientos Sunarp</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.Fin de desplegar y contraer contenido -->

          <div class="card-body">
            <div class="row">

	            <div class="col-md-4">
	                <div class="form-group">
		                 <label>Oficina</label>
		                  <!--<input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingresa una placa">-->
		                 <select class="form-control" name="oficinaAsiento" id="oficinaAsiento">

		                    <option value="0">Seleccione</option>
		                    @foreach($oficinas as $of)
		                    <option value="{{$of['codZona']}} {{$of['codOficina']}}">{{$of['descripcion']}} - {{$of['codZona']}} - {{$of['codOficina']}}</option>
		                    @endforeach
		                </select>
	                </div>
	            </div>

	            <div class="col-md-4">
	                <div class="form-group">
		                 <label>Tipo Registro</label>
		                  <!--<input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Ingresa una placa">-->
		                 <select class="form-control" name="registro" id="registro">

		                    <option value="0" selected="selected">Seleccione</option>
		                    <option value="21000">PROPIEDAD INMUEBLE - 21000</option>
		                    <option value="22000">PERSONAS JURÍDICAS - 22000</option>
		                    <option value="23000">PERSONAS NATURALES - 23000</option>
		                    <option value="24000">PROPIEDAD MUEBLE - 24000</option>
		                </select>
	                </div>
	            </div>
              <!-- /.col -->

	            <div class="col-md-4">
	              <div class="form-group">
	                <label>N° Partida</label>
	                <input type="text" class="form-control" id="numero_partida" name="numero_partida" value="" placeholder="Ingresa el N° de partida">
	              </div>
	            </div>


            	<!--<div class="col-md-3">
              	<div class="form-group">
                	<label>Acción</label>
                	<button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search fa-1x"></i> Buscar</button>
              	</div>
            	</div>-->
              <!-- /.col -->
            </div>
         </div>


</div>
        <!-- /.card -->
</div>
</section>


<div class="card-body">
 	<div class="row">
 		<div class="col-md-4">
 			<div class="form-group"><label id="txtTransaccion">TRANSACCIÓN: </label> </div>
 		</div>

 		<div class="col-md-4">
 			<div class="form-group"><label id="txtNroPag">N° DE PÁGINAS: </label> </div>
 		</div>
 	</div>

 </div>

<section class="content">
<div class="container-fluid">
<div class="card card-gray">
		<!-- Desplegar y contraer contenido -->
          <div class="card-header">
            <h3 class="card-title">Lista de Asientos</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <!-- /.Fin de desplegar y contraer contenido -->


<!--INICIO TABLA-->
	<div class="card-body">
	  	<div class="row">
	    	<div class="col-md-12">
				<div id="cargandoAsientos" class="text-center">
		        	<img width="200" src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}" />
			        <p>
			          Cargando contenido
			        </p>
		      	</div>

		        <div class="table-responsive" id="contenedor_asientos">
		    	</div>
			</div>
		</div>
	</div>

	<!--INICIO TABLA-->
<div class="card-body">
  	<div class="row">
    	<div class="col-md-12">
			<div id="cargandoFicha" class="text-center">
		        	<img width="200" src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}" />
			        <p>
			          Cargando contenido
			        </p>
		    </div>

		    <div class="table-responsive" id="contenedor_fichas">
		    </div>
		</div>
	</div>
</div>

 <!--Fin Tabla-->

 <!--INICIO TABLA-->
<div class="card-body">
  	<div class="row">
    	<div class="col-md-12">
			<div id="cargandoFolio" class="text-center">
		        	<img width="200" src="{{asset('https://upload.wikimedia.org/wikipedia/commons/b/b1/Loading_icon.gif')}}" />
			        <p>
			          Cargando contenido
			        </p>
		    </div>

		    <div class="table-responsive" id="contenedor_folios">
		    </div>
		</div>
	</div>
</div>

 <!--Fin Tabla-->
</div>
</div>
</section>




<script type="text/javascript">
	$(document).ready(function(){

		$("#cargandoAsientos").hide();
		$("#cargandoFicha").hide();
		$("#cargandoFolio").hide();
		var oficina;
		var registro;
		var numero_partida;
		var codZona;
		var codOficina;
		/* SELECT OFICINA*/
		$('#oficinaAsiento').change(function() {
	    //var selected = $('#oficina option:selected');
	    //oficina = selected.val();
	    var oficina = document.getElementById('oficinaAsiento').value;
	    var separa = oficina.split(" ");
	     codZona= separa[0];
		 codOficina= separa[1];
	    //cargarAjax();
		}); /*FIN SELECT OFICINA*/

		$('#AbrirBuscarAsiento').on('show.bs.modal', function (event) {
        $('#contenedor_asientos').empty();
		$('#contenedor_fichas').empty();
		$('#contenedor_folios').empty();
        var oficina = document.getElementById('oficinaAsiento').value;
	    var separa = oficina.split(" ");
	     codZona= separa[0];
		 codOficina= separa[1];

		var selected = $('#registro option:selected');
	    registro = selected.val();
            $('#contenedor_asientos').empty();
            $('#contenedor_fichas').empty();
            $('#contenedor_folios').empty();
            numero_partida = $("#numero_partida").val();
            $("#cargandoAsientos").show();
            $("#cargandoFicha").show();
            $("#cargandoFolio").show();
            $("#listo").hide();
            cargarAjax();
        });

        $('#AbrirBuscarAsiento').on('hide.bs.modal', function (event) {
        	window.setTimeout(function () {
          $("#exitoAsientos").fadeOut(0)
          }, 0);
          window.setTimeout(function () {
          $("#alertaAsientos").fadeOut(0)
          }, 0);

        });

        $('#AbrirBuscarAsiento').on('hide.bs.modal', function (event) {
        $('#contenedor_asientos').empty();
		$('#contenedor_fichas').empty();
		$('#contenedor_folios').empty();
		$("#cargandoAsientos").hide();
		$("#cargandoFicha").hide();
		$("#cargandoFolio").hide();
		$('#txtTransaccion').html("TRANSACCIÓN: ");
		$('#txtNroPag').html("N° DE PÁGINAS: ");
        });


		/* SELECT REGISTRO*/
		$('#registro').change(function() {
	    var selected = $('#registro option:selected');
	    registro = selected.val();
	    //cargarAjax();
		});/*FIN SELECT OFICINA*/


		$("#numero_partida").keypress(function(e) {
        if(e.which == 13) {
          $('#contenedor_asientos').empty();
          $('#contenedor_fichas').empty();
          $('#contenedor_folios').empty();
          numero_partida = $("#numero_partida").val();
          $("#cargandoAsientos").show();
          $("#cargandoFicha").show();
          $("#cargandoFolio").show();
	      $("#listo").hide();
          cargarAjax();
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


		function cargarAjax(){
		console.log(oficina);
		console.log(registro);
		console.log(numero_partida);
		console.log(codZona);
		console.log(codOficina);

			if(numero_partida.length<1){
				alert("Ingresa un numero de partida");
				$("#cargandoAsientos").hide();
				$("#cargandoFicha").hide();
				$("#cargandoFolio").hide();
			}else{
				$.ajax({
			        url: "{{url('pide/sunarp/asientos/consultar/show')}}",
			        data : {
			          codZona : codZona,
			          codOficina: codOficina,
			          registro: registro,
			          numero_partida: numero_partida
			      		},
			          dataType: "json",
			          type:"get",

			        })
					.done(function(response){
			        var htmlAsientos;
			        var htmlFichas;
			        var htmlFolios;
			        $('#contenedor_asientos').empty();
			        $('#contenedor_fichas').empty();
			        $('#contenedor_folios').empty();
				        $.each(response, function(index, element){
				        var validarAsiento = element.listarAsientosResponse.asientos.transaccion;
				        console.log("transaccion", validarAsiento);
				        if(validarAsiento==0){
				        		mostrarAlerta();
				        }
				        else{
				          	var transaccion= element.listarAsientosResponse.asientos.transaccion;
				          	var nroPaginas = element.listarAsientosResponse.asientos.nroTotalPag;


	            			var pagina="";
	            			var nroPagRef="";
	            			var idImg="";
	            			var tipo="";
	            			//console.log("Asientos:", lenFichas);
	            		if(element.Asientos==1){
				        	var lenAsientos =  element.listarAsientosResponse.asientos.listAsientos.length;
				        	console.log(lenAsientos);
				        	if(lenAsientos==null){
				        			console.log("Solo hay una fila");
				        		htmlAsientos='<table class="table table-bordered table-striped  text-center" id="dataasientos">';
					            htmlAsientos+='<thead class="bg-gray" style="font-size: 14px">';
					            htmlAsientos+='<th>#</th>';
					            htmlAsientos+='<th>ID IMG ASIENTO</th>';
					            htmlAsientos+='<th>NUM PAG.</th>';
					            htmlAsientos+='<th>TIPO</th>';
					            htmlAsientos+='<th>PAGINAS</th>';
					            htmlAsientos+='</thead> ';
					            idImg=element.listarAsientosResponse.asientos.listAsientos.idImgAsiento;
			                	tipo=element.listarAsientosResponse.asientos.listAsientos.tipo;
			                	htmlAsientos+='<tr style="font-size: 12px">';
			                	htmlAsientos+='<td>1</td>';
			                	htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos.idImgAsiento+'</td>';
			                	htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos.numPag+'</td>';
			                	htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos.tipo+'</td>';

			                	if(element.listarAsientosResponse.asientos.listAsientos.numPag>1){

					            htmlAsientos+='<td>';
					            htmlAsientos+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
					              	var lenpaginasAsientos=element.listarAsientosResponse.asientos.listAsientos.listPag.length;


					              	console.log(lenpaginasAsientos);
					              	for(var j=0;j<lenpaginasAsientos;j++){
					              		nroPagRef= element.listarAsientosResponse.asientos.listAsientos.listPag[j].nroPagRef;

					              		pagina= element.listarAsientosResponse.asientos.listAsientos.listPag[j].pagina;
					              		var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
					              		url = url.replace( 'transaccion', transaccion);
					              		url = url.replace( 'idImg', idImg);
					              		url = url.replace( 'tipo', tipo);
					              		url = url.replace( 'nroTotalPag', nroPaginas);
					              		url = url.replace( 'nroPagRef', nroPagRef);
					              		url = url.replace( 'pagina', pagina);
					              		htmlAsientos+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';

					              	}
					              	//htmlAsientos+='</div>';
					              	htmlAsientos+='</ul>';
					              	htmlAsientos+='</div>'
					              	htmlAsientos+='</td>';


					              }else{
					              	/*htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos[i].listPag.nroPagRef+'</td>';*/
					              //var pagina=element.listarAsientosResponse.asientos.listAsientos[i].listPag.nroPagRef;

					              nroPagRef= element.listarAsientosResponse.asientos.listAsientos.listPag.nroPagRef;

					              pagina= element.listarAsientosResponse.asientos.listAsientos.listPag.pagina;
					              htmlAsientos+='<td>';
					              htmlAsientos+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
					              var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
					              		url = url.replace( 'transaccion', transaccion);
					              		url = url.replace( 'idImg', idImg);
					              		url = url.replace( 'tipo', tipo);
					              		url = url.replace( 'nroTotalPag', nroPaginas);
					              		url = url.replace( 'nroPagRef', nroPagRef);
					              		url = url.replace( 'pagina', pagina);
					              		htmlAsientos+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';
					              htmlAsientos+='</ul>';
					              htmlAsientos+='</div>'
					              htmlAsientos+='</td>';
			              		}
			              		htmlAsientos+='</tr>';
			              		htmlAsientos+='</table>';
					          	$('#contenedor_asientos').append(htmlAsientos);
					            $("#cargandoAsientos").hide();
					            $("#listo").show();


				        	}else{
				        			/*CONTRUCCION TABLA ASIENTOS*/
	            		htmlAsientos='<table class="table table-bordered table-striped  text-center" id="dataasientos">';
			            htmlAsientos+='<thead class="bg-gray" style="font-size: 14px">';
			            htmlAsientos+='<th>#</th>';
			            htmlAsientos+='<th>ID IMG ASIENTO</th>';
			            htmlAsientos+='<th>NUM PAG.</th>';
			            htmlAsientos+='<th>TIPO</th>';
			            htmlAsientos+='<th>PAGINAS</th>';
			            htmlAsientos+='</thead> ';
			            for(var i=0;i<lenAsientos;i++){
			              var aux=1+i;
			              idImg=element.listarAsientosResponse.asientos.listAsientos[i].idImgAsiento;
			              tipo=element.listarAsientosResponse.asientos.listAsientos[i].tipo;
			              htmlAsientos+='<tr style="font-size: 12px">';
			              htmlAsientos+='<td>'+aux+'</td>';
			              if(element.listarAsientosResponse.asientos.listAsientos[i].idImgAsiento==null){
			                htmlAsientos+='<td></td>';
			              }else{
			              htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos[i].idImgAsiento+'</td>';
			              }

			              if(element.listarAsientosResponse.asientos.listAsientos[i].numPag==null){
			                htmlAsientos+='<td></td>';
			              }else{
			              htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos[i].numPag+'</td>';
			              }
			              if(element.listarAsientosResponse.asientos.listAsientos[i].tipo==null){
			                htmlAsientos+='<td></td>';
			              }else{
			              htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos[i].tipo+'</td>';
			              }

			              if(element.listarAsientosResponse.asientos.listAsientos[i].numPag>1){

			              htmlAsientos+='<td>';
			              htmlAsientos+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
			              	var lenpaginasAsientos=element.listarAsientosResponse.asientos.listAsientos[i].listPag.length;


			              	console.log(lenpaginasAsientos);
			              	for(var j=0;j<lenpaginasAsientos;j++){
			              		nroPagRef= element.listarAsientosResponse.asientos.listAsientos[i].listPag[j].nroPagRef;

			              		pagina= element.listarAsientosResponse.asientos.listAsientos[i].listPag[j].pagina;
			              		var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
			              		url = url.replace( 'transaccion', transaccion);
			              		url = url.replace( 'idImg', idImg);
			              		url = url.replace( 'tipo', tipo);
			              		url = url.replace( 'nroTotalPag', nroPaginas);
			              		url = url.replace( 'nroPagRef', nroPagRef);
			              		url = url.replace( 'pagina', pagina);
			              		htmlAsientos+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';

			              	}
			              	//htmlAsientos+='</div>';
			              	htmlAsientos+='</ul>';
			              	htmlAsientos+='</div>'
			              	htmlAsientos+='</td>';


			              }else{
			              	/*htmlAsientos+='<td>'+element.listarAsientosResponse.asientos.listAsientos[i].listPag.nroPagRef+'</td>';*/
			              //var pagina=element.listarAsientosResponse.asientos.listAsientos[i].listPag.nroPagRef;

			              nroPagRef= element.listarAsientosResponse.asientos.listAsientos[i].listPag.nroPagRef;

			              pagina= element.listarAsientosResponse.asientos.listAsientos[i].listPag.pagina;
			              htmlAsientos+='<td>';
			              htmlAsientos+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
			              var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
			              		url = url.replace( 'transaccion', transaccion);
			              		url = url.replace( 'idImg', idImg);
			              		url = url.replace( 'tipo', tipo);
			              		url = url.replace( 'nroTotalPag', nroPaginas);
			              		url = url.replace( 'nroPagRef', nroPagRef);
			              		url = url.replace( 'pagina', pagina);
			              		htmlAsientos+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';
			              htmlAsientos+='</ul>';
			              htmlAsientos+='</div>'
			              htmlAsientos+='</td>';
			              }

			              htmlAsientos+='</tr>';
			          	}
			          	htmlAsientos+='</table>';
			          	$('#contenedor_asientos').append(htmlAsientos);
			            $("#cargandoAsientos").hide();
			            $("#listo").show();
				        	}

				        }



				        if(element.Fichas==1){
				        	var lenFichas =  element.listarAsientosResponse.asientos.listFichas.listPag.length;
			            /*CONSTRUCCION TABLA FICHAS*/

			            htmlFichas='<table class="table table-bordered table-striped  text-center" id="dataficha">';
			            htmlFichas+='<thead class="bg-gray" style="font-size: 14px">';
			            htmlFichas+='<th>#</th>';
			            htmlFichas+='<th>ID IMG FICHA</th>';
			            htmlFichas+='<th>NUM PAG.</th>';
			            htmlFichas+='<th>TIPO</th>';
			            htmlFichas+='<th>PAGINAS</th>';
			            htmlFichas+='</thead> ';
			            htmlFichas+='<tr style="font-size: 12px">';
			            htmlFichas+='<td>1</td>';
			            idImg=element.listarAsientosResponse.asientos.listFichas.idImgFicha;
			            tipo=element.listarAsientosResponse.asientos.listFichas.tipo;
			            if(element.listarAsientosResponse.asientos.listFichas.idImgFicha==null)
			            {
			            htmlFichas+='<td></td>';
			            }else{
			            htmlFichas+='<td>'+element.listarAsientosResponse.asientos.listFichas.idImgFicha+'</td>';
			            }
			            if(element.listarAsientosResponse.asientos.listFichas.numPag==null)
			            {
			            htmlFichas+='<td></td>';
			            }else{
			            htmlFichas+='<td>'+element.listarAsientosResponse.asientos.listFichas.numPag+'</td>';
			            }
			            if(element.listarAsientosResponse.asientos.listFichas.tipo==null)
			            {
			            htmlFichas+='<td></td>';
			            }else{
			            htmlFichas+='<td>'+element.listarAsientosResponse.asientos.listFichas.tipo+'</td>';
			            }
			            if (element.listarAsientosResponse.asientos.listFichas.numPag>1) {
			            	htmlFichas+='<td>';
			              	htmlFichas+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
			            	var paginas="";

			              	for(var j=0;j<lenFichas;j++){
			              		nroPagRef= element.listarAsientosResponse.asientos.listFichas.listPag[j].nroPagRef;

			              		pagina= element.listarAsientosResponse.asientos.listFichas.listPag[j].pagina;

			              		var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
			              		url = url.replace( 'transaccion', transaccion);
			              		url = url.replace( 'idImg', idImg);
			              		url = url.replace( 'tipo', tipo);
			              		url = url.replace( 'nroTotalPag', nroPaginas);
			              		url = url.replace( 'nroPagRef', nroPagRef);
			              		url = url.replace( 'pagina', pagina);
			              		htmlFichas+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';

			              	}
			              	htmlFichas+='</ul>';
			              	htmlFichas+='</div>'
			              	htmlFichas+='</td>';
			            }else{
			            	//htmlFichas+='<td>'+element.listarAsientosResponse.asientos.listFichas.listPag.nroPagRef+'</td>';

			            	nroPagRef= element.listarAsientosResponse.asientos.listFichas.listPag.nroPagRef;

			              	pagina= element.listarAsientosResponse.asientos.listFichas.listPag.pagina;
			              	htmlFichas+='<td>';
			              	htmlFichas+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
			              	var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
			              		url = url.replace( 'transaccion', transaccion);
			              		url = url.replace( 'idImg', idImg);
			              		url = url.replace( 'tipo', tipo);
			              		url = url.replace( 'nroTotalPag', nroPaginas);
			              		url = url.replace( 'nroPagRef', nroPagRef);
			              		url = url.replace( 'pagina', pagina);
			              		htmlFichas+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';
			              	htmlFichas+='</ul>';
			              	htmlFichas+='</div>'
			              	htmlFichas+='</td>';
			            }


			            htmlFichas+='</tr>';
			            htmlFichas+='</table>';
			          	$('#contenedor_fichas').append(htmlFichas);
				        }



				        if(element.Folios==1){
				        	/*CONSTRUCCION TABLA FOLIO*/
			            var lenFolios =  element.listarAsientosResponse.asientos.listFolios.length;
			            htmlFolios='<table class="table table-bordered table-striped  text-center" id="datafolio">';
			            htmlFolios+='<thead class="bg-gray" style="font-size: 14px">';
			            htmlFolios+='<th>#</th>';
			            htmlFolios+='<th>ID IMG FOLIO</th>';
			            htmlFolios+='<th>TIPO</th>';
			            htmlFolios+='<th>PAGINAS</th>';
			            htmlFolios+='</thead> ';
			            for(var i=0;i<lenFolios;i++){
			            	var aux=1+i;
			            	tipo=element.listarAsientosResponse.asientos.listFolios[i].tipo;
			            	idImg=element.listarAsientosResponse.asientos.listFolios[i].idImgFolio;
			            	htmlFolios+='<tr style="font-size: 12px">';
				            htmlFolios+='<td>'+aux+'</td>';
				            if(element.listarAsientosResponse.asientos.listFolios[i].idImgFolio==null){
				            htmlFolios+='<td></td>';
				            }else{
				            htmlFolios+='<td>'+element.listarAsientosResponse.asientos.listFolios[i].idImgFolio+'</td>';
				            }
				            if(element.listarAsientosResponse.asientos.listFolios[i].tipo==null){
				            htmlFolios+='<td></td>';
				            }else{
				            htmlFolios+='<td>'+element.listarAsientosResponse.asientos.listFolios[i].tipo+'</td>';
				            }
				            if(element.listarAsientosResponse.asientos.listFolios[i].nroPagRef==null){
				            htmlFolios+='<td></td>';
				            }else{
				           // htmlFolios+='<td>'+element.listarAsientosResponse.asientos.listFolios[i].nroPagRef+'</td>';
				            nroPagRef= element.listarAsientosResponse.asientos.listFolios[i].nroPagRef;

			              	pagina= element.listarAsientosResponse.asientos.listFolios[i].pagina;
			              	htmlFolios+='<td>';
			              	htmlFolios+='<div class="dropdown"><button class="btn btn-success  dropdown-toggle" data-toggle="dropdown" type="button">Lista Pag.<span class="caret"></span></button><ul class="dropdown-menu">';
			              	var url="{{URL::action('Pide\VerImagenController@show',['transaccion','idImg','tipo','nroTotalPag','nroPagRef','pagina'])}}";
			              		url = url.replace( 'transaccion', transaccion);
			              		url = url.replace( 'idImg', idImg);
			              		url = url.replace( 'tipo', tipo);
			              		url = url.replace( 'nroTotalPag', nroPaginas);
			              		url = url.replace( 'nroPagRef', nroPagRef);
			              		url = url.replace( 'pagina', pagina);
			              		htmlFolios+='<li class=" tam-cuerpo"><a target="_blank" id="link" href="'+url+'"><button class="btn btn-success" type="submit"><i aria-hidden="true" class="fa fa-eye"></i></button></a>nroPagRef: '+nroPagRef+', Pagina: '+pagina+'</li>';
			              	htmlFolios+='</ul>';
			              	htmlFolios+='</div>'
			              	htmlFolios+='</td>';
				            }
				            htmlFolios+='</tr>';
			          	}

			          	htmlFolios+='</table>';
			          	$('#contenedor_folios').append(htmlFolios);
				        }




			            $("#cargandoFolio").hide();
			            $("#listo").show();
			            $('#txtTransaccion').html("TRANSACCIÓN: "+transaccion);
			            $('#txtNroPag').html("N° DE PÁGINAS: "+nroPaginas);

			            $("#cargandoAsientos").hide();
			            $("#listo").show();
			            $("#cargandoFicha").hide();
			            $("#listo").show();
			            mostrarExito();
			        	}
	            		});

				$('#dataasientos').DataTable({
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


			    	});
			}
		}
	});



</script>
