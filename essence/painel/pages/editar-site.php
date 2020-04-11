<?php
    $site = Painel::select('tb_site.config',false);
?>
<div class="box-content">
    <h2><i class="fa fa-pen"></i> Editar Configurações do Site</h2>
 
    <form method="post" enctype="multipart/form-data">
       
        <?php
            if(isset($_POST['acao'])){
                if(Painel::update($_POST,true)){
                    Painel::alert('sucesso','O site foi editado com sucesso!');
                    $servico = Painel::select('tb_site.config',false);
                }else{
                    Painel::alert('erro','Campos vázios não são permitidos.');
                }
            }
        ?>  
             
 
        <div class="form-group">
            <label>Título do site:</label>
            <input type="text" name="titulo" value="<?php echo $site['titulo'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Autor:</label>
            <input type="text" name="nome_autor" value="<?php echo $site['nome_autor'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Descrição do autor:</label>
            <textarea name="descricao"><?php echo $site['descricao'] ?></textarea>
        </div><!--form-group-->
       
        <div class="form-group">
            <label>Ícone 1:</label>
            <input type="text" name="icone1" value="<?php echo $site['icone1'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Título 1:</label>
            <input type="text" name="titulo1" value="<?php echo $site['titulo1'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Descrição 1:</label>
            <textarea name="descricao1"><?php echo $site['descricao1'] ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Ícone 2:</label>
            <input type="text" name="icone2" value="<?php echo $site['icone2'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Título 2:</label>
            <input type="text" name="titulo2" value="<?php echo $site['titulo2'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Descrição 2:</label>
            <textarea name="descricao2"><?php echo $site['descricao2'] ?></textarea>
        </div><!--form-group-->

        <div class="form-group">
            <label>Ícone 3:</label>
            <input type="text" name="icone3" value="<?php echo $site['icone3'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Título 3:</label>
            <input type="text" name="titulo3" value="<?php echo $site['titulo3'] ?>">
        </div><!--form-group-->

        <div class="form-group">
            <label>Descrição 3:</label>
            <textarea name="descricao3"><?php echo $site['descricao3'] ?></textarea>
        </div><!--form-group-->
            
        <!--
        Opçao para usar loop
        <?php
            for ($i=1; $i <= 3; $i++) { 
               
        ?>
        <div class="form-group">
            <label>Ícone <?php echo $i; ?>:</label>
            <input type="text" name="icone<?php echo $i; ?>" value="<?php echo $site['icone'.$i] ?>">
        </div><!-.-form-group-.->

        <div class="form-group">
            <label>Título <?php echo $i; ?>:</label>
            <input type="text" name="titulo<?php echo $i; ?>" value="<?php echo $site['titulo'.$i] ?>">
        </div><!-.-form-group-.->

        <div class="form-group">
            <label>Descrição <?php echo $i; ?>:</label>
            <textarea name="descricao<?php echo $i; ?>"><?php echo $site['descricao'.$i] ?></textarea>
        </div><!-.-form-group-.->
            <?php } ?> -->

        
 
        <div class="form-group">            
            <input type="hidden" name="nome_tabela" value="tb_site.config" />
            <input type="submit" name="acao" value="Atualizar!">
        </div><!--form-group-->
 
    </form>
 
 
 
</div><!--box-content-->

