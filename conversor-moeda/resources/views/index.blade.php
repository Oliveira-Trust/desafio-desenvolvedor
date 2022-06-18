@extends('master')

@section('js-view')
    <script src='/js/jquery.mask.js'></script>
    <script src="/js/cotacao.js"></script>
    <script src="/js/functions.js"></script>
@endsection

@section('css-view')
@endsection

@section('conteudo-view')
    <nav>
        <div class="nav-wrapper menu-superior">
            <a href="#!" class="brand-logo">Cotação</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li> <a class="waves-effect waves-light btn modal-trigger" id="btn_modal1" href="#modal1">Login</a></li>
                <li> <a class="waves-effect waves-light btn modal-trigger" id="btn_modal2" href="#modal2">Cadastrar</a></li>
            </ul>
        </div>
    </nav>


    <div class="container">
        <div class="masonry row m-t-20">

            <div class="row" id="stats"></div>

            <div class="section row">
                <div class="col s12">
                    <div class="center-align msg_warning displayNone" id="msg_retorno"></div>
                    <div class="row">

                        <div class="input-field col m2 s12">
                            <select class="disabled">
                                <option value="" disabled selected>Real</option>
                            </select>
                            <label>Moeda de origem</label>
                        </div>

                        <div class="input-field col m3 s12">
                            <input id="valor_real" type="text" class="validate">
                            <label for="valor_real">Valor a ser convertido</label>
                        </div>

                        <div class="col m1 s12 center-align icon_swap">
                            <i class="keyboard_arrow_up material-icons prefix">arrow_forward</i>
                        </div>

                        <div class="input-field col m3 s12">
                            <select id="moedas_conversao">
                                <option value="USD">Dólar Americano</option>
                                <option value="EUR">Euro</option>
                                <option value="GBP">Libra Esterlina</option>
                                {{-- <option value="BTC">Bitcoin</option> --}}
                            </select>
                            <label>Moeda de destino</label>
                        </div>

                        <div class="input-field col m3 s12">
                            <select id="forma_pgto">
                                <option value="BOLETO">BOLETO</option>
                                <option value="CARTAO">CARTÃO DE CRÉDITO</option>
                            </select>
                            <label>Forma de pagamento</label>
                        </div>

                        <div class="center-align col s12">
                            <button id="btn_convert"
                                class="btn-convert btn waves-effect waves-light center-align indigo lighten-1"
                                type="submit" name="action">CONVERTER
                                <i class="material-icons right">attach_money</i>

                            </button>
                        </div>


                    </div>
                </div>

            </div>

            <div class="section row">
                <ul class="collection" id="ret">
                </ul>

            </div>

            <div class="section row">
                <h6 class="center-align">Histórico</h6>
                <div id="historico">
                </div>

            </div>

        </div>
    </div>



    <!-- Modal Structure -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Login</h4>
            <div class="input-field col s12">
                <input id="email_login" type="text" class="validate">
                <label for="email_login">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="senha_login" type="password" class="validate">
                <label for="senha_login">Senha</label>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_login">Acessar</a>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="modal2" class="modal">
        <div class="modal-content">
            <h4>Cadastrar</h4>
            <div class="input-field col s12">
                <input id="nome_cadastro" type="text" class="validate">
                <label for="nome_cadastro">Nome</label>
            </div>
            <div class="input-field col s12">
                <input id="email_cadastro" type="text" class="validate">
                <label for="email_cadastro">Email</label>
            </div>
            <div class="input-field col s12">
                <input id="senha_cadastro" type="password" class="validate">
                <label for="senha_cadastro">Senha</label>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="btn_cadastro">Cadastrar</a>
        </div>
    </div>
@endsection
