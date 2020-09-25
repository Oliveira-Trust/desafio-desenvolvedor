<div class="row">
    <div class="col">
        <div class="collapse multi-collapse" id="filtros">
            <form method="POST" action="{{ route('filtrarPedidos') }}">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Filtro de pesquisa</h3>
                    </div>

                    <!-- Card body -->
                    <div class="card-body">
                        <div class="pl-lg">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="control-label">Nome</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input type="text" name="dt_pedido" class="form-control datepickerbr" placeholder="Selecione a data" value="{{ (isset($campos['dt_pedido']) ? $campos['dt_pedido'] : '') }}">
                                    </div>    
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Cliente</label>
                                    <select name="cliente_id" class="form-control">
                                        <option value="">Selecione ...</option>
                                        @foreach($combos['clientes'] as $chave => $valor)
                                            <option value="{{$valor->id}}" {{ (isset($campos['cliente_id']) && $campos['cliente_id'] == $valor->id ? 'selected' : '') }}>{{$valor->nm_cliente}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Produto</label>
                                    <select name="produto_id" class="form-control">
                                        <option value="">Selecione ...</option>
                                        @foreach($combos['produtos'] as $chave => $valor)
                                            <option value="{{$valor->id}}" {{ (isset($campos['produto_id']) && $campos['produto_id'] == $valor->id ? 'selected' : '') }}>{{$valor->nm_produto}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="control-label">Status</label>
                                    <select name="pedido_status_id" class="form-control">
                                        <option value="">Selecione ...</option>
                                        @foreach($combos['status'] as $chave => $valor)
                                            <option value="{{$valor->id}}" {{ (isset($campos['pedido_status_id']) && $campos['pedido_status_id'] == $valor->id ? 'selected' : '') }}>{{$valor->nm_status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label class="control-label">Ordernar por</label>
                                    <select name="campo_ordenacao" class="form-control">
                                        @foreach($listaOrdenacao as $chave => $valor)
                                            <option value="{{$chave}}" {{ ((isset($campos['campo_ordenacao']) && $campos['campo_ordenacao'] === $chave) ? 'selected' : '') }}>{{$valor}}</option>
                                        @endforeach
                                     </select>
                                </div>
                                <div class="col-6">
                                    <label class="control-label">Ordenar como</label>
                                    <select name="tp_ordem" class="form-control">
                                        <option value="asc" {{ ((isset($campos['tp_ordem'])  && $campos['tp_ordem'] === 'asc') ? 'selected' : '') }}>Crescente</option>
                                        <option value="desc" {{ ((isset($campos['tp_ordem']) && $campos['tp_ordem'] === 'desc') ? 'selected' : '') }}>Decrescente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Pesquisar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>