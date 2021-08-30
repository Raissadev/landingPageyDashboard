<?php
if($_SESSION['img'] == ''){
?>
<div class="imagem-usuario">
<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/myWallpaper.jpg" />
</div><!--avatar-usuario-->
<?php }else{ ?>
<div class="imagem-usuario">
<img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" />
</div><!--avatar-usuario-->
<?php } ?>
<div class="nome-usuario">
<p><?php echo $_SESSION['nome']; ?></p>
<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
</div><!--nome-usuario-->
</div><!--box-usuario-->












<div class="items-menu">
<h2>Cadastro</h2>
<a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar Depoimento</a>
<a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servico">Cadastrar Serviço</a>
<a <?php selecionadoMenu('cadastrar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
<h2>Gestão</h2>
<a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
<a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
<a <?php selecionadoMenu('listar-slides'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>
<h2>Administração do painel</h2>
<a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuário</a>
<a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuário</a>
<h2>Configuração Geral</h2>
<a <?php selecionadoMenu('editar-site'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>
<h2>Gestão de Notícias</h2>
<a <?php selecionadoMenu('cadastrar-categoria'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-categorias">Cadastrar Categorias</a>
<a <?php selecionadoMenu('gerenciar-categorias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-categorias">Gerenciar Categorias</a>
<a <?php selecionadoMenu('cadastrar-noticia'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-noticia">Cadastrar Notícias</a>
<a <?php selecionadoMenu('gerenciar-noticias'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-noticias">Gerenciar Notícias</a>
</div><!--items-menu-->	
</div><!--menu-wraper-->
</div><!--menu-->
<aside>
<section>

<header>
<div class="center">
<div class="menu-btn">
<i class="fa fa-bars"></i>
</div><!--menu-btn-->

<div class="loggout">
<a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a;padding: 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"> <i class="fa fa-home"></i> <span>Página Inicial</span></a>
<a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"> <i class="fa fa-window-close"></i> <span>Sair</span></a>
</div><!--loggout-->

<div class="clear"></div>
</div>
</header>

<div class="content">

<?php Painel::carregarPagina(); ?>


</div><!--content-->




-------------------------------------------------------------------------
<?php
	$usuariosOnline = Painel::listarUsuariosOnline();

	$pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
	$pegarVisitasTotais->execute();

	$pegarVisitasTotais = $pegarVisitasTotais->rowCount();

	$pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia = ?");
	$pegarVisitasHoje->execute(array(date('Y-m-d')));

	$pegarVisitasHoje = $pegarVisitasHoje->rowCount();


?>
<div class="box-content w100">
		<h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>

		<div class="box-metricas">
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Usuários Online</h2>
					<p><?php echo count($usuariosOnline); ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Total de Visitas</h2>
					<p><?php echo $pegarVisitasTotais; ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="box-metrica-single">
				<div class="box-metrica-wraper">
					<h2>Visitas Hoje</h2>
					<p><?php echo $pegarVisitasHoje; ?></p>
				</div><!--box-metrica-wraper-->
			</div><!--box-metrica-single-->
			<div class="clear"></div>
		</div><!--box-metricas-->

</div><!--box-content-->

<div class="box-content w100 left">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários Online no Site</h2>

	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>IP</span>
			</div><!--col-->
			<div class="col">
				<span>Última Ação</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->

		<?php
			foreach ($usuariosOnline as $key => $value) {

		?>
		<div class="row">
			<div class="col">
				<span><?php echo $value['ip'] ?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])) ?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php } ?>
	</div><!--table-responsive-->
</div><!--box-content-->

<div class="box-content w100 right">
<h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários do Painel</h2>

	<div class="table-responsive">
		<div class="row">
			<div class="col">
				<span>Nome</span>
			</div><!--col-->
			<div class="col">
				<span>Cargo</span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->

		<?php
			$usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
			$usuariosPainel->execute();
			$usuariosPainel = $usuariosPainel->fetchAll();
			foreach ($usuariosPainel as $key => $value) {

		?>
		<div class="row">
			<div class="col">
				<span><?php echo $value['user'] ?></span>
			</div><!--col-->
			<div class="col">
				<span><?php echo pegaCargo($value['cargo']); ?></span>
			</div><!--col-->
			<div class="clear"></div>
		</div><!--row-->
		<?php } ?>
	</div><!--table-responsive-->
</div><!--box-content-->

<div class="clear"></div>




---------------------------------------------------------------------------------------



<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Adicionar Depoimentos</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
			
				if(Painel::insert($_POST)){
					Painel::alert('sucesso','O cadastro do depoimento foi realizado com sucesso!');
				}else{
					Painel::alert('erro','Campos vázios não são permitidos!');
				}
			

			}
		?>

		<div class="form-group">
			<label>Nome da pessoa:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Depoimento:</label>
			<textarea name="depoimento"></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Data:</label>
			<input formato="data" type="text" name="data">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="tb_site.depoimentos" />
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->