<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Notícia</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

			if(isset($_POST['acao'])){
                $categoria_id = $_POST['categoria_id'];
				$titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
				$capa = $_FILES['capa'];}
                //Criando uma váriavel para cada coluna da tabela `tb_site.noticias`


               if($titulo == '' || $conteudo == ''){ //Sí o meu TÍTULO ou CONTEÚDO for igual a VAZIO:
                    Painel::alert('erro','Um ou mais campos vazios não são permitidos.'); //execute essa função
                }else if($capa['tmp_name'] == ''){ //Se a minha CAPA['tmp_name'] for igual a VAZIO:
                    Painel::alert('erro','Selecione uma imagem.'); //execute essa função
                }else{ //Fez o upload na imagem beleza, agora vamos ver se essa imagem é válida
                    if(Painel::imagemValida($capa)){
                            $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo=? AND categoria_id = ?");
                            $verifica->execute(array($titulo,$categoria_id));
                            if($verifica->rowCount() == '0'){
                        $imagem = Painel::uploadFile($capa); //Validação criada no Painel.php
                        $slug = Painel::generateSlug($titulo); //Gerando slug com o nome do post
                        $arr = ['categoria_id'=>$categoria_id,'data'=>date('Y-m-d'),'titulo'=>$titulo,'conteudo'=>$conteudo,'capa'=>$imagem,
                        'order_id'=>'0',
                        'nome_tabela'=>"tb_site.noticias"
                        ]; //Criando um array manualmente
                        if(Painel::insert($arr)){ //Sí conseguir inserir
                            Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-noticia?sucesso');
                        }
                        }else{
                            Painel::alert('erro','Já existe.');
                        }
                        }else{
                            Painel::alert('erro','Selecione uma imagem válida');
                    }
                }
            
            if(isset($_GET['sucesso']) && !isset($_POST['acao'])) //Sí existir o $_GET['sucesso'] && sí não existir o $_POST['acao']
                Painel::alert('sucesso','Publicado com sucesso');
		?>
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
            <?php 
                $categorias = Painel::selectAll('tb_site.categorias');
                foreach ($categorias as $key => $value){
            ?>
            <option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option> <!--Puxa o ID da categoria para selecionar e o nome para selecionar-->
            <?php } ?> <!--Rodar looping-->
            </select>
        </div><!--form-group-->

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="titulo" required>
		</div><!--form-group-->

        <div class="form-group">
			<label>Conteúdo:</label>
			<textarea class="tinymce" name="conteudo"></textarea> <!--A classe tinymce vai servir para o editor de texto criado no js-->
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="capa"/>
			<input type="hidden" name="imagem_atual">
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="tb_site.noticias" />
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->