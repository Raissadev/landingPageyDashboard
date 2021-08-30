<?php include('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php
	$infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
	//$infoSite->execute();
	$infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Meu código</title>
	<link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet" />
	<script src="https://unpkg.com/feather-icons"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<link rel="icon" href="<?php echo INCLUDE_PATH; ?>favicon.ico" type="image/x-icon" />
	<meta charset="utf-8" />
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}
	?>
	
	<header id="headerMain">
		<div class="wrap w90 center items-flex">
			<div class="logo items-flex w25 w50Mobile">
				<h1><a href="">RaissaDev</a></h1>
			</div><!--logo-->
			<div class="menu items-flex w50 w50Mobile">
				<i class="menuMobile" id="menuMobile" data-feather="menu"></i>
				<i style="display:none" class="menuMobile" id="menuMobileClose" data-feather="menu"></i>
				<nav class="nav-menu w100" id="asideMenu">
					<a class="active" href="<?php echo INCLUDE_PATH; ?>home">Início</a>
					<a href="<?php echo INCLUDE_PATH; ?>#sobre">Sobre</a>
					<a href="<?php echo INCLUDE_PATH; ?>#servicos">Serviços</a>
					<a href="<?php echo INCLUDE_PATH; ?>#destaques">Destaques</a>
					<a href="<?php echo INCLUDE_PATH; ?>#time">Time</a>
					<a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a>
					<a href="<?php echo INCLUDE_PATH; ?>painel">Painel</a>
				</nav><!--nav-menu-->
			</div><!--menu-->
			<div class="contact-header items-flex w25">
				<span><i data-feather="smartphone"></i> +1 234 567 789</span> 
				<a class="items-flex" href="https://github.com/Raissadev"><i class="myGit" data-feather="github"></i></a>
			</div>
		</div><!--wrap-->
	</header><!--headerMain-->

	<main class="mainContent">
	<?php

		if(file_exists('pages/'.$url.'.php')){ //A gente verifica se existe
			include('pages/'.$url.'.php');
		}else{
			//Caso contrário... Podemos fazer o que quiser, pois a página não existe.
			if($url != 'depoimentos' && $url != 'servicos'){
				$urlPar = explode('/',$url)[0];
				if($urlPar != 'noticias'){
				$pagina404 = true;
				include('pages/404.php');
			}
			}else{
				include('pages/home.php');
				}
			}

	?>
	</main><!--mainContent-->

	<footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'; ?>>
		<div class="wrap items-flex">
			<div class="row">
				<div class="socialsFooter items-flex w100">
					<a class="items-flex" href=""><i class="myGit" data-feather="github"></i></a>
					<a class="items-flex" href=""><i class="myGit" data-feather="linkedin"></i></a>
					<a class="items-flex" href=""><i class="myGit" data-feather="instagram"></i></a>
				</div><!--socialsFooter-->
				<div class="terms text-center">
					<ul>
						<li><a href="">Termos e Condições</a></li>
						<li><a href="">Política de Privacidade</a></li>
						<li><a href="">Contate-Nos</a></li>
					</ul>
				</div><!--terms-->
				<div class="copy text-center">
					<p>2021 © RaissaDev. Todos os direitos reservados</p>
				</div><!--copy-->
			</div><!--row-->
		</div><!--wrap-->
	</footer>






















	
	<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/myfunctions.js"></script>


	<?php
		if($url == 'contato'){
	?>
	<?php } ?>
	<script src="js/formularios.js"></script>
</body>
</html>