<?php
    include('../config.php');
    $data = [];
    $assunto = 'Nova mensagem do site Loja.';
    $corpo = '';
    foreach ($_POST as $key => $value) {
        $corpo.=ucfirst($key).": ".$value;
        $corpo.="<hr>";
    }
    $info = array('assunto'=>$assunto,'corpo'=>$corpo);
    $mail = new Email('smtp.hostinger.com.br','contato@dansol.com.br','681015','Loja');
    $mail->addAdress('magrao.dan@gmail.com','Danilo');             
    $mail->formatarEmail($info);
    if ($mail->enviarEmail()) { 
        $data['sucesso'] = true;
    }else{
        $data['erro'] = true;
    } 

    //$data['retorno'] = 'Sucesso!';
    
    die(json_encode($data));

?>