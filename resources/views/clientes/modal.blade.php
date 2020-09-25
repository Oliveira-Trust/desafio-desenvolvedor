
    <div id="manterClienteModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cliente</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form id="formManterClientes" action=" {{ route('salvarCliente') }} " method="POST">
                    {{ csrf_field() }}

                    <input id="clienteId" type="hidden" name="id" value="">

                    <div class="modal-body">
                        <div id="msgErroModal" class="alert alert-danger" style="display: none">
                            <p class="m-0"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nome</label>
                            <input id="nm_cliente" type="text" class="form-control" name="nm_cliente" maxlength="255" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Telefone</label>
                            <input id="telefone" type="text" class="form-control" name="telefone" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">E-mail</label>
                            <input id="email" type="text" class="form-control" name="email" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Cpf</label>
                            <input id="cpf" type="text" class="form-control mask_cpf" name="cpf" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Endereço completo</label>
                            <input id="endereco_completo" type="text" class="form-control" name="endereco_completo" maxlength="255">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="salvarCliente" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>