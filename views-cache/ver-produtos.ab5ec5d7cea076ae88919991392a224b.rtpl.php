<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- start: page -->


  


  
  
    <div class="col-lg-12 ">
       
<?php if( $error ){ ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
 <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>

</div>
<?php } ?>

<?php if( $sucess ){ ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
 <?php echo htmlspecialchars( $sucess, ENT_COMPAT, 'UTF-8', FALSE ); ?>

</div>
<?php } ?>
      <div class="row">
        <div class="col">
          
          <div class="card card-modern card-modern-table-over-header">
            <div class="card-header">
              <div class="card-actions">
                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
              </div>
              <h2 class="card-title">Lista de Planos</h2>
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
                      <th width="8%">ID</th>
                      <th width="20%">Nome do Serviço</th>
                      <th width="5%">Categoria</th>
                      <th width="20%">Resumo do Serviço</th>
                      <th width="20%">Valor Total venda </th>
               
                      <th width="20%">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  
                    <?php $counter1=-1;  if( isset($results) && ( is_array($results) || $results instanceof Traversable ) && sizeof($results) ) foreach( $results as $key1 => $value1 ){ $counter1++; ?>
                    <tr>
                     
                      <td><a href='/dashboard/editar-servico/<?php echo setHash($value1["idproduct"]); ?>' class="text-primary"><strong><?php echo htmlspecialchars( $value1["idproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></a></td>
                      <td><a href='/dashboard/editar-servico/<?php echo setHash($value1["idproduct"]); ?>' class="text-primary"><strong><?php echo htmlspecialchars( $value1["desproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?></strong></a></td>
                   
                   
                      <td> <?php if( $value1["incategory"] == '1'  ){ ?>
                            Automóveis                
                            <?php }elseif( $value1["incategory"] == '2'  ){ ?>
                            Casas
                            <?php }else{ ?>
                            Passagens
                          <?php } ?>
                      </td>


                      <td> <?php echo htmlspecialchars( $value1["desresume"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                      <td>R$ <?php echo htmlspecialchars( $value1["vlprice"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
  
                   
             
  
                      <td>
                      <a href='/dashboard/editar-servico/<?php echo setHash($value1["idproduct"]); ?>' class="bulk-action-apply btn btn-success btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">EDITAR</a> 
                       <a href='/dashboard/deletar-produto/<?php echo setHash($value1["idproduct"]); ?>' class="bulk-action-apply btn btn-danger btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">DELETAR</a>  </td>
                    </tr>
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
                
                    </div>   
                  </div>   
                </div>        
              </div>
            </div>
  
  
    </div>
  </div>
  <!-- end: page -->
  </section>