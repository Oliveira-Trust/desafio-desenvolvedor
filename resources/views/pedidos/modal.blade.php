
    <div id="manterPedidoModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pedido</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form id="formManterPedidos" action=" {{ route('salvarPedido') }} " method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input id="pedidoId" type="hidden" name="id" value="">

                    <div class="modal-body">
                        <div id="msgErroModal" class="alert alert-danger" style="display: none">
                            <p class="m-0"></p>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input id="dt_pedido" type="text" name="dt_pedido" class="form-control datepickerbr" placeholder="Selecione a data" value="" autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Cliente</label>
                            <select id="cliente_id" name="cliente_id" class="form-control">
                                <option value="">Selecione ...</option>
                                @foreach($combos['clientes'] as $chave => $valor)
                                    <option value="{{$valor->id}}">{{$valor->nm_cliente}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Produto</label>
                            <select id="produto_id" name="produto_id" class="form-control">
                                <option value="">Selecione ...</option>
                                @foreach($combos['produtos'] as $chave => $valor)
                                    <option value="{{$valor->id}}">{{$valor->nm_produto}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select id="pedido_status_id" name="pedido_status_id" class="form-control">
                                <option value="">Selecione ...</option>
                                @foreach($combos['status'] as $chave => $valor)
                                    <option value="{{$valor->id}}">{{$valor->nm_status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="salvarPedido" type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>