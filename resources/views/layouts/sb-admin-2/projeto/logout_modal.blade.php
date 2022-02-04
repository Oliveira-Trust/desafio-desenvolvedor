<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deseja sair do sistema ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card shadow mb-4">
                <!-- <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
                </div> -->
                <div class="card-body">
                <div class="col-lg-12">
                    Selecione "Sair" abaixo se você estiver pronto para encerrar sua sessão atual.
                    <br />
                    <br />
                </div>
                <div class="col-lg-12">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        @csrf
                        <button class="btn btn-danger btn-icon-split" type="button" data-dismiss="modal">
                            <span class="icon text-white-50">
                                <i class="fas fa-times"></i>
                            </span>
                            <span class="text">Cancelar</span>
                        </button>
                        <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            <span class="text">Sair</span>
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        </div>
        </div>
    </div>
</div>