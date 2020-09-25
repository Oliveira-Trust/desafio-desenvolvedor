
    <div id="manterProdutoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Produto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form id="formManterProdutos" action=" {{ route('salvarProduto') }} " method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input id="produtoId" type="hidden" name="id" value="">

                    <div class="modal-body">
                        <div id="msgErroModal" class="alert alert-danger" style="display: none">
                            <p class="m-0"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nome</label>
                            <input id="nm_produto" type="text" class="form-control" name="nm_produto" maxlength="255" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Descrição</label>
                            <input id="ds_produto" type="text" class="form-control" name="ds_produto" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Valor</label>
                            <input id="vl_produto" type="text" class="form-control money" name="vl_produto" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Foto</label>
                            <input id="foto" type="file" class="form-control" name="foto" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="salvarProduto" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>