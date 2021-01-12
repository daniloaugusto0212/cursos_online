<?php
define("TABLE_CATEGORIAS", "tb_site.categorias");
$categoria = Painel::selectAll(TABLE_CATEGORIAS);
$produtos = Painel::selectAll('produtos');
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

<!-- ##### Top Catagory Area Start ##### -->
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
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                    for ($i = 0; $i <= 5; $i++) {
                        $categoriaNome = Painel::select(
                            TABLE_CATEGORIAS,
                            'id = ?',
                            array($produtos[$i]['categoria_id'])
                        )['slug'];
                        ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtos[$i]['imagem']; ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtos[$i]['imagem2']; ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtos[$i]['slug']; ?>">
                                    <h6><?= $produtos[$i]['nome']; ?> </h6>
                                </a>
                                <p class="product-price">
                                    <span class="old-price">R$<?= Painel::convertMoney($produtos[$i]['preco']); ?>
                                    </span>R$<?= Painel::convertMoney($produtos[$i]['preco_promo']); ?>
                                </p>
                                <a style="background-color: #158742;" target="_blank" rel="external"
                                href="<?= $produtos[$i]['link']; ?>"
    actionBtn="comprar"                             class="btn essence-btn">Comprar</a>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Comprar -->
                                    <div class="add-to-cart-btn">
                                        <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtos[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
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
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                    if (count($produtos) >= 11) {
                        for ($i = 6; $i <= 11; $i++) {
                            $categoriaNome = Painel::select(
                                TABLE_CATEGORIAS,
                                'id = ?',
                                array($produtos[$i]['categoria_id'])
                            )['slug'];
                            ?>
                            <!-- Single Product -->
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtos[$i]['imagem']; ?>" alt="">
                                    <!-- Hover Thumb -->
                                    <img class="hover-img" src="<?= INCLUDE_PATH_PAINEL; ?>uploads/<?= $produtos[$i]['imagem2']; ?>" alt="">
                                    <!-- Favourite -->
                                    <div class="product-favourite">
                                        <a href="#" class="favme fa fa-heart"></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    
                                    <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtos[$i]['slug']; ?>">
                                        <h6><?= $produtos[$i]['nome']; ?> </h6>
                                    </a>
                                    <p class="product-price">
                                        <span class="old-price">R$<?= Painel::convertMoney($produtos[$i]['preco']); ?>
                                        </span>R$<?= Painel::convertMoney($produtos[$i]['preco_promo']); ?>
                                    </p>
                                    <a style="background-color: #158742;" target="_blank" rel="external"
                                    href="<?= $produtos[$i]['link']; ?>" actionBtn="comprar"
                                    class="btn essence-btn">Comprar</a>
                                    <!-- Hover Content -->
                                    <div class="hover-content">
                                        <!-- Comprar -->
                                        <div class="add-to-cart-btn">
                                        
                                            <a href="<?= INCLUDE_PATH; ?>cursos/<?= $categoriaNome; ?>/<?= $produtos[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
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

   