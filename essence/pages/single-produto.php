<?php    
    Site::contadorDet();
    $url = explode('/',$_GET['url']);

	$verifica_categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'loja');
	}
	$categoria_info = $verifica_categoria->fetch();

	$post = MySql::conectar()->prepare("SELECT * FROM `produtos` WHERE slug = ? AND categoria_id = ?");
	$post->execute(array($url[2],$categoria_info['id']));
	if($post->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'loja');
	}

	//É POR QUE MINHA NOTICIA EXISTE
	$post = $post->fetch();

?>
    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    

    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <img class="carrossel" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $post['imagem_big1']; ?>" alt="">
                <img class="carrossel" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $post['imagem_big2']; ?>" alt="">
                <img class="carrossel" src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $post['imagem_big3']; ?>" alt="">
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            
            <a href="cart.html">
                <h2><?php echo $post['nome']; ?></h2>
            </a>
            <p class="product-price"><span class="old-price"><?php echo $post['preco']; ?></span> <?php echo $post['preco_promo']; ?></p>
            <p class="product-desc"><?php echo $post['descricao']; ?> </p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
               
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <a style="background-color: #158742;" href="<?php echo $post['link'];?>" class="btn essence-btn">Comprar</a>
                                <!-- Hover Content -->
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->

  