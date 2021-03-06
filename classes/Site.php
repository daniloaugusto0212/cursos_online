<?php

define("DATE_WITH_HOUR_NOW", date("Y-m-d H:i:s"));

class Site
{

    public static function updateUsuarioOnline()
    {
        if (isset($_SESSION['online'])) {
            $token = $_SESSION['online'];
            $check = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.online` WHERE token = ?");
            $check->execute(array($_SESSION['online']));

            if ($check->rowCount() == 1) {
                $sql = MySql::conectar()->prepare("UPDATE `tb_admin.online` SET ultima_acao = ? WHERE token = ?");
                $sql->execute(array(DATE_WITH_HOUR_NOW, $token));
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['online'];
                $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
                $sql->execute(array($ip,DATE_WITH_HOUR_NOW, $token));
            }
        } else {
            $_SESSION['online'] = uniqid();
            $ip = $_SERVER['REMOTE_ADDR'];
            $token = $_SESSION['online'];
            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
            $sql->execute(array($ip,DATE_WITH_HOUR_NOW, $token));
        }
    }

    public static function contador()
    {
        //Se o IP não estiver no banco adiciona para o contador
        $getIp = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE ip = ?");
        $getIp->execute(array($_SERVER['REMOTE_ADDR']));
        if ($getIp->rowCount() == 0) {
            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.visitas` VALUES (null,?,?)");
            $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
        }
    }

    public static function contadorDet()
    {
        //setcookie('visita','true',time() - 1 ); //Limpar cookie manualmente
        if (!isset($_COOKIE['visita'])) {
            setcookie('visita', 'true', time() + (60 * 60 * 24)); //Cookie expira em 1 dia
            $sql = MySql::conectar()->prepare("INSERT INTO `visitas.detalhes` VALUES (null,?,?)");
            $sql->execute(array($_SERVER['REMOTE_ADDR'],date('Y-m-d')));
        }
    }
}
