<?php
include('../config.php');
$data = [];
$assunto = 'Nova mensagem do site Loja.';
$corpo = '';
foreach ($_POST as $key => $value) {
    $corpo .= ucfirst($key) . ": " . $value;
    $corpo .= "<hr>";
}
$info = array(
    'assunto' => $assunto,
    'corpo' => $corpo
);
$mail = new Email('smtp.hostinger.com.br', 'send@abrircnpjmei.com.br', 'Dan*681015', 'Loja');
$mail->addAdress('magrao.dan@gmail.com', 'Danilo');
$mail->formatarEmail($info);

if ($mail->enviarEmail()) { ?>
    <script language="javascript" type="text/javascript">
        alert('Mensagem enviada com sucesso');
        window.location = '../contato';
    </script>
    <?php
} else { ?>
    <script language="javascript" type="text/javascript">
        alert('Campos incorretos, Formulário não foi enviado.');
        window.location = '../&envio=erro';
    </script>
    <?php
}

