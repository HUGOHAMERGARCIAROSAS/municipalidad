<div class="modal fade" id="{{"modal-cambiarpass"}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open(['url'=>'cambiarpass','method'=>'POST','id'=>'CambiarPassForm']) !!}
            {!! Form::token() !!}
            <div class="modal-header text-center">
                <h4 class="modal-title">CAMBIAR CONTRASEÑA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label>Antigua contraseña: </label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group-sm">
                            <input type="password" name="old_pass" class="form-control form-control-sm input-sm" id="old">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label>Nueva contraseña: </label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group-sm">
                            <input type="password" name="new_pass" class="form-control form-control-sm" id="new">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body text-left">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label>Confirmar contraseña: </label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="form-group-sm">
                            <input type="password" name="confirm_pass" class="form-control form-control-sm" id="confirm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="return validarPass();">Cambiar</button>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
</div>
