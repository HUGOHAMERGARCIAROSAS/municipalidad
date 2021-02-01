<div class="modal fade show" id="modal-default" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirmar Acción</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="modal-nombre">Está seguro de querer cambiar el estado la tarea <b>{{ $t->tar_nombre }}</b></p>
      </div>
      <div class="modal-footer justify-content-between">
        {!! Form::open(['url'=>'administracion/tareas/estado/','method'=>'POST']) !!}
        {!! Form::token() !!}
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="estado" id="estado">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close()!!}
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
