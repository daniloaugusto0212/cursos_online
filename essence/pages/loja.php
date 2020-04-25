<?php
    $url = explode('/',$_GET['url']);    
	if(!isset($url[2]))
	{
	$categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE slug = ?");
	$categoria->execute(array(@$url[1]));
	$categoria = $categoria->fetch();
?>
<?php
    $porPagina = 9;
    if(!isset($_POST['parametro'])){
    if($categoria['nome'] == ''){
        $cat = 'Visualizando todos os Cursos';
        $totCursos = 'cursos disponíveis em todas as categorias';
        $totProdutos = MySql::conectar()->prepare("SELECT `id` FROM `produtos`");
        $totProdutos->execute();
        $totProdutos = $totProdutos->fetchAll();
        $totProdutos = count($totProdutos);        
    }else{
        $cat = 'Visualizando Cursos em '.$categoria['nome'].'';
        $totCursos = 'cursos disponíveis em '.$categoria['nome'].'';
        $totProdutos = MySql::conectar()->prepare("SELECT * FROM `produtos` WHERE categoria_id = $categoria[id]");
        $totProdutos->execute();
        $totProdutos = $totProdutos->fetchAll();
        $totProdutos = count($totProdutos);
    }
    }else{
        $cat = ' Busca realizada com sucesso!';
    }

    $query = "SELECT * FROM `produtos` ";
    if($categoria['nome'] != ''){
        $categoria['id'] = (int)$categoria['id'];
        $query.="WHERE categoria_id = $categoria[id]";
    }
    if(isset($_POST['parametro'])){
        if(strstr($query,'WHERE') !== false){
            $busca = $_POST['parametro'];
            $query.=" AND nome LIKE '%$busca%'";
        }else{
            $busca = $_POST['parametro'];
            $query.=" WHERE nome LIKE '%$busca%'";
        }
    }
    $query2 = "SELECT * FROM `produtos` "; 
    if($categoria['nome'] != ''){
            $categoria['id'] = (int)$categoria['id'];
            $query2.="WHERE categoria_id = $categoria[id]";
    }
    if(isset($_POST['parametro'])){
        if(strstr($query2,'WHERE') !== false){
            $busca = $_POST['parametro'];
            $query2.=" AND nome LIKE '%$busca%'";
        }else{
            $busca = $_POST['parametro'];
            $query2.=" WHERE nome LIKE '%$busca%'";
        }
    }
    $totalPaginas = MySql::conectar()->prepare($query2);
    $totalPaginas->execute();
    $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
    if(!isset($_POST['parametro'])){
        if(isset($_GET['pagina'])){
            $pagina = (int)$_GET['pagina'];
            if($pagina > $totalPaginas){
                $pagina = 1;
            }
            
            $queryPg = ($pagina - 1) * $porPagina;
            $query.=" ORDER BY order_id DESC LIMIT $queryPg,$porPagina";
        }else{
            $pagina = 1;
            $query.=" ORDER BY order_id DESC LIMIT 0,$porPagina";
        }
    }else{

        $query.=" ORDER BY order_id ASC";
    }
    $sql = MySql::conectar()->prepare($query);
    $sql->execute();
    $produtos = $sql->fetchAll();
?>     

    <!-- #####  topo loja Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(<?php echo INCLUDE_PATH ?>img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2><?php echo $cat; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### topo loja  End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Menu lateral categorias ##### -->
                        <div class="widget catagory mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">CATEGORIAS</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content collapse show">                
                                    </li>
                                    <?php
                                     $categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ");
                                     $categorias->execute();
                                     $categorias = $categorias->fetchAll();            
                                    for ($i=0; $i < count($categorias); $i++) { 
                                        
                                     ?> 
                                    
                                    <!-- Single Item -->
                                    <li data-toggle="collapse" data-target="#<?php echo $categorias[$i]['nome']; 
                                    ?>"><a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $categorias[$i]['slug']; ?>"><?php echo $categorias[$i]['nome']; ?> </a>
                                        
                                    </li>
                                    <?php } ?>
                                    <li data-toggle="collapse" data-target="#"><a href="<?php echo INCLUDE_PATH; ?>loja/">Todas </a>
                                    <!-- Single Item -->                                  
                                   
                                </ul>
                            </div>
                        </div>

                        <!-- ##### 'Single Widge't ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <!-- <h6 class="widget-title mb-30">FILTRAR POR</h6>
                           
                            <p class="widget-title2 mb-30">PREÇO</p>

                            <div class="widget-desc">
                                <div class="slider-range">
                                    <div data-min="5" data-max="1000" data-unit="R$" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="5" data-value-max="1000" data-label-result="Valor:">
                                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    </div>
                                    <div class="range-price">Valor: R$5.00 - R$1000.00</div>
                                </div>
                            </div> -->
                        </div>                       
                       
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span><?php echo $totProdutos; ?></span> <?php echo $totCursos ?></p>
                                    </div>
                                    <!-- Sorting -->
                                    <!-- <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <?php
						foreach($produtos as $key=>$value){
						$sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
						$sql->execute(array($value['categoria_id']));
						$categoriaNome = $sql->fetch()['slug'];
					    ?>

                            <!-- Single Product -->
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="single-product-wrapper">
                                    <!-- Product Image -->
                                    <div class="product-img">
                                        <img  src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem']; ?>" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $value['imagem2']; ?>" alt="">
                                       
                                        <!-- Favourite -->
                                        <div class="product-favourite">
                                            <a href="#" class="favme fa fa-heart"></a>
                                        </div>
                                    </div>

                                    <!-- Product Description -->
                                    <div class="product-description">
                                        
                                        <a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>">
                                            <h6><?php echo $value['nome']; ?></h6>
                                        </a>
                                        <p class="product-price"><span class="old-price">R$<?php echo $value['preco']; ?></span> R$<?php echo $value['preco_promo']; ?></p>

                                        <a style="background-color: #158742;" href="<?php echo $value['link']; ?>" class="btn essence-btn">Comprar</a>
                                        <div class="hover-content">
                                            <!-- Detalhes -->
                                            <div class="add-to-cart-btn">
                                                <a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>" class="btn essence-btn">Detalhes</a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        </div>
                    </div>

                    
                    <!-- Pagination -->
                    <nav aria-label="navigation text-center">
                        <ul class="pagination mt-50 mb-70 ">
                            <!-- <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li> -->
                            <?php
                                if(!isset($_POST['parametro'])){
                                for($i = 1; $i <= $totalPaginas; $i++){
                                    $catStr = ($categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
                                    if($pagina == $i)
                                        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH.'loja'.$catStr.'?pagina='.$i.'">'.$i.'</a></li>';
                                    else
                                        echo '<li class="page-item"><a class="page-link" href="'.INCLUDE_PATH.'loja'.$catStr.'?pagina='.$i.'">'.$i.'</a></li>';
                                }
                            }
                             ?>                        
                            
                            <!-- <li class="page-item"><a class="page-link" href=""><i class="fa fa-angle-right"></i></a></li> -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
    <?php }else{ 
	include('single-produto.php');
}
?>
  