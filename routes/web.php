<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//lucas@MANUEL1

Route::get('/', 'WelcomeController@verPrincipal')->name('/');
Route::get('/home', 'WelcomeController@home')->name('home');
Route::get('/logout', 'WelcomeController@logout')->name('logout');

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('/modulos/{modulo}', 'WelcomeController@modulos')->name('modulo');
    Route::post('/cambiarpass','WelcomeController@cambiarPass');


    //Pide

    Route::get('/pide', function () {
        return view('pide.home');
    })->name('pide');

    Route::group(['namespace' => 'Pide'], function () {
        Route::resource('pide/reniec/dni/consultar', 'DniController');
        Route::get('reniec/dni/consultar/show', 'DniController@show')->name('reniec.dni.consultar.show');

        Route::resource('pide/sunarp/aeronave/consultar', 'AeronaveController');


        Route::resource('pide/sunarp/razonsocial/consultar', 'RazonSocialController');
        Route::get('pide/sunarp/razonsocial/consultar/show', 'RazonSocialController@show')->name('sunarp.razonsocial.consultar.show');


        Route::resource('pide/sunarp/titularidad/consultar', 'TitularidadController');
        Route::get('pide/sunarp/titularidad/consultar/show', 'TitularidadController@show')->name('sunarp.titularidad.consultar.show');
        Route::get('pide/sunarp/titularidad/imprimir', 'TitularidadController@imprimir')->name('sunarp.titularidad.imprimir');


        Route::resource('pide/sunarp/oficinas/consultar', 'OficinasController');


        Route::resource('pide/sunarp/asientos/consultar', 'AsientosController');
        Route::get('pide/sunarp/asientos/consultar/show', 'AsientosController@show')->name('sunarp.asientos.consultar.show');


        Route::resource('pide/sunarp/vehiculos/consultar', 'VehiculosController');
        Route::get('pide/sunarp/vehiculos/consultar/show', 'VehiculosController@show')->name('sunarp.vehiculos.consultar.show');
        Route::get('pide/sunarp/vehiculos/imprimir', 'VehiculosController@imprimir')->name('sunarp.vehiculos.imprimir');

        Route::get('pide/imagen/{transaccion}/{idImg}/{tipo}/{nroTotalPag}/{nroPagRef}/{pagina}', 'VerImagenController@show')->name('verimagen');
    });


    //tramite documentario
    Route::get('/tramitedocumentario', function () {
        return view('tramitedocumentario');
    })->name('tramitedocumentario');

    Route::group(['namespace' => 'TramiteExterno'], function () {
        Route::get('tramitedocumentario/expedientes', 'ExpedientesController@mantenedorExpedientes');
        Route::get('tramitedocumentario/expediente', 'ExpedientesController@verExpediente');
        Route::post('tramitedocumentario/expediente/editar', 'ExpedientesController@editarExpediente');
        Route::post('tramitedocumentario/expediente/anular', 'ExpedientesController@anulaExpediente');
        Route::get('tramitedocumentario/expedientes/verbarcode', 'ExpedientesController@verCodigoBarras');
        Route::get('tramitedocumentario/correlativos', 'CorrelativoController@listarCorrelativo');
        Route::post('tramitedocumentario/correlativo/anular', 'CorrelativoController@anularCorrelativo');
        Route::get('tramitedocumentario/movimientos', 'ExpedientesController@verMovimientosExpedientes');
        Route::get('tramitedocumentario/correlativostrb', 'CorrelativoController@listarCorrelativoTrb');
        Route::post('tramitedocumentario/correlativotrb/anular', 'CorrelativoController@anularCorrelativoTrb');
        Route::get('tramitedocumentario/movimientosar', 'ExpedientesController@verMovimientosArchivos');
        Route::get('tramitedocumentario/tipotramites', 'TipoTramiteController@verTipoTramite');
        Route::get('tramitedocumentario/tipotramite', 'TipoTramiteController@editarTipoTramite');
        Route::get('tramitedocumentario/tipotramite/nuevo', 'TipoTramiteController@nuevoTipoTramite');
        Route::post('tramitedocumentario/tipotramite/registrar', 'TipoTramiteController@registrarTipoTramite');
        Route::post('tramitedocumentario/tipotramite/editar', 'TipoTramiteController@verTipoTramite');
        Route::post('tramitedocumentario/tipotramite/anular', 'TipoTramiteController@anularTipoTramite');
        Route::get('tramitedocumentario/informestrp', 'InformesController@verInformesTrbPendientes');
        Route::post('tramitedocumentario/informetrp/proveer', 'InformesController@proveerInforme');
        Route::post('tramitedocumentario/informetrp/archivar', 'InformesController@archivarInforme');
        Route::get('tramitedocumentario/movimientosgr', 'ExpedientesController@verMovimientosGer');
        Route::get('tramitedocumentario/proveidos', 'InformesController@verProveidos');
        Route::post('tramitedocumentario/proveido/anular', 'InformesController@anularProveido');
        Route::get('tramitedocumentario/informes', 'InformesController@verInformes');
        Route::post('tramitedocumentario/informe/anular', 'InformesController@anularInforme');
        Route::post('tramitedocumentario/informe/anexar', 'InformesController@anexarAInforme');
        Route::get('tramitedocumentario/informestrb', 'InformesController@verInformesTrabajador');
        Route::post('tramitedocumentario/informetrb/proveer', 'InformesController@proveerInforme');
        Route::post('tramitedocumentario/informetrb/archivar', 'InformesController@archivarInforme');
        Route::get('tramitedocumentario/expediente/registrarv', 'ExpedientesController@nuevoExpedienteV');
        Route::post('tramitedocumentario/expediente/registrarv', 'ExpedientesController@regExpediente');
        Route::get('tramitedocumentario/expediente/registrar', 'ExpedientesController@nuevoExpediente');
        Route::post('tramitedocumentario/expediente/registrar', 'ExpedientesController@regExpediente');
        Route::get('tramitedocumentario/seguimiento', 'SeguimientoDocumentoController@seguimientoExpedientes');
        Route::post('tramitedocumentario/seguimiento', 'SeguimientoDocumentoController@buscarExpediente');
        Route::get('tramitedocumentario/seguimiento/imprimir', 'SeguimientoDocumentoController@imprimirSeguimiento');
        Route::get('tramitedocumentario/exppendientes', 'ExpedientesController@pendientesRecibir');
        Route::post('tramitedocumentario/expediente/recibir', 'ExpedientesController@recibirExpediente');
        Route::get('tramitedocumentario/exppendientes/estado', 'ExpedientesController@estadoExpediente');
        Route::get('tramitedocumentario/gestionexpedientes', 'ExpedientesController@gestionExpedientes');
        Route::post('tramitedocumentario/expediente/derivar', 'ExpedientesController@derivarExpediente');
        Route::post('tramitedocumentario/expediente/archivar', 'ExpedientesController@archivarExpediente');
        Route::post('tramitedocumentario/expediente/proveer', 'ExpedientesController@proveerExpediente');
        Route::get('tramitedocumentario/reginformes', 'InformesController@informesGenerales');
        Route::get('tramitedocumentario/exppendientesfirma', 'ExpedientesController@pendientesFirma');
        Route::get('tramitedocumentario/exppendientestrab', 'ExpedientesController@pendientesTrabajador');
        Route::get('tramitedocumentario/tickets', 'ProcesosWebController@listarTickets');
        Route::get('tramitedocumentario/tickets/nuevo', 'ProcesosWebController@generaTicket');
        Route::get('tramitedocumentario/tributos', 'ProcesosWebController@buscarTributo');
        Route::get('tramitedocumentario/solicitudes', 'ProcesosWebController@listarSolicitudesWeb');
        Route::get('tramitedocumentario/solicitudes/adjuntos', 'ProcesosWebController@verAdjuntosSolicitud');
        Route::post('tramitedocumentario/solicitudes/anular', 'ProcesosWebController@anularSolicitudWeb');
        Route::post('tramitedocumentario/solicitudes/derivar', 'ProcesosWebController@derivarSolicitudWeb');
        Route::post('tramitedocumentario/solicitudes/verificar', 'ProcesosWebController@verificarSolicitudWeb');
        Route::get('tramitedocumentario/solicitudes/movimientos', 'ProcesosWebController@movimientosSolicitudesWeb');
        Route::get('tramitedocumentario/solicitudesv', 'ProcesosWebController@listarSolicitudesWebVerificadas');
        Route::get('tramitedocumentario/rexpregfecha', 'ReportesController@verExpRegFechas');
        Route::post('tramitedocumentario/rexpregfecha', 'ReportesController@verExpRegFechas');
        Route::get('tramitedocumentario/rexpregfechaarea', 'ReportesController@verExpRegFechasArea');
        Route::post('tramitedocumentario/rexpregfechaarea', 'ReportesController@verExpRegFechasArea');
        Route::get('tramitedocumentario/rexprecfecha', 'ReportesController@verExpRecFechas');
        Route::post('tramitedocumentario/rexprecfecha', 'ReportesController@verExpRecFechas');
        Route::get('tramitedocumentario/rexprecfechaarea', 'ReportesController@verExpRecFechasArea');
        Route::post('tramitedocumentario/rexprecfechaarea', 'ReportesController@verExpRecFechasArea');
        Route::get('tramitedocumentario/rexpnrodias', 'ReportesController@verExpNroDias');
        Route::post('tramitedocumentario/rexpnrodias', 'ReportesController@verExpNroDias');
        Route::get('tramitedocumentario/rexpderfecha', 'ReportesController@verExpDerFechas');
        Route::post('tramitedocumentario/rexpderfecha', 'ReportesController@verExpDerFechas');
        Route::get('tramitedocumentario/rexpderfechaarea', 'ReportesController@verExpDerFechasArea');
        Route::post('tramitedocumentario/rexpderfechaarea', 'ReportesController@verExpDerFechasArea');
        Route::get('tramitedocumentario/rexpasunto', 'ReportesController@verExpAsunto');
        Route::post('tramitedocumentario/rexpasunto', 'ReportesController@verExpAsunto');
        Route::get('tramitedocumentario/rexparchfecha', 'ReportesController@verExpArchFechas');
        Route::post('tramitedocumentario/rexparchfecha', 'ReportesController@verExpArchFechas');
        Route::get('tramitedocumentario/rexparchfechaarea', 'ReportesController@verExpArchFechasArea');
        Route::post('tramitedocumentario/rexparchfechaarea', 'ReportesController@verExpArchFechasArea');
        Route::get('tramitedocumentario/rexppend', 'ReportesController@verExpPendientes');
        Route::post('tramitedocumentario/rexppend', 'ReportesController@verExpPendientes');
        Route::get('tramitedocumentario/restadexpest', 'ReportesController@verEstdExpEstado');
        Route::post('tramitedocumentario/restadexpest', 'ReportesController@verEstdExpEstado');
        Route::get('tramitedocumentario/rtptraexp', 'ReportesController@verEstadExpTptra');
        Route::post('tramitedocumentario/rtptraexp', 'ReportesController@verEstadExpTptra');
        Route::get('tramitedocumentario/restadexparea', 'ReportesController@verEstadExpArea');
        Route::post('tramitedocumentario/restadexparea', 'ReportesController@verEstadExpArea');
        Route::get('tramitedocumentario/restadexpanual', 'ReportesController@verEstadExpAnual');
        Route::post('tramitedocumentario/restadexpanual', 'ReportesController@verEstadExpAnual');
        Route::get('tramitedocumentario/restadexpmensual', 'ReportesController@verEstadExpMensual');
        Route::post('tramitedocumentario/restadexpmensual', 'ReportesController@verEstadExpMensual');
        Route::get('tramitedocumentario/expreportesgenerales', 'ReportesController@verReportesGenerales');
        Route::get('tramitedocumentario/expmodificados', 'ReportesController@verexpModificados');
        Route::get('tramitedocumentario/expeliminados', 'ReportesController@verexpEliminados');
        Route::get('tramitedocumentario/movmodificados', 'ReportesController@verMovModificados');
        Route::get('tramitedocumentario/moveliminados', 'ReportesController@verMovEliminados');
        Route::get('tramitedocumentario/areaderivados', 'ReportesController@verAreasDeriva');
        Route::post('tramitedocumentario/areaderivados', 'ReportesController@verAreasDeriva');
        Route::get('tramitedocumentario/procesos', 'TupaController@verTupa');
        Route::post('tramitedocumentario/procesos', 'TupaController@verTupa');
        Route::get('tramitedocumentario/proceso', 'TupaController@editarTupa');
        Route::post('tramitedocumentario/proceso', 'TupaController@actualizarTupa');
        Route::get('tramitedocumentario/procesos/registrar', 'TupaController@nuevoTupa');
        Route::post('tramitedocumentario/procesos/registrar', 'TupaController@registrarTupa');
        Route::post('tramitedocumentario/proceso/activar', 'TupaController@activaTupa');
        Route::post('tramitedocumentario/proceso/anular', 'TupaController@anulaTupa');
        Route::get('tramitedocumentario/bandeja', 'ExpedientesController@bandejaEntrada');
        Route::get('tramitedocumentario/detallebandeja', 'ExpedientesController@detalleBandeja');
        Route::get('tramitedocumentario/estadobandeja', 'ExpedientesController@estadoBandeja');
    });
});





