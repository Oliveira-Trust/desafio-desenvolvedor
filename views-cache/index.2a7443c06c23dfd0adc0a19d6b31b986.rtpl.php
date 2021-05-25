<?php if(!class_exists('Rain\Tpl')){exit;}?>


	
	
	
	
	
	
	
	
	<main class="main">
		<?php if( $sucess ){ ?>

		<div class="alert alert-success fade show text-center" role="alert">					
			<strong class="text-uppercase ls-n-20 mb-md-0 px-4"><?php echo htmlspecialchars( $sucess, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>
		</div>
		<?php } ?>


		<?php if( $error ){ ?>

		<div class="alert alert-danger fade show text-center"  role="alert">					
			<strong class="text-uppercase ls-n-20 mb-md-0 px-4"><?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?></strong>
		</div>
		<?php } ?>

			<div class="home-slider owl-carousel owl-theme owl-carousel-lazy show-nav-hover nav-big mb-2 text-uppercase" data-owl-options="{
				'loop': false
			}">




				<div class="home-slide home-slide1 banner">
					<img class="owl-lazy slide-bg" src="/res/UserDashboard/assets/giftbg3.png" data-src="/res/UserDashboard/assets/giftbg3.png" alt="slider image">
					<div class="container">
						<div class="banner-layer banner-layer-middle">
							<h4 class="text-transform-none m-b-3 text-white">Vaga de Desenvolvedor PHP (Jr/Pleno/Sênior).</h4>
							<h4 class="text-transform-none m-b-3 text-white">Sistema desenvolvido no total de <strong> 12 Horas e 35 Minutos</strong> </h4>
							<h2 class="text-transform-none mb-0 text-white">Oliveira Trust</h2>
							<h3 class="m-b-3 text-white">Pedidos de compra</h3>
						
								
							<?php if( $logged ){ ?>

						
								<?php if( $checkadm == 0 ){ ?>

										<a href="/dashboard" class="btn btn-success  btn-lg ls-10 text-white" style="font-weight: 900 !important;">  Acessar Dashboard</a>														
										<a href="/admin/login" class="btn btn-danger   btn-lg ls-10 text-white" style="font-weight: 900 !important;">  Logar como ADMIN </a>
									<?php }else{ ?>

										<a href="/admin/" class="btn btn-success  btn-lg ls-10 text-white" style="font-weight: 900 !important;">  Acessar Dashboard</a>														
										<a href="/logar" class="btn btn-danger   btn-lg ls-10 text-white" style="font-weight: 900 !important;">  Logar como CLIENTE </a>
								<?php } ?>

						    	
							<?php }else{ ?>

							<a href="/logar" class="btn btn-success  btn-lg ls-10 text-white" style="font-weight: 900 !important;">  Logar como Cliente</a>														
								<a href="/admin/login" class="btn btn-danger   btn-lg ls-10 text-white" style="font-weight: 900 !important;">  Logar como ADMIN </a>
							<?php } ?>

						</div><!-- End .banner-layer -->
					</div>
				</div><!-- End .home-slide -->



			</div><!-- End .home-slider -->

			<div class="container">
			

	

				






	
	




			<section class="featured-products-section">

				
				<div class="container">

			

				

					<div class="banner banner-big-sale mb-5" style="background: #0a130d center/cover url('/res/UserDashboard/assets/images/banners/banner-4.png');">
						<div class="banner-content row align-items-center py-4 mx-0">
							<div class="col-md-9">
								<a href="">
								<h2 class="text-white text-uppercase ls-n-20 mb-md-0 px-4">
									
									<b class="d-inline-block mr-4 mb-1 mb-md-0">Olá, tudo bem?!</b>
									CLIQUE PARA EXIBIR O MEU CURRÍCULO 
							
								</h2></a>
							</div>
							<div class="col-md-3 text-center text-md-right">
								<a class="btn btn-light btn-white btn-lg mr-3" href="/res/UserDashboard/assets/CURRÍCULUM VITAE.pdf" target="_blank">EXIBIR CURRÍCULO</a>
							</div>
						</div>
					</div>
						
		
					
					<h2 class="section-title heading-border ls-20 border-0" id='mail-camp'>PRODUTOS EM ALTA</h2>

					<div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true
					}">

				






					
					
					<?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>								
						<div class="product-default">
							<figure>
								<a href='/' >
									<img src='/<?php echo getArrayFromProducts($value1["desimages"]); ?>' class="img-product-alta img-quickview" alt="product">
								</a>
								<div class="label-group">
									<div class="product-label label-hot">EM ALTA</div>
									<div class="product-label label-sale">COMPRE AGORA</div>
								</div>
							</figure>
							<div class="product-details">
								<div class="category-list">
									<a href="/lista-produtos" class="product-category">
										<?php if( $value1["incategory"] == '1'  ){ ?>

										Automóveis                
										<?php }elseif( $value1["incategory"] == '2'  ){ ?>

										Casas
										<?php }else{ ?>

										Passagens
									  <?php } ?>

									</a>
								</div>
								<h3 class="product-title">
									<a class="text-uppercase font-weight-bold" style="font-size: 20px;"><?php echo htmlspecialchars( $value1["desproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>								
								</h3>							
								<div class="price-box">
									<del class="old-price">R$<?php echo htmlspecialchars( $value1["vlprice"], ENT_COMPAT, 'UTF-8', FALSE ); ?></del>
									<span class="product-price"><b>R$<?php echo ConvertVirgulaToPonto($value1["vlprice"]); ?></b></span>
								</div><!-- End .price-box -->
								<div class="product-action">						
									<a href='/modal-produtos/<?php echo setHash($value1["idproduct"]); ?>' class="btn-icon btn-add-cart btn-quickview "><i class="fas fa-external-link-alt"></i> <b> VISUALIZAR/COMPRAR </b></a>					
								</div>
							</div><!-- End .product-details -->
						</div>
						<?php } ?>









						</div>
					</div><!-- End .featured-proucts -->
				</div>
			</section>





			<section class="new-products-section">
				<div class="container">
					<h2 class="section-title heading-border ls-20 border-0">Novidades</h2>

					<div class="products-slider custom-products owl-carousel owl-theme nav-outer show-nav-hover nav-image-center" data-owl-options="{
						'dots': false,
						'nav': true,
						'responsive': {
							'992': {
								'items': 5
							}
						}
					}">






				
			
					<?php $counter1=-1;  if( isset($products) && ( is_array($products) || $products instanceof Traversable ) && sizeof($products) ) foreach( $products as $key1 => $value1 ){ $counter1++; ?>										
						<div class="product-default">
							
							<figure>
								<a href='/'>
									<img src='/<?php echo getArrayFromProducts($value1["desimages"]); ?>' class="img-product-novidade"  alt="product">
								</a>
								<div class="label-group">
									<div class="product-label label-hot">NOVIDADE</div>
									<!-- <div class="product-label label-sale">20% Off</div> -->
								</div>
							</figure>

							<div class="product-details">
								<div class="category-list">
									<a href="/lista-produtos" class="product-category">
										<?php if( $value1["incategory"] == '1'  ){ ?>

										Automóveis                
										<?php }elseif( $value1["incategory"] == '2'  ){ ?>

										Casas
										<?php }else{ ?>

										Passagens
									  <?php } ?>

									  </a>
								</div>
								<h3 class="product-title">
									<a href='/servico/visualizar/<?php echo setHash($value1["idproduct"]); ?>'><?php echo htmlspecialchars( $value1["desproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
							
								</h3>
								<div class="ratings-container">
									<div class="product-ratings">
										<span class="ratings" style="width:80%"></span><!-- End .ratings -->
										<span class="tooltiptext tooltip-top"></span>
									</div><!-- End .product-ratings -->
								</div><!-- End .product-container -->
								<div class="price-box">
									<del class="old-price">R$<?php echo htmlspecialchars( $value1["vlprice"], ENT_COMPAT, 'UTF-8', FALSE ); ?></del>
									<span class="product-price"><b>R$<?php echo ConvertVirgulaToPonto($value1["vlprice"]); ?></b></span>
								</div><!-- End .price-box -->
								<div class="product-action">						
									<a href='/modal-produtos/<?php echo setHash($value1["idproduct"]); ?>' class="btn-icon btn-add-cart btn-quickview "><i class="fas fa-external-link-alt"></i>VISUALIZAR/COMPRAR</a>					
								</div>
							</div><!-- End .product-details -->
						</div>
						<?php } ?>








					</div><!-- End .featured-proucts -->




					<hr>

					<div class="banner banner-big-sale mb-5" style="background: #0a130d center/cover url('/res/UserDashboard/assets/images/banners/banner-4.png');">
					<div class="banner-content row align-items-center py-4 mx-0">
						<div class="col-md-9">
							<a href="">
							<h2 class="text-white text-uppercase ls-n-20 mb-md-0 px-4">
								
								<b class="d-inline-block mr-4 mb-1 mb-md-0">Olá, tudo bem?!</b>
								Quer ver o meu portfólio? <strong style="color: white; background-color: rgba(255, 0, 0, 0.3)" >Entre em contato!</strong> 
						
							</h2></a>
						</div>
						<div class="col-md-3 text-center text-md-right">
							<a class="btn btn-light btn-white btn-lg mr-3" href="mailto:vto.hugo67@gmail.com">Enviar Mensagem</a>
						</div>
					</div>
				</div>


				


				
			<section class="feature-boxes-container">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="feature-box px-sm-5 feature-box-simple text-center">
								<i class="icon-edit"></i>
								
								<div class="feature-box-content">
									<h3 class="m-b-1">CRUD DE CLIENTES</h3>
									<h5 class="m-b-3">Criação + Edição </h5>

									<p>O sistema de CRUD para os clientes foi feito a nível multi-usuário, com edição tanto para o próprio usuário quanto para o administrador do sistema.</p>
								</div><!-- End .feature-box-content -->
							</div><!-- End .feature-box -->
						</div><!-- End .col-md-4 -->

						<div class="col-md-4">
							<div class="feature-box px-sm-5 feature-box-simple text-center">
								<i class="icon-edit"></i>

								<div class="feature-box-content">
									<h3 class="m-b-1">CRUD DE PRODUTOS</h3>
									<h5 class="m-b-3">Criação + Edição + Remoção</h5>

									<p>O sistema de CRUD para os produtos foi feito a nível multi-usuário, com edição tanto para o próprio usuário quanto para o administrador do sistema.</p>
								</div><!-- End .feature-box-content -->
							</div><!-- End .feature-box -->
						</div><!-- End .col-md-4 -->

						<div class="col-md-4">
							<div class="feature-box px-sm-5 feature-box-simple text-center">
								<i class="icon-edit"></i>

								<div class="feature-box-content">
									<h3 class="m-b-1">CRUD DE COMPRAS</h3>
									<h5 class="m-b-3">Criação + Edição + Remoção</h5>

									<p>O sistema de CRUD para os clientes foi feito a nível multi-usuário, com edição apenas para o Administrador, o cliente pode apenas visualizar o recibo.</p>
								</div><!-- End .feature-box-content -->
							</div><!-- End .feature-box -->
						</div><!-- End .col-md-4 -->




						<div class="col-md-4">
							<div class="feature-box px-sm-5 feature-box-simple text-center">
								<i class="icon-credit-card"></i>

								<div class="feature-box-content">
									<h3 class="m-b-1">front-end</h3>
									<h5 class="m-b-3">Dashboard & Home</h5>

									<p>Para isso, foi utilizado a versão mais recente da biblioteca do Bootstrap, Jquery e outras bibliotecas secundárias, como também o uso do Porto TMT.</p>
								</div><!-- End .feature-box-content -->
							</div><!-- End .feature-box -->
						</div><!-- End .col-md-4 -->
						

						
						<div class="col-md-4">
							<div class="feature-box px-sm-5 feature-box-simple text-center">
								<i class="icon-earphones-alt"></i>

								<div class="feature-box-content">
									<h3 class="m-b-1">Sistema Multi-Usuário</h3>
									<h5 class="m-b-3">PHP & MySql</h5>

									<p>Foi desenvolvido um sistema de autenticação multi-usuário que se apresenta 100% funcional, com dois tipos de conta, Administrador e Usuário Comum.</p>
								</div><!-- End .feature-box-content -->
							</div><!-- End .feature-box -->
						</div><!-- End .col-md-4 -->

						
						<div class="col-md-4">
							<div class="feature-box px-sm-5 feature-box-simple text-center">
								<i class="icon-credit-card"></i>

								<div class="feature-box-content">
									<h3 class="m-b-1">back-end</h3>
									<h5 class="m-b-3">Dashboard & Home</h5>

									<p>O Back-End é composto principalmente por Php, Jquery(Retorno em JSON), MySql. Utilizando-se de Frameworks como Slim Framework e Rain Tpl.</p>
								</div><!-- End .feature-box-content -->
							</div><!-- End .feature-box -->
						</div><!-- End .col-md-4 -->


					</div><!-- End .row -->
				</div><!-- End .container-->
			</section><!-- End .feature-boxes-container -->


			
			<section class="promo-section bg-dark" data-parallax="{'speed': 1.8, 'enableOnMobile': true}" data-image-src="/res/UserDashboard/assets/images/banners/banner-5.jpg">
				<div class="promo-banner banner container text-uppercase">
					<div class="banner-content row align-items-center text-center">
						<div class="col-md-4 ml-xl-auto text-md-right">
							<h2 class="mb-md-0 text-white">Vamos marcar uma reunião?</h2>
						</div>
						<div class="col-md-4 col-xl-3 pb-4 pb-md-0">
							<a href="mailto:vto.hugo67@gmail.com" class="btn btn-dark btn-black ls-10">Enviar E-mail</a>
						</div>
						<div class="col-md-4 mr-xl-auto text-md-left">
							<h4 class="mb-1 coupon-sale-text p-0 d-block ls-10 text-transform-none"><b>Programador Full Stack </b></h4>
							<h5 class="mb-2 coupon-sale-text text-white ls-10 p-0"><i class="ls-0"></i><b class="text-white bg-secondary">+5</b> Anos de experiência</h5>
						</div>
					</div>
				</div>
			</section>

		

		
				</main>
