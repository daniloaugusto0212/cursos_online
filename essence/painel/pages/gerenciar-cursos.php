<?php

    if (isset($_GET['excluir'])) {
        $idExcluir = intval($_GET['excluir']);
        $selectImagem = MySql::conectar()->prepare("SELECT imagem FROM `produtos` WHERE id = ?");
        $selectImagem->execute(array($_GET['excluir']));
        
        $imagem = $selectImagem->fetch()['imagem'];
        Painel::deleteFile($imagem);
        Painel::deletar('produtos',$idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'gerenciar-cursos');
    }else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('produtos',$_GET['order'],$_GET['id']);
    }
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 50;

    $cursos = Painel::selectAll('produtos',($paginaAtual - 1) * $porPagina,$porPagina);
    
?>

<div class="box-content">
    <h2><i class="far fa-list-alt"></i> Cursos Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Título</td>
                <td>Categoria</td>
                <td>Imagem</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
                <td>#</td>
            </tr>

            <?php
                foreach ($cursos as $key => $value) {  
                $nomeCategoria = Painel::select('tb_site.categorias','id=?',array($value['categoria_id']))['nome'];                
            ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>   
                <td><?php echo $nomeCategoria; ?></td>         
                <td><img style="width: 50px;height: 50px;" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem']; ?>"/></td>
                <td><a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL ?>editar-curso?id=<?php echo $value['id']; ?>"><i class="fa fa-pen" ></i> Editar</a></td>
                <td><a actionBtn="delete" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-cursos?excluir=<?php echo $value['id']; ?>"><i class="fa fa-times"></i> Excluir</a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-cursos?order=up&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>gerenciar-cursos?order=down&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
            </tr>

                <?php } ?>
        </table>
    </div><!--wraper-table-->

    <div class="paginacao">
        <?php
            $totalPagina = ceil(count(Painel::selectAll('produtos')) / $porPagina);

            for ($i=1; $i <= $totalPagina; $i++) { 
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'gerenciar-cursos?pagina='.$i.'">'.$i.'</a>';
                }else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'gerenciar-cursos?pagina='.$i.'">'.$i.'</a>';
                }
            }
        ?>
    </div><!--paginacao-->

</div><!--box-content-->