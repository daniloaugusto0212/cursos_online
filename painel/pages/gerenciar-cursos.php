<?php

if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    $selectImagem = MySql::conectar()->prepare("SELECT imagem FROM `produtos` WHERE id = ?");
    $selectImagem->execute(array($_GET['excluir']));

    $imagem = $selectImagem->fetch()['imagem'];
    Painel::deleteFile($imagem);
    Painel::deletar('produtos', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL . 'gerenciar-cursos');
} elseif (isset($_GET['order']) && isset($_GET['id'])) {
    Painel::orderItem('produtos', $_GET['order'], $_GET['id']);
}
    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 50;

    //$cursos = Painel::selectAll('produtos', ($paginaAtual - 1) * $porPagina, $porPagina);
    $cursos = Painel::selectAllWithParm('produtos', "status = ? ORDER BY order_id ASC LIMIT " . ($paginaAtual - 1) * $porPagina . "," . $porPagina, array(1));

?>

<div class="box-content">
    <h2><i class="far fa-list-alt"></i> Cursos Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Título</td>
                <td>Categoria</td>
                <td>Imagem</td>
                <td>Ações</td>
                <td>Ordenar</td>
            </tr>

            <?php
            foreach ($cursos as $key => $value) {
                $nomeCategoria = Painel::select('tb_site.categorias', 'id=?', array($value['categoria_id']))['nome'];
                ?>
            <tr>
                <td><?= $value['nome']; ?></td>   
                <td><?= $nomeCategoria; ?></td>         
                <td><img style="width: 50px;height: 50px;" src="<?= INCLUDE_PATH_PAINEL ?>uploads/<?= $value['imagem']; ?>"/></td>
                <td>
                    <?php if ($value['status'] == 0) : ?>
                        <a style="background-color: aquamarine;" title="Ativar" class="btn edit" href="<?= INCLUDE_PATH_PAINEL ?>gerenciar-cursos?id=<?= $value['id']; ?>status=1"><i class="fa fa-angle-left" ></i></a>
                    <?php else : ?>
                            <a style="background-color: #00BFA5;" title="Inativar" class="btn edit" href="<?= INCLUDE_PATH_PAINEL ?>gerenciar-cursos?id=<?= $value['id']; ?>status=0"><i class="fa fa-check" ></i></a>
                    <?php endif ?>
                    <a title="Editar" class="btn edit" href="<?= INCLUDE_PATH_PAINEL ?>editar-curso?id=<?= $value['id']; ?>"><i class="fa fa-pen" ></i></a>
                    
                    <a title="Apagar" actionBtn="delete" class="btn delete" href="<?= INCLUDE_PATH_PAINEL ?>gerenciar-cursos?excluir=<?= $value['id']; ?>"><i class="fa fa-times"></i></a>
                </td>
                <td>
                    <a class="btn order" href="<?= INCLUDE_PATH_PAINEL ?>gerenciar-cursos?order=up&id=<?= $value['id']; ?>"><i class="fa fa-angle-up"></i></a>
                    <a class="btn order" href="<?= INCLUDE_PATH_PAINEL ?>gerenciar-cursos?order=down&id=<?= $value['id']; ?>"><i class="fa fa-angle-down"></i></a>
                </td>
            </tr>

            <?php } ?>
        </table>
    </div><!--wraper-table-->

    <div class="paginacao">
        <?php
            $totalPagina = ceil(count(Painel::selectAll('produtos')) / $porPagina);

        for ($i = 1; $i <= $totalPagina; $i++) {
            if ($i == $paginaAtual) {
                echo '<a class="page-selected" href="' . INCLUDE_PATH_PAINEL . 'gerenciar-cursos?pagina=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="' . INCLUDE_PATH_PAINEL . 'gerenciar-cursos?pagina=' . $i . '">' . $i . '</a>';
            }
        }
        ?>
    </div><!--paginacao-->

</div><!--box-content-->
