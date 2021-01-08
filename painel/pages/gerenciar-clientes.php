
<div class="box-content">
    <h2><i class="far fa-list-alt"></i> Clientes Cadastrados</h2>
    
    <div class="boxes">
    <?php
        $clientes = MySql::conectar()->prepare("SELECT * FROM `tb_admin.clientes`");
        $clientes->execute();
        $clientes = $clientes->fetchAll();
        foreach($clientes as $value) { 
                
        ?>
        <div class="box-single-wraper">
            <div class="box-single">
                <div class="topo-box">
                <?php
                    if ($value['imagem'] == '') {                        
                ?>
                    <h2><i class="fa fa-user" ></i></h2>
                    <?php }else{ ?>
                        <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem'] ?>" alt="perfil">
                    <?php } ?>
                </div><!--topo-box-->

                <div class="body-box">
                    <p><b><i class="fa fa-pen" ></i> Nome:</b> <?php echo $value['nome']; ?> </p>
                    <p><b><i class="fa fa-envelope-open-text" ></i> E-mail:</b> <?php echo $value['email']; ?></p>
                    <p><b><i class="fa fa-pen" ></i> Tipo:</b> <?php echo ucfirst($value['tipo']); ?></p>
                    <p><b><i class="fa fa-pen" ></i> <?php
                        if ($value['tipo'] == 'fisico') {
                            echo 'CPF ';
                        }else {
                            echo 'CNPJ ';
                        }
                    ?>:</b> <?php echo $value['cpf_cnpj']; ?></p>
                    <div class="group-btn">
                        <a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-cliente?id=<?php echo $value['id']; ?>"><i class="fa fa-pen" ></i> Editar</a>

                        <a class="btn delete" item_id="<?php echo $value['id']; ?>"  href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-times"></i> Excluir</a>
                    </div><!--group-btn-->
                </div><!--body-box-->

            </div><!--box-single-->
        </div><!--box-single-wraper-->

        <?php } ?>

        <div class="clear"></div>

    </div><!--boxes-->

</div><!--box-content-->