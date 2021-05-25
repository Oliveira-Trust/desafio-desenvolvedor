<?php if(!class_exists('Rain\Tpl')){exit;}?><!--  -->
				


<!-- start: page -->
                    <form class="action-buttons-fixed ecommerce-form" action="/dashboard/publicar-anuncio" method="post" enctype="multipart/form-data">
                      
 

                      
                        <div class="row">
                            <div class="col">
                                <section class="card card-modern card-big-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2-5 col-xl-1-5">
                                                <i class="card-big-info-icon  bx bxs-book-add  text-primary"></i>
                                                <h2 class="card-big-info-title">Informação Geral</h2>
                                                <p class="card-big-info-desc">Adicione aqui as informações básicas do seu produto.</p>
                                            </div>


                                            <div class="col-lg-3-5 col-xl-4-5">
                                            
                                            
                                            
                                                <div class="form-group row align-items-center">
                                                    <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0 font-weight-bold text-4">Nome do Serviço</label>
                                                    <div class="col-lg-7 col-xl-6">
                                                        <input type="text" class="form-control form-control-modern Form-Color text-5" name="service_name" placeholder="Insira o nome do serviço" data-plugin-maxlength maxlength="25" value="" required />
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-xl-3 control-label text-lg-right pt-2 mt-1 mb-0 font-weight-bold text-4">Resumo do serviço </label>
                                                    <div class="col-lg-7 col-xl-6">
                                                        <textarea class="form-control form-control-modern Form-Color text-5" name="service_resume" placeholder="Nos fale brevemente sobre o serviço" data-plugin-maxlength maxlength="165" rows="2" cols="33"  required style=" resize: none;"></textarea>
                                                    </div>
                                                </div>

            
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-xl-3 control-label text-lg-right pt-2 mt-1 mb-0 font-weight-bold text-4">Descrição do serviço </label>
                                                    <div class="col-lg-7 col-xl-6">
                                                        <textarea class="form-control form-control-modern Form-Color text-5" name="service_description" placeholder="Informe uma descrição detalhada do serviço" data-plugin-maxlength maxlength="256" rows="5" cols="33"  required style=" resize: none;"></textarea>
                                                    </div>
                                                </div>

            

                                            </div>


                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>








                        <div class="row">
                            <div class="col">
                                <section class="card card-modern card-big-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2-5 col-xl-1-5">
                                                <i class="card-big-info-icon bx bx-box text-primary"></i>
                                                <h2 class="card-big-info-title">Categoria / Tags</h2>
                                                <p class="card-big-info-desc">Informe aqui informações que as pessoas irão utilizar para encontrar o seu serviço.</p>
                                            </div>


                                            <div class="col-lg-3-5 col-xl-4-5">   
                                         
                                                <div class="tab-pane fade show " id="avanced" role="tabpanel" aria-labelledby="avanced-tab">
                                                     
                                                    
                                                    <div class="form-group row align-items-center text-4">
                                                        <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0 font-weight-bold">Para o que serve esse serviço?</label>
                                                        <div class="col-lg-7 col-xl-6">
                                                            <input type="text" class="form-control form-control-modern Form-Color text-5 " name="service_objective" placeholder="Informe a função deste serviço"  data-plugin-maxlength  maxlength="35" value="" required />
                                                        </div>
                                                    </div>


                                                    <div class="form-group row align-items-center">
                                                        <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0 font-weight-bold text-4">Categoria do produto</label>
                                                        <div class="col-lg-7 col-xl-6">

                                                         
                                                    
                                                          
                                                         
                                                                <select class="form-control form-control-modern Form-Color text-5" name="service_category" required>
                                                                 
                                                                        <option value="" selected disabled>Escolha uma...</option>
                                                                        <option value="1">Automóveis</option>
                                                                        <option value="2">Casas</option>
                                                                        <option value="3">Passagens</option>
                                                                       
                                                              
                                                                </select>
                                                            
                                                        </div>
                                                    </div>


                                                   <div class="form-group row align-items-center">
                                                      <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0 font-weight-bold text-4">Tags do produto</label>
                                                      <div class="col-lg-7 col-xl-6 ">
                                                         
                                                        <input class="form-control form-control-modern Form-Color text-5" id="tags-input" placeholder="Use a tecla Enter" name="service_tags"  data-role="tagsinput" data-tag-class="badge badge-primary " required  />
                                                              
                                                
                                               
                                                      </div>
                                                      
                                                  </div>
                                                  
                                              

                                            </div>

                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                      


                  



            




                 
                        <div class="row">
                            <div class="col">
                                <section class="card card-modern card-big-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2-5 col-xl-1-5">
                                                <i class="card-big-info-icon bx bx-camera text-primary"></i>
                                                <h2 class="card-big-info-title">Imagem do Serviço</h2>
                                                <p class="card-big-info-desc">Envie algumas imagens do seu serviço, use as melhores que tiver!</p>
                                            </div>
                                            <div class="col-lg-3-5 col-xl-4-5">
                                             
                                             
                                                
                                                <div class="form-group row align-items-center">
                                                    <div class="col">
                                                        <div id="dropzone-form-image"  class="dropzone-modern dz-square ">
                                                            <span class="dropzone-upload-message text-center ">
                                                                <i class="bx bxs-cloud-upload"></i>
                                                                <b class="text-color-primary ">Arraste/Envie <deixaVerde style="color: rgb(47, 182, 58);"> imagens aqui </deixaVerde>  (Recomendado : <resol style="color: red;"> 600 x 600 </resol>).</b>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>














                   
                        <div class="row">
                            <div class="col">
                                <section class="card card-modern card-big-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-2-5 col-xl-1-5">
                                                <i class="card-big-info-icon bx bxs-wallet text-primary"></i>
                                                <h2 class="card-big-info-title">Preço do Serviço</h2>
                                                <p class="card-big-info-desc">Informe aqui o valor do seu serviço, este valor será a quantia que as pessoas irão pagar por ele.</p>
                                            </div>


                                            <div class="col-lg-3-5 col-xl-4-5">
                                            
                                            
                                                <div class="tab-pane fade show active" id="price" role="tabpanel" aria-labelledby="price-tab">
                                                         
                                                    
                                                     
                                                      <div class="form-group row align-items-center">
                                                          <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0 font-weight-bold">Valor do serviço </label>
                                                          <div class="col-lg-7 col-xl-6">                                                                                                        
                                                              <div class="input-group">
                                                                <span class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-money-bill"></i>
                                                                    </span>
                                                                </span> 
                                                                <input placeholder="R$ 0,00" id="valorServico" onchange="UpdateValue()" name="service_price" required class="form-control form-control-modern Form-Color font-weight-bold text-left">                                                    
                                                            </div>                                                 
                                                            </div>
                                                      </div>


                                                      <div class="form-group row align-items-center">
                                                          <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0 font-weight-bold">Nossa Taxa <strong style="color: red;">( 10% )</strong> </label>
                                                          <div class="col-lg-7 col-xl-6">
                                                            <div class="input-group">
                                                                <span class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-money-check-alt"></i>
                                                                    </span>
                                                                </span>
                                                            <input type="text" class="form-control form-control-modern Form-Color font-weight-bold" name="salePrice2" id="TaxaServico" placeholder="00.00"  disabled/>
                                                        </div>
                                                        </div>                                                              
                                                      </div>          
                                                      
                                                      

                                                      <div class="form-group row align-items-center">
                                                          <label class="col-lg-5 col-xl-3 control-label text-lg-right mb-0"></label>
                                                          <div class="col-lg-7 col-xl-6">
                                                              
                                                              <h2 class="text-center text-white font-weight-bold" id="FinalValue" style="background-color: rgb(122, 122, 122); " > R$ 00,00</h2>
                                                          </div>                                                              
                                                      </div>     
                                                      
                                                      

                                              </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>













                        <hr>

                        <div class="row action-buttons" style="z-index: 999;">
                            <div class="col-12 col-md-auto">
                                <button type="submit" class="submit-button btn btn-success btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1" id="submit-all" data-loading-text="Loading...">
                                    <i class="bx bx-save text-4 mr-2"></i> Publicar Produto
                                </button>
                            </div>
                            <!-- <div class="col-12 col-md-auto px-md-0 mt-3 mt-md-0">
                                <a href="ecommerce-products-list.html" class="cancel-button btn btn-light btn-px-4 py-3 border font-weight-semibold text-color-dark text-3">Cancel</a>
                            </div> -->
                            <div class="col-12 col-md-auto ml-md-auto mt-3 mt-md-0">
                                <a href="#" class="delete-button btn btn-info btn-px-4 py-3 d-flex align-items-center font-weight-semibold line-height-1">
                                    <i class="bx bx-trash text-4 mr-2"></i> Resetar Informações
                                </a>
                            </div>
                        </div>



                    </form>
                <!-- end: page -->
            </section>