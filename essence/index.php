<?php
 include('config.php');
 Site::updateUsuarioOnline(); 
 Site::contador();
 $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ");
 $categoria->execute();
 $categoria = $categoria->fetchAll(); 

 $produtos = MySql::conectar()->prepare("SELECT * FROM `produtos` ");
 $produtos->execute();
 $produtos = $produtos->fetchAll();

 
 ?>
 

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Essence - Cursos online</title>

    <!-- Favicon  -->
    <link rel="icon" href="<?php echo INCLUDE_PATH; ?>img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/core-style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>style.css">

</head>

<body>

<base base="<?php echo INCLUDE_PATH; ?>" />
    <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        switch ($url) {
            case 'quem-somos':
                echo '<target target="quem-somos"  />';
                break;

            case 'contato':
                echo '<target target="contato"  />';
                break;            
        }

    ?>
    <!-- ##### Header Area Start ##### -->
<div class="sucesso">Cadastro efetuado com sucesso!</div><!--sucesso-->
<div class="overlay-loading">
    <img src="<?php echo INCLUDE_PATH ?>img/ajax-loader.gif" />
</div> <!--overlay-loading-->  
<header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <div class="logo">
                    <a class="nav-brand " href="<?php echo INCLUDE_PATH; ?>">DANSOL</a>
                    <a class="log" href="<?php echo INCLUDE_PATH; ?>">cursos online</a>
                </div>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="<?php echo INCLUDE_PATH; ?>loja">Cursos</a></li>
                            <li><a href="<?php echo INCLUDE_PATH; ?>loja">Categorias</a>
                                <ul class="dropdown">
                                <?php
                                foreach($categoria as $key => $value){
                                    ?>
                                    <li><a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $value['slug']; ?>"> <?php echo $value['nome']; ?></a></li>
                                <?php } ?>
                                    
                                </ul>
                            </li>
                            <li><a href="<?php INCLUDE_PATH ?>quem-somos">Quem somos</a></li>
                            <li><a href="<?php INCLUDE_PATH ?>contato">Contato</a></li>
                            
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <!-- <div class="search-area">
                    <form  method="post">
                        <input type="text" name="parametro" id="headerSearch" placeholder="Pesquisar...">
                        <button type="submit" name="buscar"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div> -->
                <!-- Favourite Area -->
                <!-- <div class="favourite-area">
                    <a href="#"><img src="<?php echo INCLUDE_PATH;?>img/core-img/heart.svg" alt=""></a>
                </div> -->
                <!-- User Login Info -->
                <!-- <div class="user-login-info">
                    <a href="#"><img src="<?php echo INCLUDE_PATH;?>img/core-img/user.svg" alt=""></a>
                </div> -->
                <!-- Cart Area -->
                <!-- <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="<?php echo INCLUDE_PATH;?>img/core-img/bag.svg" alt=""> <span>3</span></a>
                </div> -->
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->
    <?php
        if (file_exists('pages/'.$url.'.php')) {
            include('pages/'.$url.'.php');
        }else{
            if ($url != 'quem-somos' && $url != 'contato') {
                //Podemos fazer o que quiser, pois a página não existe
                $urlPar = explode('/',$url)[0];
                if ($urlPar != 'loja'){ 
                    $pagina404 = true;
                    include('pages/404.php');
                }else{
                    include('pages/loja.php');
                }                
            }else{                
                include('pages/home.php');
            }    
        }           
   ?>
    

    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <div class="logo">
                                <a class="nav-brand " href="<?php echo INCLUDE_PATH; ?>">DANSOL</a>
                                <!-- <a class="log" href="<?php echo INCLUDE_PATH; ?>">cursos online</a> -->
                            </div>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
                                <li><a href="<?php echo INCLUDE_PATH;?>loja">Loja</a></li>
                                <li><a href="<?php echo INCLUDE_PATH;?>quem-somos">Quem somos</a></li>
                                <li><a href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area mb-30">
                        <ul class="footer_widget_menu">
                        <?php
                          $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ");
                          $categoria->execute();
                          $categoria = $categoria->fetchAll();  
                            foreach($categoria as $key => $value){
                                ?>
                            <li><a href="<?php echo INCLUDE_PATH; ?>loja/<?php echo $value['slug']; ?>"> <?php echo $value['nome']; ?></a></li>
                             <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Receba nossas novidades</h6>
                        </div>
                    
                        <div class="subscribtion_form">
                            <form class="ajax-form" method="post">
                                <input type="email" name="email" class="mail" placeholder="Seu e-mail..." required>
                                <input type="hidden" name="identificador" value="form_home" />
                                <button type="submit" name="acao" class=""><i style="color:black;" class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="https://www.facebook.com/sitedansite" target="_blank" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>

                            <a href="https://www.instagram.com/sitedan" target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>

                            <a href="https://api.whatsapp.com/send?phone=5511994576376&text=Ol%C3%A1%2C%20venho%20atrav%C3%A9s%20do%20site%20de%20cursos." target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram">
                             <i href="#" target="_blank" data-toggle="tooltip" data-placement="top" title="Whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a> 
                           
                            <a href="https://www.youtube.com/channel/UCSMwzDBt239V0ddFbWByxfQ" target="_blank" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

<div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p>
                      
    Copyright &copy;<script>document.write(new Date().getFullYear());</script>Todos os direitos reservados | Desenvolvido por <a class="copy" href="https://sitedan.com.br" target="_blank"> SiteDan</a>
  
                    </p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="<?php echo INCLUDE_PATH;?>js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo INCLUDE_PATH;?>js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo INCLUDE_PATH;?>js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo INCLUDE_PATH;?>js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="<?php echo INCLUDE_PATH;?>js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="<?php echo INCLUDE_PATH;?>js/active.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/scroll.js"></script>


    <?php
        if(is_array($url) && strstr($url[0],'loja') !== false){
        ?>
            <script>
                $(function(){
                    $('select').change(function(){
                        location.href=include_path+"loja/"+$(this).val();
                    })
                })
            </script>

        <?php
            }
        ?>

        
    <?php
        if($url == 'contato'){
    ?>
    <?php }?>
    <!--<script src="<?php echo INCLUDE_PATH; ?>js/exemplo.js"></script>--> <!--script para carregar especialidades uma a uma-->
    <script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>

</body>

</html>