<?php


class UtilitariosHtml
{

    public function modalGenerico(){

        $html = '<div class="modal fade" id="modalGenerico" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true" >
             
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalGenericoLabel">Cadastro de Clientes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="formularioModalGenerico">
                                
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

}