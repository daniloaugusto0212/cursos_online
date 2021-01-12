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

$url1 = explode('/', @$_GET['url']);

if (isset($url1[2])) {
    $getKeywords = MySql::conectar()->prepare("SELECT keywords FROM produtos WHERE slug = ?");
    $getKeywords->execute(array($url1[2]));
    $keywordsBd = $getKeywords->fetch()[0];
} else {
    $keywordsBd = '';
}

$keywrodsJoker =
    ' apostilas, cursos online, online, categorias de cursos, marketing digital, 
    hotmart, cursos hotmart, estudos, como ganhar dinheiro na internet,
    portal de cursos, dansol cursos, nômade digital, Ganhe dinheiro em casa,
    Temos várias modalidades de cursos e apostilas, ';

$keywordsBd = empty($keywordsBd) ?
                ' saúde, beleza, emagrecimento, dietas, moda, tecnologia, melhor curso de PHP, 
                Ganhe dinheiro em casa com receitas faceis, ' :
                $keywordsBd;

if (isset($url1[1])) {
    $url = $url1[1];
} elseif (isset($url1[0])) {
    $url = $url1[0];
} else {
    $url = '';
}

if ($url == '') {
    $title = 'Cursos Online';
    $description = 'Página Inicial';
} else {
    $title = $url;
    $description = 'Página ' . $url;
}

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
    <base href="<?= INCLUDE_PATH ?>" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Danilo Augusto - SiteDan" >
    <meta name="keywords" content="<?= $keywordsBd .= $keywrodsJoker ?>">
    <meta name="description" content="<?= $description ?> - Site de vendas dos cursos oferecido pela hotmart. 
    . ">
    <meta property="og:title" content="DanSol Cursos Online">
    <meta name="robots" content="index" />
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link rel="canonical" href="<?= $url ?>" />     
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= INCLUDE_PATH ?><?= $url ?>"/>
    <meta property="og:site_name" content="Dansol - Cursos online | Estude da sua casa!" />
    <meta property="article:modified_time" content="2021-01-03T00:04:51+00:00" />
    <meta property="og:image" content="<?= INCLUDE_PATH; ?>img/bg-img/bg-1.jpg"/>
    <meta name="twitter:card" content="summary" />   
    <meta name="twitter: description" 
    content = "DanSol - Cursos Online e Apostilas para você estudar de onde quiser. Comece já. O que está esperando?"> 
    <meta name="twitter: title" content = "Site de redirecionamento para cursos online.">
    <meta name="twitter: image" content = "<?= INCLUDE_PATH ?>img/bg-img/bg-1.jpg"> 
    <meta name="twitter: site" content = "@danilodansol">

    <title><?= ucFirst($title) ?> | Dansol - Cursos online</title>
    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="estilo/style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    
    
        <?php
        $url = isset($_GET['url']) ? $_GET['url'] : 'home';
        switch ($url) {
            case 'quem-somos':
                echo '<target target="quem-somos" />';
                break;

            case 'contato':
                echo '<target target="contato" />';
                break;
        }

        ?>
    <header class="header_area">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="">
                <img class="logo" src="<?= INCLUDE_PATH; ?>img/logo.png" 
                alt="Logo DanSol Cursos Online"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= menuSelected('') ?>">
                        <a class="nav-link" title="cursos" href="">
                        Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?= menuSelected('cursos') ?>">
                        <a class="nav-link" title="cursos" href="cursos">
                        Cursos <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href=""
                        title="categorias" id="navbarDropdown" role="button" data-toggle="dropdown" 
                        aria-haspopup="true" aria-expanded="false">Categorias</a>
                        
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        foreach ($categoria as $key => $value) {
                            ?>
                            <a class="dropdown-item" title="<?= $value['nome']; ?>" 
                            href="cursos/<?= $value['slug']; ?>">
                            <?= $value['nome']; ?></a>
                        <?php } ?>
                    </li>
                    <li class="nav-item <?= menuSelected('quem-somos') ?>">
                        <a class="nav-link" realtime="quem-somos" title="quem somos" 
                        href="<?php INCLUDE_PATH ?>quem-somos">Quem somos</a>
                    </li>
                    <li class="nav-item <?= menuSelected('contato') ?>">
                        <a class="nav-link" realtime="contato" title="contato" 
                        href="<?php INCLUDE_PATH ?>contato">Contato</a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


   
    <?php
    if (file_exists('pages/' . $url . '.php')) {
        include('pages/' . $url . '.php');
    } else {
        if ($url != 'quem-somos' && $url != 'contato') {
            //Podemos fazer o que quiser, pois a página não existe
            $urlPar = explode('/', $url)[0];
            if ($urlPar != 'cursos') {
                $pagina404 = true;
                include('pages/404.php');
            } else {
                include('pages/cursos.php');
            }
        } else {                
            include('pages/home.php');
        }
    }
    ?>
    
    <footer class="footer_area clearfix">
        <div class="cont">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-6">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo -->
                        <div class="footer-logo mr-50">
                            <a class="navbar-brand" href="">
                            <img class="logo" src="<?= INCLUDE_PATH; ?>img/logoWhite.png" 
                            alt="Logo DanSol Cursos Online"></a>
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
                        <ul class="footer_widget_menu text-center">
                        <?php
                        $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ");
                        $categoria->execute();
                        $categoria = $categoria->fetchAll();
                        foreach ($categoria as $key => $value) {
                            ?>
                            <li><a href="cursos/<?= $value['slug']; ?>"> <?= $value['nome']; ?></a></li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-4">
                    <div class="single_widget_area">
                        <div class="footer_heading mb-30">
                            <h6>Receba nossas novidades</h6>
                        </div>
                    
                        <div class="subscribtion_form">
                            <form action="<?= INCLUDE_PATH ?>enviar/formularios.php" method="post">
                                <input type="email" name="email" class="mail" placeholder="Seu e-mail..." required>
                                <input type="hidden" name="identificador" value="form_home" />
                                <button type="submit" name="acao" class=""><i style="color:black;"
                                class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hotmart">
                        <p class="copy">Curso Garantidos</p>
                        <img src="<?= INCLUDE_PATH ?>img/hotmart-logo.png" alt="">
                    </div>
                </div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-4">
                    <div class="single_widget_area">
                        <div class="footer_social_area">
                            <a href="https://www.facebook.com/sitedansite" target="_blank"
                            data-toggle="tooltip" data-placement="top" title="Facebook">
                            <i class="fa fa-facebook" aria-hidden="true"></i></a>

                            <a href="https://www.instagram.com/sitedan" target="_blank" 
                            data-toggle="tooltip" data-placement="top" title="Instagram">
                            <i class="fa fa-instagram" aria-hidden="true"></i></a>

                            <a href="https://api.whatsapp.com/send?phone=5511994576376&text=Ol%C3%A1%2C%20venho%20atrav%C3%A9s%20do%20site%20de%20cursos." 
                            target="_blank" data-toggle="tooltip" data-placement="top" title="Instagram">
                            <i href="#" target="_blank" data-toggle="tooltip" data-placement="top"
                            title="Whatsapp">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i></a> 
                           
                            <a href="https://www.youtube.com/channel/UCSMwzDBt239V0ddFbWByxfQ" target="_blank" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>

                            x
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 text-center">
                    <p class="copy">Copyright &copy;<script>document.write(new Date().getFullYear());</script>
                    Todos os direitos reservados | Desenvolvido por <a class="copy" 
                    href="https://sitedan.com.br" target="_blank"> SiteDan</a></p>
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
    <script src="<?= INCLUDE_PATH; ?>js/action.js"></script>


    <?php
    if (is_array($url) && strstr($url[0],'cursos') !== false) {
        ?>
        <script>
            $(function(){
                $('select').change(function(){
                    location.href=include_path+"cursos/"+$(this).val();
                })
            })
        </script>

        <?php
    }
    ?>
        
    <?php
    if ($url == 'contato') {
        ?>
    <?php }?>
    <script src="<?= INCLUDE_PATH; ?>js/formularios.js"></script>

</body>

</html>