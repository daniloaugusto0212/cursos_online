<?php

define("TABLE_CATEGORIAS", "tb_site.categorias");
define("SELECT_FOR_CATEGORIA_ID_LIMIT_6", "categoria_id = ? AND status = 1 ORDER BY order_id DESC LIMIT 6");
$categoria = Painel::selectAll(TABLE_CATEGORIAS);
$produtosDieta = Painel::selectAllWithParm('produtos', SELECT_FOR_CATEGORIA_ID_LIMIT_6, array(19));
$produtosTecnologia = Painel::selectAllWithParm('produtos', SELECT_FOR_CATEGORIA_ID_LIMIT_6, array(11));
$produtosCulinaria = Painel::selectAllWithParm('produtos', SELECT_FOR_CATEGORIA_ID_LIMIT_6, array(10));

?>
    
<section class="bg-img background-overlay">
    <video width="100%" type="video/mp4" src="<?= INCLUDE_PATH ?>videos/study.m4v" 
    autoplay muted loop subtitle="Vídeo de estudande" description="Estudo de cursos online"></video>
    <div class="container h-100 text-video">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="hero-content">
                    <h6>ESTUDE QUANDO</h6>
                    <h6>E ONDE QUISER</h6>
                    <a href="#populares" class="btn essence-btn scroll-suave">Ver cursos</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ##### Welcome Area End ##### -->

<!-- Navegar pelas categorias -->
<div class="top_catagory_area clearfix categ">
    <div class="cont">
        <div class="text-center">
            <h3>Navegue pelas categorias</h3>
        </div>
        <div class="row justify-content-center">
        
            <?php
            for ($i = 0; $i < 6; $i++) {
                ?>
            
                <!-- Categorias da home-->
                <div class="col-12 col-sm-6 col-md-4 categoria_home">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img"
                    style="background-image: url(<?= INCLUDE_PATH_PAINEL ?>uploads/<?= $categoria[$i]['imagem']; ?>);">
                        <div class="catagory-content">
                            <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoria[$i]['slug']; ?>"><?= $categoria[$i]['nome']; ?></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
        </div>
    </div>
</div>

<!-- Curso destaque-->
<!-- <div class="cta-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/bg-5.jpg);">
                    <div class="h-100 d-flex align-items-center justify-content-end">
                        <div class="cta--text">
                            <h6>-60%</h6>
                            <h2>Curso em destaque</h2>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Cursos da home(mais populares) -->
<section class="new_arrivals_area section-padding-80 clearfix"id="populares">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center" >
                    <h2>Mais Populares</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3 class="text-left">Dieta</h3><br>
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                    if (count($produtosDieta) >= 6) {
                        $totalDieta = 6;
                    } else {
                        $totalDieta = count($produtosDieta);
                    }
                    for ($i = 0; $i < $totalDieta; $i++) {
                        $categoriaNome = Painel::select(
                            TABLE_CATEGORIAS,
                            'id = ?',
                            array($produtosDieta[$i]['categoria_id'])
                        )['slug'];
                        ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtosDieta[$i]['imagem']; ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtosDieta[$i]['imagem2']; ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtosDieta[$i]['slug']; ?>">
                                    <h6><?= $produtosDieta[$i]['nome']; ?> </h6>
                                </a>
                                <p class="product-price">
                                    <span class="old-price">R$<?= Painel::convertMoney($produtosDieta[$i]['preco']); ?>
                                    </span>R$<?= Painel::convertMoney($produtosDieta[$i]['preco_promo']); ?>
                                </p>
                                <a style="background-color: #158742;" target="_blank" rel="external"
                                href="<?= $produtosDieta[$i]['link']; ?>" actionBtn="comprar" class="btn essence-btn">Quero saber mais</a>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Comprar -->
                                    <div class="add-to-cart-btn">
                                        <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtosDieta[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    
                </div>
            </div>
        </div>
    </div>
    <div style="padding-top:40px;" class="container">
        <h3 class="text-left">Tecnologia</h3><br>
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                    if (count($produtosTecnologia) >= 6) {
                        $totalTecnologia = 6;
                    } else {
                        $totalTecnologia = count($produtosTecnologia);
                    }
                    for ($i = 0; $i < $totalTecnologia; $i++) {
                        $categoriaNome = Painel::select(
                            TABLE_CATEGORIAS,
                            'id = ?',
                            array($produtosTecnologia[$i]['categoria_id'])
                        )['slug'];
                        ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtosTecnologia[$i]['imagem']; ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtosTecnologia[$i]['imagem2']; ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                
                                <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtosTecnologia[$i]['slug']; ?>">
                                    <h6><?= $produtosTecnologia[$i]['nome']; ?> </h6>
                                </a>
                                <p class="product-price">
                                    <span class="old-price">R$<?= Painel::convertMoney($produtosTecnologia[$i]['preco']); ?>
                                    </span>R$<?= Painel::convertMoney($produtosTecnologia[$i]['preco_promo']); ?>
                                </p>
                                <a style="background-color: #158742;" target="_blank" rel="external"
                                href="<?= $produtosTecnologia[$i]['link']; ?>" actionBtn="comprar"
                                class="btn essence-btn">Quero saber mais</a>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Comprar -->
                                    <div class="add-to-cart-btn">
                                    
                                        <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtosTecnologia[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <div style="padding-top:40px;" class="container">
        <h3 class="text-left">Culinária</h3><br>
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                    if (count($produtosCulinaria) >= 6) {
                        $totalCulinaria = 6;
                    } else {
                        $totalCulinaria = count($produtosCulinaria);
                    }
                    for ($i = 0; $i < $totalCulinaria; $i++) {
                        $categoriaNome = Painel::select(
                            TABLE_CATEGORIAS,
                            'id = ?',
                            array($produtosCulinaria[$i]['categoria_id'])
                        )['slug'];
                        ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtosCulinaria[$i]['imagem']; ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtosCulinaria[$i]['imagem2']; ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                
                                <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtosCulinaria[$i]['slug']; ?>">
                                    <h6><?= $produtosCulinaria[$i]['nome']; ?> </h6>
                                </a>
                                <p class="product-price">
                                    <span class="old-price">R$<?= Painel::convertMoney($produtosCulinaria[$i]['preco']); ?>
                                    </span>R$<?= Painel::convertMoney($produtosCulinaria[$i]['preco_promo']); ?>
                                </p>
                                <a style="background-color: #158742;" target="_blank" rel="external"
                                href="<?= $produtosCulinaria[$i]['link']; ?>" actionBtn="comprar"
                                class="btn essence-btn">Quero saber mais</a>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Comprar -->
                                    <div class="add-to-cart-btn">
                                    
                                        <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtosCulinaria[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div  style="padding-top: 80px;" class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <a  href="<?php INCLUDE_PATH ?>cursos" class="btn essence-btn">Todos os cursos</a>
                </div>
            </div>
        </div>
    </div>
    
</section>

   