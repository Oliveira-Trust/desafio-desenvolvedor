<?php if(!class_exists('Rain\Tpl')){exit;}?><!doctype html>
<html class="modern fixed has-top-menu has-left-sidebar-half" data-style-switcher-options="{'changeLogo': false}">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Oliveira Trust | Dashboard</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="/res/UserDashboard/assets/images/Logo.jpg">

			<!-- Web Fonts  -->
			<link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,600,700,800,900" rel="stylesheet" type="text/css">

			<!-- Vendor CSS -->
			<link rel="stylesheet" href="/res/UserManagement/vendor/bootstrap/css/bootstrap.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/animate/animate.compat.css">

			<link rel="stylesheet" href="/res/UserManagement/vendor/font-awesome/css/all.min.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/boxicons/css/boxicons.min.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/magnific-popup/magnific-popup.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

			<!-- Specific Page Vendor CSS -->
			<link rel="stylesheet" href="/res/UserManagement/vendor/owl.carousel/assets/owl.carousel.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/owl.carousel/assets/owl.theme.default.css" />


			<link rel="stylesheet" href="/res/UserManagement/vendor/morris/morris.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/datatables/media/css/dataTables.bootstrap4.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/select2/css/select2.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/select2-bootstrap-theme/select2-bootstrap.min.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/dropzone/basic.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/dropzone/dropzone.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/pnotify/pnotify.custom.css" />
			<link rel="stylesheet" href="/res/UserManagement/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
			<!-- Theme CSS -->
			<link rel="stylesheet" href="/res/UserManagement/css/theme.css" />


			<!-- Theme Layout -->
			<link rel="stylesheet" href="/res/UserManagement/css/layouts/modern.css" />
			<!--(remove-empty-lines-end)-->

	


			<!-- Theme Custom CSS -->
			<link rel="stylesheet" href="/res/UserManagement/css/custom.css">

			<!-- Head Libs -->
			<script src="/res/UserManagement/vendor/modernizr/modernizr.js"></script>







	
	
	




		

	</head>



  <!-- PAROU DE CHAMAR OS SCRIPTS -->
  <!-- PAROU DE CHAMAR OS SCRIPTS -->
  <!-- PAROU DE CHAMAR OS SCRIPTS -->
  <!-- PAROU DE CHAMAR OS SCRIPTS -->
  <!-- PAROU DE CHAMAR OS SCRIPTS -->
  <!-- PAROU DE CHAMAR OS SCRIPTS -->




  <?php require $this->checkTemplate("dashboardMenu");?>
  <div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
				    <div class="sidebar-header">
				        <div class="sidebar-toggle d-none d-md-flex" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>
				
				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">
				            
				                <ul class="nav nav-main">
				                  

							

				                    <li>
				                        <a class="nav-link" href="/dashboard">
											<i class='bx bxs-user-rectangle'></i>
				                            <span>Painel Inicial</span>
				                        </a>                        
				                    </li>



				                    <li>
				                        <a class="nav-link" href="/dashboard/minha-conta">
											<i class='bx bxs-wallet'></i>
				                            <span>Meu Perfil</span> 
				                        </a>                        
				                    </li>


									<li>
										<a class="nav-link" href="/dashboard/mudar-informacao">
											<i class='bx bxs-home-smile'></i>
											<span>Minha Conta</span>
										</a>                        
									</li>
				  
							

      
				
				                </ul>
				            </nav>
				
				            <hr class="separator" />


							<div class="">
				              
				                <div class="widget-content">
				                    <ul class="nav nav-main">
									
									
										<li>
											<a class="nav-link" href="/dashboard/publicar-anuncio">
												<i class='bx bxs-shopping-bags'></i>
												<span>Publicar Anúncio</span>
											</a>                        
										</li>

										<li>
											<a class="nav-link" href="/dashboard/gerenciar-anuncios">
												<i class='bx bxs-calendar-star'></i>
												<span>Gerenciar Anúncios</span>
											</a>                        
										</li>

										

				                    </ul>
				                </div>
				            </div>
				
				            <hr class="separator" />

					
							<div class="">
				            
				                <div class="widget-content">
				                    <ul class="nav nav-main">
									
									
							
								
										<li>
											<a class="nav-link" href="/admin/login">
												<i class='bx bxs-home-smile'></i>
												<span>Trocar para Administrador</span>
											</a>                        
										</li>

										<li>
											<a class="nav-link" href="/logout">
												<i class='bx bxs-home-smile'></i>
												<span>Desconectar-se</span>
											</a>                        
										</li>
					  
										
									
										<li>
											<a class="nav-link" href="/">
												<i class='bx bxs-navigation'></i>
												<span>Voltar ao site</span>
											</a>                        
										</li>

				                    </ul>
				                </div>
				            </div>
				
				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');
				                    
				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>
				        
				
				    </div>
				
				</aside>
				<!-- end: sidebar -->
				
				<section role="main" class="content-body content-body-modern">
					<header class="page-header page-header-left-inline-breadcrumb">
						<h2 class="font-weight-bold text-6">Dashboard</h2>
						<div class="right-wrapper">
							<ol class="breadcrumbs">
								<li><span>Início</span></li>
								<li><span>Página Atual</span></li>
							</ol>
					
		
						</div>
					</header>