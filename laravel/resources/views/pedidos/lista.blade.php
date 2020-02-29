@extends('layout.app')

@section('pagetitle')
    <div class="page-title-icon">
        <i class="pe-7s-graph bg-tempting-azure">
        </i>
    </div>
    <div>
        Listagem de Pedidos
        <div class="page-title-subheading">
            Subtítulo de Listagem de Pedidos
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
                            <table id="tblListaPedidos" class="mb-0 table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Produto</th>
                                        <th>Cliente</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Quantidade</th>
                                        <th>ValorTotal</th>
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

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="produto" class="col-sm-2 col-form-label">Produto</label>
                                        <select name="produto" id="produto" class="form-control" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="cliente" class="col-sm-2 col-form-label">Cliente</label>
                                        <select name="cliente" id="cliente" class="custom-select col-sm-12" required>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="quantidade" class="col-sm-2 col-form-label">Quantidade</label>
                                        <input name="quantidade" id="quantidade" value="1" min="1" type="number" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="valorTotal" class="col-sm-2 col-form-label">Total</label>
                                        <input name="valorTotal" id="valorTotal" type="text" class="form-control" readonly required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="dataCompra" class="col-sm-3 col-form-label">Data da Compra</label>
                                        <input type="datetime" name="dataCompra" id="dataCompra" class="form-control" rows="8" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option value=""> Selecione um Status </option>
                                            <option value="Em Aberto"> Em Aberto </option>
                                            <option value="Pago"> Pago </option>
                                            <option value="Cancelado"> Cancelado </option>
                                        </select>
                                    </div>
                                </div>
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
    <script src="{{asset('js/select2.full.js')}}"></script>
    <script src="{{asset('js/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('js/pedidos.js')}}"></script>
@overwrite
