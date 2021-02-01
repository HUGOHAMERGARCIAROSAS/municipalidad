<div class="modal fade show" id="{{"modal-addadjuntos-".$i->id}}" style="display: none; padding-right: 17px;" aria-modal="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">AGREGAR ARCHIVO ADJUNTO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <iframe src="https://sistema.munivictorlarco.gob.pe/tramiteonline/agregaradjunto?id={{$i->origen}}" frameborder='0' width='99%' height='95%'></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>