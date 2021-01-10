
<div class="box-content">
    <h2><i class="fas fa-file-alt"></i> Limpar Visitas</h2>

    <form  method="post" > 
        <?php
        /*Visitas que estão na tabela que armazena os dados dos visitantes*/
        $getVisists = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
        $getVisists->execute();
        $getVisistsWithDatas = $getVisists->rowCount();

        /*Visitas da tabela que só armazena o total de visitas quando a tabelas tb_admin.visitas é limpa*/
        $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `total_visitas`");
        $pegarVisitasTotais->execute();
        if ($pegarVisitasTotais->rowCount() != 0) {
            $pegarVisitasTotais = $pegarVisitasTotais->fetch()['total'];
        } else {
            $pegarVisitasTotais = 0;
        }
        $getVisists = $getVisistsWithDatas + $pegarVisitasTotais;
        ?>

        <div class="box-metricas">
            <div class="box-metrica-single">
                <div class="box-metrica-wraper">
                    <h2>Visitas à Limpar</h2>
                    <p><?php echo $getVisistsWithDatas; ?></p>
                </div><!--box-metrica-wraper-->
            </div><!--box-metrica-single-->
            <div class="box-metrica-single">
                <div class="box-metrica-wraper">
                    <h2>Visitas Armazenadas</h2>
                    <p><?php echo $pegarVisitasTotais; ?></p>
                </div><!--box-metrica-wraper-->
            </div><!--box-metrica-single-->
            <div class="box-metrica-single">
                <div class="box-metrica-wraper">
                    <h2>Total</h2>
                    <p><?php echo $getVisists ; ?></p>
                </div><!--box-metrica-wraper-->
            </div><!--box-metrica-single-->
            <div class="clear"></div>
        </div><!--box-metricas-->

        <?php
        if (isset($_POST['action'])) {
            if ($_POST['action'] == 'Limpar!') {
                //Insere novo total na tabela que só armazena o total
                $insertTotalVisits = MySql::conectar()->prepare("INSERT INTO `total_visitas` VALUES(null, ?, ?)");
                $insertTotalVisits->execute(array(date('Y-m-d'), $getVisists));
                $visitsLastId = MySql::conectar()->lastInsertId();

                //Deleta o registro anterio da tabela que só armazena o total
                $deleteTotalLimpeza = MySql::conectar()->exec("DELETE FROM `total_visitas` WHERE id <> $visitsLastId");

                //Deleta todos os registros da tabela que armazena cada usuário que visita o site
                $deleteAdminVisitas = MySql::conectar()->exec("DELETE FROM `tb_admin.visitas`");

                Painel::alert("sucesso", "Dados foram limpos e o total foi armazenado!");
            } else {
                //Deleta os registro da tabela que só armazena o total
                $deleteTotalLimpeza = MySql::conectar()->exec("DELETE FROM `total_visitas`");

                //Deleta todos os registros da tabela que armazena cada usuário que visita o site
                $deleteAdminVisitas = MySql::conectar()->exec("DELETE FROM `tb_admin.visitas`");

                Painel::alert("sucesso", "Todos os dados das visitas foram Apagados com Sucesso!");
            }
        }
        ?>
               
        <div class="form-group"> 
            <input style="background: #C82333" actionBtn="cleaner" type="submit" name="action" value="Zerar!">      
            <input type="submit" name="action" value="Limpar!">
        </div><!--form-group-->
    </form>
</div><!--box-content-->