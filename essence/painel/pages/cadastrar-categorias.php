<div class="box-content">
    <h2><i class="fas fa-user-plus"></i> Cadastrar Categoria</h2>

    <form  method="post" enctype="multipart/form-data"> <!--enctype="multipart/form-data" para funcionar o upload de imagens-->

		<?php

			if(isset($_POST['acao'])){				
				$nome = $_POST['nome'];				
				$capa = $_FILES['imagem'];

				if ($nome == '') {                    
                    Painel::alert('erro',' O campo nome não pode ficar vazio!');              
                }else if($capa['tmp_name'] == '' ){
					Painel::alert('erro','A imagem de imagem precisa ser selecionada.');
				}else{
					if(Painel::imagemValida($capa)){
						
						$imagem = Painel::uploadFile($capa);
						$slug = Painel::generateSlug($nome);
						$arr = ['nome'=>$nome, 'slug'=>$slug, 'order_id'=>'0', 'imagem'=>$imagem,
						'nome_tabela'=>'tb_site.categorias'];
                        Painel::insert($arr);   
                        Painel::alert('sucesso', ' O cadastro da categoria foi realizado com sucesso!');

						//Painel::alert('sucesso','O cadastro da notícia foi realizado com sucesso!');
						
					}
					
				}				
				
            }
            
            ?>
			
		<div class="form-group">
            <label>Nome da categoria: </label>
            <input type="text" name="nome">
        </div><!--form-group-->	

		<div class="form-group">
			<label>Imagem</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">			
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->
	</form>
</div><!--box-content-->