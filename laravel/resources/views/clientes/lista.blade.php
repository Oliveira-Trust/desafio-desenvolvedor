@extends('layout.app')

@section('pagetitle')
    <div class="page-title-icon">
        <i class="pe-7s-id bg-tempting-azure">
        </i>
    </div>
    <div>
        Listagem de Clientes
        <div class="page-title-subheading">
            Subtítulo de Listagem de Clientes
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
                            <table id="tblListaClientes" class="mb-0 table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Sexo</th>
                                        <th>Endereço</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
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
                            <input type="hidden" id="id" name="id" />
                            <div class="position-relative form-group">
                                <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                                <input name="nome" id="nome" placeholder="Nome" type="text" class="form-control" required>
                            </div>
                            <div class="position-relative form-group">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <input name="email" id="email" placeholder="Email" type="email" class="form-control" required>
                            </div>
                            <div class="position-relative form-group">
                                <label for="senha" class="col-sm-2 col-form-label">Senha</label>
                                <input name="senha" id="senha" placeholder="Senha" type="password" class="form-control" required>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                                        <input type="text" name="telefone" id="telefone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="position-relative form-group">
                                        <label for="celular" class="col-sm-2 col-form-label">Celular</label>
                                        <input type="text" name="celular" id="celular" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="cep" class="col-sm-2 col-form-label">CEP</label>
                                        <input type="text" name="cep" maxlength="9" id="cep" class="form-control" required>
                                        <button onclick="buscaCep()" type="button" class="mb-2 mr-2 btn btn-info"><i class="fa fa-search">
                                            </i> Buscar
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="">Selecione um estado</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="cidade" class="col-sm-3 col-form-label">Cidade</label>
                                        <input type="text" name="cidade" id="cidade" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="bairro" class="col-sm-3 col-form-label">Bairro</label>
                                        <input type="text" name="bairro" id="bairro" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="logradouro" class="col-sm-4 col-form-label">Logradouro</label>
                                        <input type="text" name="logradouro" id="logradouro" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="numero" class="col-sm-3 col-form-label">Número</label>
                                        <input type="text" name="numero" id="numero" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-8">
                                    <div class="position-relative form-group">
                                        <label for="complemento" class="col-sm-4 col-form-label">Complemento</label>
                                        <input type="text" name="complemento" id="complemento" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="position-relative row form-group">
                                        <legend class="col-form-label col-sm-2">Sexo</legend>
                                        <div class="col-sm-10">
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="sexo" type="radio" class="form-check-input" value="M"> Masculino
                                                </label>
                                            </div>
                                            <div class="position-relative form-check">
                                                <label class="form-check-label">
                                                    <input name="sexo" type="radio" class="form-check-input" value="F"> Feminino
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>
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
    <script src="{{asset('js/clientes.js')}}"></script>
@overwrite
