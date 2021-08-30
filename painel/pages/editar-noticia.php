<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Editar Notícia</h2>

	<form method="post" enctype="multipart/form-data">

		<?php
			if(isset($_POST['acao'])){
				//Enviei o meu formulário.
				
				$nome = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
				$imagem = $_FILES['capa'];
				$imagem_atual = $_POST['imagem_atual'];
				$verifica = MySql::conectar()->prepare("SELECT `id` FROM `tb_site.noticias` WHERE titulo = ? AND categoria_id = ? AND id != ?");
                $verifica->execute(array($nome,$id));
                if($verifica->rowCount() == 0){
				if($imagem['name'] != ''){
					//Existe o upload de imagem.
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($nome);
						$arr = ['titulo'=>$nome,'categoria_id'=>$_POST['categoria'],'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
						Painel::update($arr);
						$slide = Painel::select('tb_site.noticias','id = ?',array($id));
						Painel::alert('sucesso','A noticia foi editado junto com a imagem!');
					}else{
						Painel::alert('erro','O formato da imagem não é válido');
					}
				}else{
					$imagem = $imagem_atual;
                    $slug = Painel::generateSlug($nome);
					$arr = ['titulo'=>$nome,'categoria_id'=>$_POST['categoria'],'data'=>date('Y-m-d'),'conteudo'=>$conteudo,'capa'=>$imagem,'slug'=>$slug,'id'=>$id,'nome_tabela'=>'tb_site.noticias'];
					Painel::update($arr);
					$slide = Painel::select('tb_site.noticias','id = ?',array($id));
					Painel::alert('sucesso','A noticia foi editado com sucesso!');
                }
                }else{
                    painel::alert('erro','Já existe uma noticia com esse nome');
                }
            }
		?>

        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
            <?php 
                $categorias = Painel::selectAll('tb_site.categorias');
                foreach ($categorias as $key => $value){
            ?>
            <option <?php if($value['id'] == $slide['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"> <?php echo $value['nome']; ?> </option> <!--Puxa o ID da categoria para selecionar e o nome para selecionar-->
            <?php } ?> <!--Rodar looping-->
            </select>
        </div><!--form-group-->

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="titulo" required value="<?php echo $slide['titulo']; ?>">
		</div><!--form-group-->

        <div class="form-group">
			<label>Conteúdo:</label>
			<texarea class="tinymce" name="conteudo"><?php echo $slide['conteudo']; ?></texarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="capa"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $slide['capa']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->