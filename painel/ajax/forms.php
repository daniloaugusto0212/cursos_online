<?php
      
    include('../../includeConstants.php'); 

    $data['sucesso'] = true;
    $data['mensagem'] = "";

    if (Painel::logado() == false) {
        die("Você não está logado!");
    }

    /*Nosso código começa aqui */
    if (isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'cadastrar_cliente') {
      
        sleep(2); 
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo_cliente'];
        $cpf = '';
        $cnpj = '';

        if ($tipo == 'fisico') {
            $cpf = $_POST['cpf'];
        }else if ($tipo == 'juridico') {
            $cnpj = $_POST['cnpj'];
        }
        $imagem = "";
        if ($nome == "" || $email == "" || $tipo == "" ) {
            $data['sucesso'] = false;
            $data['mensagem'] = "Atenção, campos vazios não são permitidos.";
        }

        if (isset($_FILES['imagem'])) {
            if (Painel::imagemValida($_FILES['imagem'])) {        
                $imagem = $_FILES['imagem'];
            }else{
                $imagem = "";
                $data['sucesso'] = false;
                $data['mensagem'] = "Sua imagem é inválida!";
            }
        }

        if ($data['sucesso']) {
            if(is_array($imagem))
                $imagem = Painel::uploadFile($imagem);
                $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.clientes` VALUES(null,?,?,?,?,?)");
                $dadoFinal = ($cpf == '') ? $cnpj : $cpf;
                $sql->execute(array($nome,$email,$tipo,$dadoFinal,$imagem));
                //Tudo ok, só cadastrar
                $data['mensagem'] = 'O cliente fo cadastrad com sucesso!';
        }

    }else if (isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'atualizar_cliente') {
        sleep(2);
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo_cliente'];
        $imagem = $_POST['imagem_original'];
        $cpf = '';
        $cnpj = '';

        if ($tipo == 'fisico') {
            $cpf = $_POST['cpf'];
        }else if ($tipo == 'juridico') {
            $cnpj = $_POST['cnpj'];
        }
        if ($nome == '' || $email == '') {
            $data['sucesso'] = false;
            $data['mensagem'] = "Campos vazios não são permitidos.";
        }
        if (isset($_FILES['imagem'])) {
            if (Painel::imagemValida($_FILES['imagem'])) {   
                @unlik('../uploads/'.$imagem);     
                $imagem = $_FILES['imagem'];
            }else{
                $data['sucesso'] = false;
                $data['mensagem'] = "Sua imagem é inválida!";
            }
        }

        if ($data['sucesso']) {
            if (is_array($imagem)) {
                $imagem = Painel::uploadFile($imagem); 
            }

            $sql = MySql::conectar()->prepare("UPDATE `tb_admin.clientes` SET nome = ?, email = ?, tipo = ?, cpf_cnpj = ?, imagem = ? WHERE id = $id");
            $dadoFinal = ($cpf == '') ? $cnpj : $cpf;
            $sql->execute(array($nome,$email,$tipo,$dadoFinal,$imagem));
            $data['mensagem'] = "O cliente foi atualizado com sucesso!";
        }
        
    }else if (isset($_POST['tipo_acao']) && $_POST['tipo_acao'] == 'delete_cliente') {
        $id = $_POST['id'];

        $sql = MySql::conectar()->prepare("SELECT imagem FROM `tb_admin.clientes` WHERE id = $id");
        $sql->execute();
        $imagem = $sql->fetch()['imagem'];
        @unlink('../uploads/'.$imagem);
        MySql::conectar()->exec("DELETE FROM `tb_admin.clientes` WHERE id = $id");

    }    


    die(json_encode($data));

?>