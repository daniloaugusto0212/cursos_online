<?php
include('../config.php');
define('MAIL_SENDER', 'noreply@dansol.com.br');
$selectMail = Painel::select("pass_mail", "mail = ?", array(MAIL_SENDER));
define('PASSWORD_MAIL', $selectMail['password']);
define('SERVER_MAIL', 'smtp.hostinger.com.br');
$language = $_POST['language'] == 'pt-BR';
$data = [];
$assunto = 'Nova mensagem do site Loja.';
$corpo = '';
foreach ($_POST as $key => $value) {
    if ($value == 'Enviar' || $value == 'pt-BR') {
        continue;
    }
    $corpo .= ucfirst($key) . ": " . $value;
    $corpo .= "<hr><br>";
}
$info = array(
    'assunto' => $assunto,
    'corpo' => $corpo
);
$mail = new Email(SERVER_MAIL, MAIL_SENDER, PASSWORD_MAIL, 'Loja');
$mail->addAdress('contato@dansol.com.br', 'Danilo');
$mail->formatarEmail($info);
if ($language) {
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
} else {
    ?>
    <script language="javascript" type="text/javascript">
        alert('Erro! Devido a grande quantidade de SPAN, está bloqueado o envio de formulário de fora do Brasil. Para entrar em contato, use o botão de WhatsApp.');
        window.location = '../&envio=erro';
    </script>
    <?php
}
