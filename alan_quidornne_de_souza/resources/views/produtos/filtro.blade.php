<div class="row">
    <div class="col">
        <div class="collapse multi-collapse" id="filtros">
            <form method="POST" action="{{ route('filtrarProdutos') }}">
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
                                    <input type="text" name="nm_produto" class="form-control" value="{{ (isset($campos['nm_produto']) ? $campos['nm_produto'] : '') }}">
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Descrição</label>
                                    <input type="text" name="ds_produto" class="form-control" value="{{ (isset($campos['ds_produto']) ? $campos['ds_produto'] : '') }}">
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Valor</label>
                                    <input type="text" name="vl_produto" class="form-control money" value="{{ (isset($campos['vl_produto']) ? $campos['vl_produto'] : '') }}">
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