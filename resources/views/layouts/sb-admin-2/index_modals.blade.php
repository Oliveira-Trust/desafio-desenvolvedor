<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-excluir-titulo">{!! $titulo !!} </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card ">
                <div class="card-body" id="div-modal-excluir-msg" >
                    {!! $mensagem !!}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <form id="form-modal-excluir" action="" class="" method="POST" >
                @csrf
                @method('DELETE')
                <button class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-sign-out-alt fa-rotate-180"></i>
                    </span>
                    <span class="text">Cancelar</span>
                </button>
                <button type="submit" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-times-circle"></i>
                    </span>
                    <span class="text">Sim</span>
                </button>
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelAdmin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal-admin-titulo">{!! $titulo !!} </h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card ">
                <div class="card-body" id="div-modal-admin-msg" >
                    {!! $mensagem !!}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <form id="form-modal-admin" action="" class="" method="POST" >
                @csrf
                @method('DELETE')
                <button class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-sign-out-alt fa-rotate-180"></i>
                    </span>
                    <span class="text">Sair</span>
                </button>
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-times-circle"></i>
                    </span>
                    <span class="text">Sim</span>
                </button>
            </form>
        </div>
        </div>
    </div>
</div>