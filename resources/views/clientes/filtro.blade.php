<div class="row">
    <div class="col">
        <div class="collapse multi-collapse" id="filtros">
            <form method="POST" action="{{ route('filtrarClientes') }}">
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
                                    <input type="text" name="nm_cliente" class="form-control" value="{{ (isset($campos['nm_cliente']) ? $campos['nm_cliente'] : '') }}">
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Telefone</label>
                                    <input type="text" name="telefone" class="form-control" value="{{ (isset($campos['telefone']) ? $campos['telefone'] : '') }}">
                                </div>
                                <div class="col-4">
                                    <label class="control-label">E-mail</label>
                                    <input type="text" name="email" class="form-control" value="{{ (isset($campos['email']) ? $campos['email'] : '') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label class="control-label">Cpf</label>
                                    <input type="text" name="cpf" class="form-control" value="{{ (isset($campos['cpf']) ? $campos['cpf'] : '') }}">
                                </div>
                                <div class="col-4">
                                    <label class="control-label">Endereço</label>
                                    <input type="text" name="endereco_completo" class="form-control" value="{{ (isset($campos['endereco_completo']) ? $campos['endereco_completo'] : '') }}">
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