<?php
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $curso = Painel::select('produtos', 'id = ?', array($id));
} else {
    Painel::alert('erro', 'Você precisa passar o parametro ID.');
    die();
}
?>

<div class="box-content">
    <h2><i class="fas fa-user-edit"></i> Editar Curso</h2>

    <form  method="post" enctype="multipart/form-data"> <!--enctype="multipart/form-data" para funcionar o upload de imagens-->

        <?php
        if (isset($_POST['acao'])) {
            //Enviei o meu formulário.               
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $keywords = $_POST['keywords'];
            $preco = $_POST['preco'];
            $preco_promo = $_POST['preco_promo'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $link = $_POST['link'];
            $verifica = MySql::conectar()->prepare("SELECT `id` FROM `produtos` WHERE nome = ? AND categoria_id = ? AND id <> ?");
            $verifica->execute(array($nome,$_POST['categoria_id'],$id));
            if ($verifica->rowCount() == 0) {
                if ($imagem['name'] != '') {
                    //Existe o upload de imagem
                    if (Painel::imagemValida($imagem)) {
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($nome);
                        $arr = ['categoria_id' => $_POST['categoria_id'], 'nome' => $nome, 
                        'descricao' => $descricao,
                        'keywords' => $keywords,
                        'preco' => $preco, 'preco_promo' => $preco_promo, 'link' => $link, 'slug' => $slug, 
                        'id' => $id, 'nome_tabela' => 'produtos', 'imagem' => $imagem];
                        Painel::update($arr);
                        $curso = Painel::select('produtos', 'id = ?', array($id));
                        Painel::alert('sucesso', ' A curso foi editada junto com a imagem!');
                    } else {
                        Painel::alert('erro', ' O formato da imagem não é válido!');
                    }
                } else {
                    $imagem = $imagem_atual;
                    $slug = Painel::generateSlug($nome);               
                    $arr = ['categoria_id' => $_POST['categoria_id'], 'nome' => $nome, 'descricao' => $descricao, 'keywords' => $keywords,
                    'preco' => $preco, 'preco_promo' => $preco_promo, 'link' => $link, 'slug' => $slug,
                    'id' => $id, 'nome_tabela' => 'produtos'];
                    Painel::update($arr);
                    $curso = Painel::select('produtos', 'id = ?', array($id));
                    Painel::alert('sucesso', ' A curso foi editado com sucesso!');
                }
            }else{
                Painel::alert('erro', 'Já existe um curso com este nome!');
            }
        }
        ?>

        <div class="form-group">
            <label>Título: </label>
            <input type="text" name="nome" required value="<?php echo $curso['nome']; ?>">
        </div><!--form-group-->

        <div class="form-group">
			<label>Descrição:</label>
			<textarea  name="descricao"><?php echo $curso['descricao']; ?></textarea>
		</div>

        <div class="form-group">
			<label>Palavras Chave: <small>(separadas por vírgula - terminar com vírgula)</small></label>
			<textarea  name="keywords"><?php echo $curso['keywords']; ?></textarea>
		</div>

        <div class="form-group">
			<label>Preço:</label>
			<input type="text"  name="preco" placeholder="exemplo 59.90" value="<?php echo $curso['preco']; ?>">
		</div><!--form-group-->

        <div class="form-group">
			<label>Preço Final (com desconto):</label>
            <input type="text"  name="preco_promo" placeholder="exemplo 59.90" value="<?php echo $curso['preco_promo']; ?>">
		</div><!--form-group-->	

        <div class="form-group">
			<label>Link:</label>
			<input type="text"  name="link" placeholder="https://site.com" value="<?php echo $curso['link']; ?>">
		</div><!--form-group-->	

    

        <div class="form-group">
            <label>Conteúdo: </label>
            <textarea  class="tinymce" name="descricao"><?php echo $curso['descricao']; ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
		<label>Categoria:</label>
		<select name="categoria_id">
			<?php
				$categorias = Painel::selectAll('tb_site.categorias');
				foreach ($categorias as $key  =>  $value) {
			?>
			<option <?php if($value['id'] == $curso['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['nome']; ?></option>
			<?php } ?>
		</select>
		</div><!--form-group-->
        
        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem">
            <input type="hidden" name="imagem_atual" value="<?php echo $curso['imagem']; ?>">
        </div><!--form-group-->

        <div class="form-group">            
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-conten-->