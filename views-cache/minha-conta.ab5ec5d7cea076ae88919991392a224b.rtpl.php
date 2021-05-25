<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- start: page -->

<div class="row" >
  <div class="col-lg-4 col-xl-3  mb-xl-0 " >

    <section class="card" >
      <div class="card-body" >
        <div class="thumb-info" >
          <img src="/res/UserDashboard/assets/images/clients/client2.png"   style="background-color: rgb(235, 235, 235); width: 500px;" class="rounded img-fluid  " alt="John Doe" >
          <div class="thumb-info-title" >
            <span class="thumb-info-inner"><?php echo htmlspecialchars( $user["desperson"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>       
            
          </div>
       
        </div>

        <h1 class="font-weight-bold " ><?php echo htmlspecialchars( $user["desnick"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>

        <hr class="dotted short">
      
        <h5 class="mb-2 mt-3 font-weight-semibold">Sobre mim</h5>
        <p class="text-3 font-weight-bold">
          <?php if( $user["desdescription"] == NULL ){ ?>
            Não encontramos nada! Nos fale um pouco mais sobre você..
          <?php }else{ ?>
            <?php echo htmlspecialchars( $user["desdescription"], ENT_COMPAT, 'UTF-8', FALSE ); ?>
          <?php } ?>
         </p>
        <p class="text-3 font-weight-bold"><?php echo htmlspecialchars( $YearsOld, ENT_COMPAT, 'UTF-8', FALSE ); ?> Anos, Estado do <?php echo htmlspecialchars( $address["desstate"], ENT_COMPAT, 'UTF-8', FALSE ); ?>.</p>

        <hr class="dotted short">

   
      </div>
    </section>

  
  

   
  </div>

  
  <div class="col-lg-9" >

    <div class="tabs">
 
      <div class="tab-content">
        <div id="overview" class="tab-pane active">

      

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
         



        <div id="edit" class="tab-pane" >


          <form class="p-3" action="/dashboard/minha-conta" method="POST">


                <h4 class="mb-3">Informações do usuário </h4>
              




                <div class="form-row mb-4">
                  <div class="form-group col">
                    <label for="inputAddress">Seu Apelido</label>

                    <div class="form-group row align-items-center">          
                      <div class="col-lg-12 col-xl-12">
                          <input type="text" class="form-control form-control-modern Form-Color" name="desnickname" maxlength="15"  value="<?php echo htmlspecialchars( $user["desnick"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  required />
                      </div>   
                    </div>

                  </div>
                </div>


                <div class="form-row">



                <div class="col-md-6 mb-3">
                    <label for="new_pass_confirm" class="form-label">Seu estado</label>

                    <select class="form-control form-control-modern text-5 h-auto  Form-Color" name="desstate"  required style="background-color: rgb(240, 240, 240);">
                                  
                      <?php $counter1=-1;  if( isset($states) && ( is_array($states) || $states instanceof Traversable ) && sizeof($states) ) foreach( $states as $key1 => $value1 ){ $counter1++; ?>
                      <option value="<?php echo htmlspecialchars( $value1['idstate'], ENT_COMPAT, 'UTF-8', FALSE ); ?>" <?php if( $address["idstate"]  == $value1['idstate'] ){ ?>selected<?php } ?>  ><?php echo htmlspecialchars( $value1['desstate'], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>       
                      
                      
                      <?php } ?>
                      
                  </select>


                </div> 
          



                  <div class="col-md-6 mb-3">
                    <label for="new_pass_confirm" class="form-label">Seu Aniversário</label>
                      <input type="date" class="form-control form-control-modern text-5 Form-Color" name="desdtbirth" value="<?php echo htmlspecialchars( $user["dtbirth"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"  required />
                  </div>

                

              
                

            </div>



                <div class="form-row mb-4">
                  <div class="form-group col">
                    <label for="inputAddress2">Fale um pouco sobre você</label>
                        
                    <div class="form-group row align-items-center">          
                      <div class="col-lg-12 col-xl-12">
                          <textarea type="text" class="form-control form-control-modern  Form-Color" name="desaboutme" maxlength="256" rows="5" cols="33"  required style=" resize: none;"><?php echo htmlspecialchars( $user["desdescription"], ENT_COMPAT, 'UTF-8', FALSE ); ?></textarea>
                      </div>   
                    </div>

                  </div>
                </div>

        
                <div class="form-row">
                  <div class="col-md-12 text-right mt-2">
                    <button class="btn btn-success text-5" >Salvar informações</button>
                  </div>
                </div>
                

                </div>
          




            


          </form>

        </div>
      </div>
    </div>
  </div>


</div>
<!-- end: page -->
</section>
</div>