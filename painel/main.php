<?php
if (isset($_GET['logout'])) {
    Painel::logout();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Painel de controle</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= INCLUDE_PATH; ?>estilo/css/all.css" rel="stylesheet"> <!--load all styles -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="<?= INCLUDE_PATH_PAINEL ?>css/style.css">
</head>
<body>

<base base="<?= INCLUDE_PATH_PAINEL; ?>">
    <div class="menu">
        <div class="menu-wraper">
            <div class="box-usuario">
            <?php
            if ($_SESSION['img'] == '') {              
                ?>
                <div class="avatar-usuario">
                    <i class="fa fa-user"></i>
                </div><!--avatar-usuario-->
            <?php } else { ?>
                <div class="imagem-usuario">
                <img src="<?= INCLUDE_PATH_PAINEL ?>uploads/<?= $_SESSION['img'];?>" alt="Imagem do usuário">
            <?php } ?>
            </div><!--imagem-usuario-->
                <div class="nome-usuario">
                    <p><?= $_SESSION['nome']; ?></p>
                    <p><?= pegaCargo($_SESSION['cargo']); ?></p>
                </div><!--nome-usuario-->        
            </div><!--box-usuario-->
            <div class="items-menu">
                <h2>Cadastro</h2>
                <a <?php selecionadoMenu('cadastrar-depoimento'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>cadastrar-depoimento">Cadastrar Depoimento</a>

                <a <?php selecionadoMenu('cadastrar-slides'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>cadastrar-slides">Cadastrar Slides</a>

                <a <?php selecionadoMenu('limpar-visitas'); ?> 
                href="<?= INCLUDE_PATH_PAINEL ?>limpar-visitas">Limpar Visitas</a>
                
                <h2>Administração do Painel</h2>
                <a <?php selecionadoMenu('editar-usuario'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>editar-usuario">Editar Usuário</a>
                <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>adicionar-usuario">Adicionar Usuário</a>
                <h2>Configuração Geral</h2>
                <a <?php selecionadoMenu('editar-site'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>editar-site">Editar Site</a> 
                <h2>Gestão de Cursos</h2>
                <a <?php selecionadoMenu('cadastrar-categorias'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>cadastrar-categorias">Cadastrar Categorias</a>
                <a <?php selecionadoMenu('gerenciar-categorias'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>gerenciar-categorias">Gerenciar Categorias</a>
                <a <?php selecionadoMenu('cadastrar-curso'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>cadastrar-curso">Cadastrar Cursos</a>
                <a <?php selecionadoMenu('gerenciar-cursos'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>gerenciar-cursos">Gerenciar Cursos</a>
                <h2>Gestão</h2>
                <a <?php selecionadoMenu('listar-depoimentos'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>listar-depoimentos">Listar Depoimentos</a>
                <a <?php selecionadoMenu('listar-slides'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>listar-slides">Listar Slides</a>
                <h2>Gestão de clientes</h2>
                <a <?php selecionadoMenu('cadastrar-clientes'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>cadastrar-clientes">Cadastrar Clientes</a>
                <a <?php selecionadoMenu('gerenciar-clientes'); ?> 
                href="<?= INCLUDE_PATH_PAINEL?>gerenciar-clientes">Gerenciar Clientes</a>
            </div><!--items-menu-->
        </div><!--menu-wraper-->
    </div><!--menu-->

<header>
    <div class="center">
        <div class="menu-btn">
            <i class="fa fa-bars"></i>
        </div><!--menu-btn-->
       
        <div class="logout">
        <a <?php if (@$_GET['url'] == ''){?>style="background: #60727a;padding:15px;" <?php } ?> href="<?= INCLUDE_PATH_PAINEL ?>"><i class="fas fa-home"></i><span>Página Inicial </span>  </a>
            
            <a href="<?= INCLUDE_PATH ?>"><i class="fas fa-globe"></i><span> Site </span></a>

            <a href="<?= INCLUDE_PATH_PAINEL ?>?logout"><span>Sair </span><i class="fas fa-sign-out-alt"></i></a>
        </div><!--logout-->
        <div class="clear"></div><!--clear-->
    </div><!--center-->
</header>
<div class="content">

    <?php Painel::carregarPagina(); ?>

    
</div><!--content-->
<script src="<?= INCLUDE_PATH ?>js/jquery.js"></script> 
<script src="<?= INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<script src="<?= INCLUDE_PATH_PAINEL ?>js/jquery.ajaxform.js"></script> 
<script src="<?= INCLUDE_PATH ?>js/constants.js"></script> 
<script src="<?= INCLUDE_PATH_PAINEL ?>js/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({
    selector:".tinymce",
    plugins: "image",
    height:300
    });</script>
    <script src="<?= INCLUDE_PATH_PAINEL ?>js/helperMask.js" ></script>    
    <?php Painel::loadJS(array('ajax.js'), 'gerenciar-clientes'); ?>
    <?php Painel::loadJS(array('ajax.js'), 'cadastrar-clientes'); ?>
    <?php Painel::loadJS(array('ajax.js'), 'editar-cliente'); ?>
</body>
</html>


