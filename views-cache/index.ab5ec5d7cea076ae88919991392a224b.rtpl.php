<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- start: page -->

<div class="row "  >


  
  

  <div class="col-lg-12 col-xl-4">
  
  
  
    <?php if( $sucess ){ ?>

    <div class="alert alert-success  mb-1 mt-1 text-center"  >
    
    <strong class="text-dark"><?php echo htmlspecialchars( $sucess, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>
    </div>
    
    <?php } ?>
    
    
    
    
    <?php if( $error ){ ?>
    
    <div class="alert alert-danger  mb-1 mt-1 text-center" >
    
    <strong class="text-dark">Ocorreu um erro inesperado! </strong> <strong><?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>
    </div>
    
    <?php } ?>
   


    <div class="row">
    
      <div class="col-12">
        <div class="card card-modern">
          <div class="card-body p-0">
            <div class="widget-user-info">
              <div class="widget-user-info-header bg-primary">
                <h2 class="font-weight-bold text-color-dark text-5 text-white">Olá, <?php echo htmlspecialchars( $user["desperson"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h2>
                <p class="mb-0 text-white"><?php if( $user["inadmin"] == 1 ){ ?>Administrador<?php }else{ ?>Conta de Comprador/Vendedor<?php } ?></p>

                <div class="widget-user-acrostic bg-primary">
                  <span class="font-weight-bold">VH</span>
                </div>
              </div>
              <div class="widget-user-info-body">
                <div class="row">
                  <div class="col-auto">
                    <strong class="text-color-dark text-5">R$ TESTE</strong>
                    <h3 class="text-4-1">Valor Total Recebido</h3>
                  </div>
                  <div class="col-auto">
                    <strong class="text-color-dark text-5">TESTE</strong>
                    <h3 class="text-4-1">Planos vendidos</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <a href="/dashboard/mudar-informacao" class="btn btn-danger btn-xl border font-weight-semibold text-color-dark text-3 mt-4">Configurações</a>
                   
                  </div>
                  <div class="col">
                    <a href="/" class="btn btn-success btn-xl border font-weight-semibold text-color-dark text-3 mt-4">Voltar para o Site</a>
                  </div>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="row">
      <div class="col-lg-6 col-xl-12 pb-2 pb-lg-0 mb-4 mb-lg-0">
        <div class="card card-modern">
          <div class="card-body py-4">
            <div class="row align-items-center">
              <div class="col-6 col-md-4">
                <h3 class="text-4-1 my-0">Total de clientes</h3>
                <strong class="text-6 text-color-dark">TESTE</strong>
              </div>
              <div class="col-6 col-md-4 border border-top-0 border-right-0 border-bottom-0 border-color-light-grey py-3">
                <h3 class="text-4-1 text-color-success line-height-2 my-0">Clientes <strong>Registrados &uarr;</strong></h3>
                <span>Todos os Dias</span>
              </div>
              <div class="col-md-4 text-left text-md-right pr-md-4 mt-4 mt-md-0 text-white">
                <i class="bx bx-cart-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-xl-12 pt-xl-2 mt-xl-4">
        <div class="card card-modern">
          <div class="card-body py-4">
            <div class="row align-items-center">
              <div class="col-6 col-md-4">
                <h3 class="text-4-1 my-0">Vendas Totais</h3>
                <strong class="text-6 text-color-dark">TESTE</strong>
              </div>
              <div class="col-6 col-md-4 border border-top-0 border-right-0 border-bottom-0 border-color-light-grey py-3">
                <h3 class="text-4-1 text-color-success line-height-2 my-0">Vendas <strong>Concluídas &uarr;</strong></h3>
                <span>Todos os Dias</span>
              </div>
              <div class="col-md-4 text-left text-md-right pr-md-4 mt-4 mt-md-0 text-white">
                <i class="bx bx-purchase-tag-alt icon icon-inline icon-xl bg-primary rounded-circle text-color-light pr-0"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <div class="col-lg-12 col-xl-8 pt-2 pt-xl-0 mt-4 mt-xl-0">
    
    


    <div class="row">
      <div class="col">
        
        <div class="card card-modern card-modern-table-over-header">
          <div class="card-header">
            <div class="card-actions">
              <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
            </div>
            <h2 class="card-title">Lista dos seus produtos vendidos</h2>
          </div>
          <div class="card-body">
            <div class="datatables-header-footer-wrapper">
              <div class="datatable-header">
                <div class="row align-items-center mb-3">
  


                  <div class="col-8 col-lg-auto ml-auto mb-3 mb-lg-0">
                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                      <label class="ws-nowrap mr-3 mb-0">Filtar Por:</label>
                      <select class="form-control select-style-1 filter-by" name="filter-by">
                        <option value="all" selected>Mostrar tudo</option>
                     
                      </select>
                    </div>
                  </div>
                  <div class="col-4 col-lg-auto pl-lg-1 mb-3 mb-lg-0">
                    <div class="d-flex align-items-lg-center flex-column flex-lg-row">
                      <label class="ws-nowrap mr-3 mb-0">Colunas:</label>
                      <select class="form-control select-style-1 results-per-page" name="results-per-page">
                        <option value="7" selected>7</option>
                        <option value="24">24</option>
                        <option value="36">36</option>
                        <option value="100">100</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-lg-auto pl-lg-1">
                    <div class="search search-style-1 search-style-1-lg mx-lg-auto">
                      <div class="input-group">
                        <input type="text" class="search-term form-control" name="search-term" id="search-term" placeholder="Procurar Pedido">
                        <span class="input-group-append">
                          <button class="btn btn-default" type="submit"><i class="bx bx-search"></i></button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>





              <table class="table table-ecommerce-simple table-striped mb-0" id="datatable-ecommerce-list" style="min-width: 640px;">
                <thead>
                  <tr>
                    <th width="10%">ID</th>
                    <th width="15%">Nome do Produto</th>
                    <th width="10%">E-mail do vendedor</th>
                    <th width="10%">Valor Pago </th>
                    <th width="10%">Status</th>
                    <th width="10%">Ação</th>
                  </tr>
                </thead>
                <tbody>
                
                
                  <?php $counter1=-1;  if( isset($results) && ( is_array($results) || $results instanceof Traversable ) && sizeof($results) ) foreach( $results as $key1 => $value1 ){ $counter1++; ?>
                  <tr>
                  
                    <td><a href='/dashboard/editar-servico/<?php echo getPurchaseInfoAndReturnHash($value1["idrecibo"]); ?>' class="text-primary"><strong><?php echo htmlspecialchars( $value1["idrecibo"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></a></td>
                    <td><a href='/dashboard/editar-servico/<?php echo getPurchaseInfoAndReturnHash($value1["idrecibo"]); ?>' class="text-primary"><strong><?php echo getPurchaseInfo($value1["idrecibo"],'desproduct'); ?></strong></a></td>
                    <td><?php echo getPurchaseInfo($value1["idrecibo"],'desemail'); ?></td>
                    <td>R$<?php echo ConvertVirgulaToPonto(getPurchaseInfo($value1["idrecibo"],'vlprice')); ?></td>

                
                   

                    <?php if( $value1["desbuystate"] == 'Aprovado'  ){ ?>
                    <td><span class="ecommerce-status completed">Aprovado</span></td>
                    <?php }elseif( $value1["desbuystate"] == 'Pendente'  ){ ?>
                    <td><span class="ecommerce-status on-hold">Pendente</span></td>
                    <?php }else{ ?>
                    <td><span class="ecommerce-status cancelled">Cancelado</span></td>
                
                    <?php } ?>
                 
                    <td><a href="#visualizar<?php echo htmlspecialchars( $counter1, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="modal-with-zoom-anim ws-normal btn btn-success w-100 font-weight-bold">Visualizar</a>  </td>
                  </tr>



                            <!-- Modal Animation -->
                            <div id="visualizar<?php echo htmlspecialchars( $counter1, ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="zoom-anim-dialog modal-block modal-block-primary mfp-hide">
                              <section class="card">
                                <header class="card-header">
                            
                                </header>
                                <div class="card-body">
                                  <div class="modal-wrapper">
                                    
                                    <div class="text-center">
                                    
                                        <a class="text-8 font-weight-bold text-decoration-none text-primary ">Recibo de Compra</a>
                                    </div>

                                    <div class=" text-center  col-md-12 " >



                                      <hr>
                                      <h5><strong>Status da compra :</strong> <span class="lighter-1"><?php echo htmlspecialchars( $value1["desbuystate"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> </h5>
                                      <h5><strong>Parcelamento da compra :</strong> <span class="lighter-1"><?php echo htmlspecialchars( $value1["despayament"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> </h5>
                                      <h5><strong>Método de pagamento :</strong> <span class="lighter-1"><?php echo htmlspecialchars( $value1["desmethod"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> </h5>                                 
                                      <h5><strong>IP do comprador :</strong> <span class="lighter-1"><?php echo htmlspecialchars( $value1["desip"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> </h5>                              
                                      <h5><strong>Data da compra:</strong> <span class="lighter-1"><?php echo htmlspecialchars( $value1["dtbuy"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span> </h5>
                                            
                                      <hr>

                                
                                      <h5><strong>Nome do produto :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'desproduct'); ?></span> </h5>
                                      <h5><strong>Resumo do produto :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'desresume'); ?></span> </h5>                                           
                                      <h5><strong>Valor do produto :</strong> <span class="lighter-1">R$<?php echo ConvertVirgulaToPonto(getPurchaseInfo($value1["idrecibo"],'vlprice')); ?></span> </h5>                              
                                      <h5><strong>Tags do produto :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'destags'); ?></span> </h5>
                                    
                                  
                                  
                                <hr>
                                
                                  <h5><strong>Nome do vendedor :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'desperson'); ?></span> </h5>
                                  <h5><strong>Apelido do vendedor :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'desnick'); ?></span> </h5>
                                  <h5><strong>E-mail do vendedor :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'desemail'); ?></span> </h5>                                 
                                  <h5><strong>IP do vendedor :</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'desipterms'); ?></span> </h5>                              
                                  <h5><strong>Data de registro:</strong> <span class="lighter-1"><?php echo getPurchaseInfo($value1["idrecibo"],'dtregister'); ?></span> </h5>
                                  <hr> 

                                  

                                        
                              
                                
                                  </div>
                                </div>
                              </div>
                              <footer class="card-footer">
                                <div class="row">
                                  <div class="col-md-12 text-right">
                                  
                          
                                    <button class="btn btn-success text-5 modal-dismiss">Fechar</button>
                                  </div>
                                </div>
                              </footer>
                            </section>
                          </div>









              <?php } ?>
                
    
    
                </tbody>
              </table>



           



              <hr class="solid mt-5 opacity-4">
              <div class="datatable-footer">
                <div class="row align-items-center justify-content-between mt-3">
                
                  <div class="col-lg-auto text-center order-3 order-lg-2">
                    <div class="results-info-wrapper"></div>
                  </div>
                  <div class="col-lg-auto order-2 order-lg-3 mb-3 mb-lg-0">
                    <div class="pagination-wrapper"></div>
                  </div>
                </div>
              </div>
            </table>
          </div>
        </div>


      <!-- ======================================================================================================= -->

    
              
                  </div>            
                </div>   
              </div>                          
            </div>
          </div>








     



          
  </div>





    
                      






  
</div>
<!-- end: page -->
</section>