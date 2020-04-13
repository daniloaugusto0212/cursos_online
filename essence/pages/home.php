<?php
$categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ");
$categoria->execute();
$categoria = $categoria->fetchAll();

$produtos = MySql::conectar()->prepare("SELECT * FROM `produtos` ");
$produtos->execute();
$produtos = $produtos->fetchAll();

?>

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span>3</span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="img/product-img/product-1.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>

                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="img/product-img/product-2.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>

                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="img/product-img/product-3.jpg" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                          <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <span class="badge">Mango</span>
                            <h6>Button Through Strap Mini Dress</h6>
                            <p class="size">Size: S</p>
                            <p class="color">Color: Red</p>
                            <p class="price">$45.00</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>$274.00</span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>discount:</span> <span>-15%</span></li>
                    <li><span>total:</span> <span>$232.00</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout.html" class="btn essence-btn">check out</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Right Side Cart End ##### -->

    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/bg-img/bg-1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <h6>ESTUDE QUANDO E</h6>
                        <h2>ONDE QUISER</h2>
                        <a href="#populares" class="btn essence-btn scroll-suave">Ver cursos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area clearfix categ">
        <div class="container">
            <div class="text-center">
                <h3>Navegue pelas categorias</h3>
            </div>
            <div class="row justify-content-center">
            
                <?php 
                for ($i=0; $i < 6; $i++) { 
                    ?>
                
                <!-- Categorias da home-->
                <div class="col-12 col-sm-6 col-md-4 categoria_home">
                    <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url(<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $categoria[$i]['imagem']; ?>);">
                        <div class="catagory-content">
                            <a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $categoria[$i]['slug']; ?>"><?php echo $categoria[$i]['nome']; ?></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
               
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

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
    <!-- ##### CTA Area End ##### -->

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
                        
                            for ($i=0; $i < 5; $i++) {    
                                $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
                                $sql->execute(array($produtos[$i]['categoria_id']));
                                $categoriaNome = $sql->fetch()['slug'];                             
                                
                                ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $produtos[$i]['imagem']; ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $produtos[$i]['imagem2']; ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                
                                <a href="<?php echo INCLUDE_PATH ?>single-produto">
                                    <h6><?php echo $produtos[$i]['nome']; ?> </h6>
                                </a>
                                <p class="product-price"><span class="old-price"><?php echo $produtos[$i]['preco']; ?></span><?php echo $produtos[$i]['preco_promo']; ?></p>
                                <a style="background-color: #158742;" href="<?php echo $produtos[$i]['link']; ?>" class="btn essence-btn">Comprar</a>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Comprar -->
                                    <div class="add-to-cart-btn">
                                  
                                    
                                        <a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $categoriaNome; ?>/<?php echo $produtos[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                    
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
                        
                            for ($i=4; $i < 9; $i++) {    
                                $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
                                $sql->execute(array($produtos[$i]['categoria_id']));
                                $categoriaNome = $sql->fetch()['slug'];                             
                                
                                ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $produtos[$i]['imagem']; ?>" alt="">
                                <!-- Hover Thumb -->
                                <img class="hover-img" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $produtos[$i]['imagem2']; ?>" alt="">
                                <!-- Favourite -->
                                <div class="product-favourite">
                                    <a href="#" class="favme fa fa-heart"></a>
                                </div>
                            </div>
                            <!-- Product Description -->
                            <div class="product-description">
                                
                                <a href="<?php echo INCLUDE_PATH ?>single-produto">
                                    <h6><?php echo $produtos[$i]['nome']; ?> </h6>
                                </a>
                                <p class="product-price"><span class="old-price"><?php echo $produtos[$i]['preco']; ?></span><?php echo $produtos[$i]['preco_promo']; ?></p>
                                <a style="background-color: #158742;" href="<?php echo $produtos[$i]['link']; ?>" class="btn essence-btn">Comprar</a>
                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Comprar -->
                                    <div class="add-to-cart-btn">
                                  
                                    
                                        <a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $categoriaNome; ?>/<?php echo $produtos[$i]['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                       
                    </div>
                </div>
            </div>
        </div>
        <div  style="padding-top: 80px;" class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <a  href="<?php INCLUDE_PATH ?>loja" class="btn essence-btn">Todos os cursos</a>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
    <!-- ##### New Arrivals Area End ##### -->

   