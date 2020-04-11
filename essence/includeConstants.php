<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$autoload = function($class){
    if($class == 'Email'){
      include_once('classes/phpmailer/PHPMailerAutoload.php');  
    }
    include('classes/'.$class.'.php');
    
};

spl_autoload_register($autoload);

//Localhost 
    define('INCLUDE_PATH','http://localhost/gestao_clientes/');
    define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');

    define('BASE_DIR_PAINEL',__DIR__.'../painel');
    define('HOST','localhost');
    define('USER','root');
    define('PASSWORD','');
    define('DATABASE','Projeto_01');
    define ('NOME_EMPRESA','Dansol');


    ?>