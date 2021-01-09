<div class="box-content">
	<h2><i class="fa fa-pencil"></i> Cadastrar Cursos</h2>

	<form method="post" enctype="multipart/form-data">

		<?php

			if(isset($_POST['acao'])){
				$categoria_id = $_POST['categoria_id'];
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$keywords = $_POST['keywords'];
				$preco = $_POST['preco'];
				$preco_promo = $_POST['preco_promo'];
				$capa = $_FILES['imagem'];
				$capa2 = $_FILES['imagem2'];
				$link = $_POST['link'];
				$capa3 = $_FILES['imagem_big1'];
				$capa4 = $_FILES['imagem_big2'];
				$capa5 = $_FILES['imagem_big3'];

				if($nome == '' || $descricao == '' || $preco_promo == '' || $link == ''){
					Painel::alert('erro','Campos Vázios não são permitidos!');
				}else if($capa['tmp_name'] == '' || 
						$capa2['tmp_name'] == ''  || 
						$capa3['tmp_name'] == '' || 
						$capa4['tmp_name'] == '' || 
						$capa5['tmp_name'] == ''){
					Painel::alert('erro','Todas as imagens precisam ser selecionadas.');
				}else{
					if(Painel::imagemValida($capa) ||
					Painel::imagemValida($capa2) ||
					Painel::imagemValida($capa3) ||
					Painel::imagemValida($capa4) ||
					Painel::imagemValida($capa5)){
						$verifica = MySql::conectar()->prepare("SELECT * FROM `produtos` WHERE nome=? AND categoria_id = ?");
						$verifica->execute(array($nome,$categoria_id));
						if($verifica->rowCount() == 0){
						$imagem = Painel::uploadFile($capa);
						$imagem2 = Painel::uploadFile($capa2);
						$imagem3 = Painel::uploadFile($capa3);
						$imagem4 = Painel::uploadFile($capa4);
						$imagem5 = Painel::uploadFile($capa5);
						$slug = Painel::generateSlug($nome);
						$arr = ['categoria_id'=>$categoria_id,'nome'=>$nome,
						'descricao'=>$descricao, 
						'keywords'=>$keywords,
						'preco' => $preco, 
						'preco_promo' => $preco_promo, 
						'imagem'=>$imagem, 
						'imagem2' => $imagem2, 
						'lik' => $link, 
						'imagem_big1' => $imagem3, 
						'imagem_big2' => $imagem4, 
						'imagem_big3' => $imagem5, 
						'slug'=>$slug,
						'order_id'=>'0',
						'nome_tabela'=>'produtos'
						];
						if(Painel::insert($arr)){
							Painel::redirect(INCLUDE_PATH_PAINEL.'cadastrar-curso?sucesso');
						}

						//Painel::alert('sucesso','O cadastro da notícia foi realizado com sucesso!');
						}else{
							Painel::alert('erro','Já existe um curso com esse nome!');
						}
					}else{
						Painel::alert('erro','Selecione uma imagem válida!');
					}
					
				}
				
				
			}
			if(isset($_GET['sucesso']) && !isset($_POST['acao'])){
				Painel::alert('sucesso','O cadastro foi realizado com sucesso!');
			}
		?>
		<div class="form-group">
		<label>Categoria:</label>
		<select name="categoria_id">
			<?php
				$categorias = Painel::selectAll('tb_site.categorias');
				foreach ($categorias as $key => $value) {
			?>
			<option <?php if($value['id'] == @$_POST['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
			<?php } ?>
		</select>
		</div>

		<div class="form-group">
			<label>Título:</label>
			<input type="text" name="nome" value="<?php recoverPost('nome'); ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição:</label>
			<textarea  name="descricao"><?php recoverPost('descricao'); ?></textarea>
		</div>

		<div class="form-group">
			<label>Palavras Chave: <small>(separadas por vírgula - terminar com vírgula)</small></label>
			<textarea  name="keywords"><?php recoverPost('keywords'); ?></textarea>
		</div>

		<div class="form-group">
			<label>Preço:</label>
			<input type="text"  name="preco" placeholder="exemplo 59.90" value="<?php recoverPost('preco'); ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Preço Final (com desconto):</label>
			<input type="text"  name="preco_promo" placeholder="exemplo 59.90" value="<?php recoverPost('preco_promo'); ?>">
		</div><!--form-group-->	


		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem 2</label>
			<input type="file" name="imagem2"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Link:</label>
			<input type="text"  name="link" placeholder="https://site.com" value="<?php recoverPost('link'); ?>">
		</div><!--form-group-->	

		<div class="form-group">
			<label>Imagem Big 1</label>
			<input type="file" name="imagem_big1"/>
		</div><!--form-group-->
		<div class="form-group">
			<label>Imagem Big 2</label>
			<input type="file" name="imagem_big2"/>
		</div><!--form-group-->
		<div class="form-group">
			<label>Imagem Big 3</label>
			<input type="file" name="imagem_big3"/>
		</div><!--form-group-->



		<div class="form-group">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="produtos" />
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

	</form>



</div><!--box-content-->