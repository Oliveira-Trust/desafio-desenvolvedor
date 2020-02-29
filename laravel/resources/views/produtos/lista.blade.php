@extends('layout.app')

@section('pagetitle')
    <div class="page-title-icon">
        <i class="pe-7s-server bg-tempting-azure">
        </i>
    </div>
    <div>
        Listagem de Produtos
        <div class="page-title-subheading">
            Subtítulo de Listagem de Produtos
        </div>
    </div>
@overwrite

@section('content')

<ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
    <li class="nav-item">
        <a role="tab" class="nav-link show active" id="tab-list" data-toggle="tab" data-trigger="tab" href="#tab-content-list" aria-selected="true">
            <span>Listagem</span>
        </a>
    </li>
    <li class="nav-item">
        <a role="tab" class="nav-link show" id="tab-form" data-toggle="tab" data-trigger="tab" href="#tab-content-form" aria-selected="false">
            <span>Formulário</span>
        </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane tabs-animation fade active show" id="tab-content-list" role="tabpanel">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="card-title">Listagem</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tblListaProdutos" class="mb-0 table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Preço de Venda</th>
                                        <th>Preço de Compra</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane tabs-animation fade" id="tab-content-form" role="tabpanel">
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro</h5>
                        <form id="frmCadCliente" class="needs-validation" novalidate>
                            <input type="hidden" id="id" name="id" value="" />
                            <div class="position-relative form-group">
                                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                                <input name="nome" id="nome" placeholder="Nome" type="text" class="form-control" required>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="venda" class="col-sm-2 col-form-label">Preço de Venda</label>
                                        <input name="venda" id="venda" placeholder="Preço de Venda" type="text" maxlength="10" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="compra" class="col-sm-2 col-form-label">Preço de Compra</label>
                                        <input type="text" name="compra" id="compra" placeholder="Preço de Compra"  maxlength="10" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="position-relative form-group">
                                <label for="email" class="col-sm-2 col-form-label">Descricao</label>
                                <textarea name="descricao" id="descricao" class="form-control" rows="8" required></textarea>
                            </div>

                            <div class="position-relative row form-check">
                                <div class="col-sm-10">
                                    <button class="btn btn-secondary" type="button" onclick="validaForm()">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @overwrite

@section('bodyfooter')
    <script src="{{asset('datatables/datatables.min.js')}}"></script>
    <script src="{{asset('js/jquery.mask.js')}}"></script>
    <script src="{{asset('js/produtos.js')}}"></script>
@overwrite
