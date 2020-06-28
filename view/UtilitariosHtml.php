<?php


class UtilitariosHtml
{

    public function modalInserirGenerico(){

        $html = '<div class="modal fade" id="modalInserirGenerico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true" >
             
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="labelModalInserirGenerico"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="formularioModalInserirGenerico">
                                
                            </div>
                            <div class="modal-footer">
                                <button id="botaoCancelarModal" type="button" class="btn btn-secondary" 
                                    data-dismiss="modal">
                                    Cancelar
                                </button>
                                
                                <button id="botaoSalvarModal" type="button" class="btn btn-primary">
                                    Inserir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';

                echo $html;

    }


    public function modalEditarGenerico(){

        $html = '<div class="modal fade" id="modalEditarGenerico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true" >
             
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalGenericoLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="formularioModalEditarGenerico">
                                
                            </div>
                            <div class="modal-footer">
                                <button id="botaoCancelarModal" type="button" class="btn btn-secondary" 
                                    data-dismiss="modal">
                                    Cancelar
                                </button>
                                
                                <button id="botaoSalvaAlteracoesModal" type="button" class="btn btn-primary">
                                    Salvar alterações
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';

        echo $html;

    }

}