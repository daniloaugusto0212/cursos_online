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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163479982-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-163479982-1');
    </script>
    <meta charset="UTF-8">
    <meta name="description" content="Site de vendas dos cursos oferecido pela hotmart.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Danilo Augusto" >
    <meta name="keywords" content="online milionário, cursos online, online, categorias, saúde, beleza, emagrecimento, dietas, moda, marketing digital, hotmart, cursos hotmart, estudos, tecnologia">  
    <meta property="og:image" content="<?= INCLUDE_PATH; ?>img/bg-img/bg-1.jpg"/>
	<meta property="og:title" content="Cursos Online">		
	<meta property="og:url" content="<?= INCLUDE_PATH; ?>"/>

	<link rel="canonical" href="<?= INCLUDE_PATH; ?>">  
    <title>Dansol - Cursos online</title>
    <!-- Favicon  -->
    <link rel="icon" href="<?= INCLUDE_PATH; ?>img/core-img/favicon.ico">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>css/core-style.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>style.css">
</head>

<body>
    <base base="<?= INCLUDE_PATH; ?>" />
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

    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <div class="logo">
                    <a class="nav-brand " href="<?= INCLUDE_PATH; ?>">DANSOL</a>
                    <a class="log" href="<?= INCLUDE_PATH; ?>"><h1>cursos online</h1></a>
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
                            <li><a title="cursos" href="<?= INCLUDE_PATH; ?>loja">Cursos</a></li>
                            <li><a title="categorias" href="<?= INCLUDE_PATH; ?>loja">Categorias</a>
                                <ul class="dropdown">
                                <?php
                                foreach($categoria as $key => $value){
                                    ?>
                                    <li><a title="<?= $value['nome']; ?>" href="<?= INCLUDE_PATH; ?>loja/<?= $value['slug']; ?>"> <?= $value['nome']; ?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                            <li><a title="quem somos" href="<?php INCLUDE_PATH ?>quem-somos">Quem somos</a></li>
                            <li><a title="contato" href="<?php INCLUDE_PATH ?>contato">Contato</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="sucesso">Cadastro efetuado com sucesso!</div><!--sucesso-->
            <div class="overlay-loading">
                <img src="<?= INCLUDE_PATH ?>img/ajax-loader.gif" />
            </div> <!--overlay-loading--> 
        </div> 
    </header>
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
    
    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <div class="logo">
                                <a class="nav-brand " href="<?= INCLUDE_PATH; ?>">DANSOL</a>
                                <!-- <a class="log" href="<?= INCLUDE_PATH; ?>">cursos online</a> -->
                            </div>
                        </div>
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>                                
                                <li><a href="<?= INCLUDE_PATH;?>quem-somos">Quem somos</a></li>
                                <li><a href="<?= INCLUDE_PATH;?>contato">Contato</a></li>
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
                            <li><a href="<?= INCLUDE_PATH; ?>loja/<?= $value['slug']; ?>"> <?= $value['nome']; ?></a></li>
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
                    <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>Todos os direitos reservados | Desenvolvido por <a class="copy" href="https://sitedan.com.br" target="_blank"> SiteDan</a></p>
                </div>
            </div>

        </div>
    </footer>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="<?= INCLUDE_PATH;?>js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="<?= INCLUDE_PATH;?>js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?= INCLUDE_PATH;?>js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="<?= INCLUDE_PATH;?>js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="<?= INCLUDE_PATH;?>js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="<?= INCLUDE_PATH;?>js/active.js"></script>
    <script src="<?= INCLUDE_PATH; ?>js/constants.js"></script>
    <script src="<?= INCLUDE_PATH; ?>js/scroll.js"></script>


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
    <script src="<?= INCLUDE_PATH; ?>js/formularios.js"></script>

</body>

</html>