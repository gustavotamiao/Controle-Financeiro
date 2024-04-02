<?php
    require_once 'C:\xampp\htdocs\PraticasEad\ControleFinanceiro\DAO\UtilDAO.php';
    UtilDAO::VerificarLogado();
    require_once 'C:\xampp\htdocs\PraticasEad\ControleFinanceiro\DAO\ContaDAO.php';

    if(isset($_POST['btnGravar'])){
        $banco = $_POST['banco'];
        $numero = $_POST['numero'];
        $agencia = $_POST['agencia'];
        $saldo = $_POST['saldo'];

        $objdao = new ContaDAO();

        $ret = $objdao->CadastrarConta($banco, $numero, $agencia, $saldo);
    }

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php include_once '_msg.php' ?>

                        <h2>Nova Conta</h2>
                        <h5>Aqui você poderá cadastrar todas as suas contas </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="nova_conta.php">
                    <div class="form-group">
                        <label>Nome da banco*</label>
                        <input class="form-control" placeholder="Digite o nome do banco..." name="banco" id="banco" maxlength="35"/>
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input class="form-control" placeholder="Digite a agência..." name="agencia" id="agencia" maxlength="15"/>
                    </div>
                    <div class="form-group">
                        <label>Número da conta*</label>
                        <input class="form-control" placeholder="Digite o número da conta..." name="numero" id="numero" maxlength="10"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <input class="form-control" placeholder="Digite o saldo da conta..." name="saldo" id="saldo" maxlength="35"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btnGravar" onclick="return ValidarConta()">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>


</body>

</html>