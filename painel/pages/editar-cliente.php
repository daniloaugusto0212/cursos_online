<?php
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id'];
        $cliente = Painel::select('tb_admin.clientes','id = ?',array($id));    
    }else{
        Painel::alert('erro','Você precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fas fa-user-edit"></i> Editar Cliente</h2>

    <form  class="ajax" atualizar method="post" action="<?php echo INCLUDE_PATH_PAINEL ?>ajax/forms.php" enctype="multipart/form-data"> <!--enctype="multipart/form-data" para funcionar o upload de imagens-->

    <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>E-mail: </label>
            <input type="text" name="email" value="<?php echo $cliente['email']; ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Tipo: </label>
            <select  name="tipo_cliente">
            <option <?php if($cliente['tipo'] == 'fisico') echo 'selected';?> value="fisico">Físico</option>
            <option <?php if($cliente['tipo'] == 'juridico') echo 'selected';?> value="juridico">Jurídico</option>               
            </select>
        </div><!--form-group-->

        <?php
            if($cliente['tipo'] == 'fisico'){
        ?>
        
        <div ref="cpf" class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" value="<?php echo $cliente['cpf_cnpj']; ?>">
        </div><!--form-group-->

        <div style="display:none;" ref="cnpj" class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" >
        </div><!--form-group-->

            <?php }else { ?>
        <div style="display:none;" ref="cpf" class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf">
        </div><!--form-group-->

        <div style="display:block;" ref="cnpj" class="form-group">
            <label>CNPJ</label>
            <input type="text" name="cnpj" value="<?php echo $cliente['cpf_cnpj']; ?> ">
        </div><!--form-group-->

            <?php }?>

        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem" >            
        </div><!--form-group-->

        <div class="form-group">            
            <input type="hidden" name="imagem_original" value="<?php echo $cliente['imagem']; ?> ">            
        </div><!--form-group-->

        <div class="form-group">            
            <input type="hidden" name="tipo_acao" value="atualizar_cliente" >            
        </div><!--form-group-->

        <div class="form-group">            
            <input type="hidden" name="id" value="<?php echo $cliente['id']; ?>" >            
        </div><!--form-group-->

        <div class="form-group">            
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
    </form>
</div><!--box-conten-->