<?php
require_once 'C:\xampp\htdocs\PraticasEad\ControleFinanceiro\DAO\UtilDAO.php';
UtilDAO::VerificarLogado();
require_once 'C:\xampp\htdocs\PraticasEad\ControleFinanceiro\DAO\CategoriaDAO.php';

if (isset($_POST['btnGravar'])) {
    $nome = $_POST['nome'];

    $objdao = new CategoriaDAO();

    $ret = $objdao->CadastrarCategoria($nome);
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

                        <?php include_once '_msg.php'; ?>

                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá cadastrar todas as suas categorias </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="nova_categoria.php">
                    <div class="form-group">
                        <label>Nome da categoria</label>
                        <input class="form-control" name="nome" placeholder="Digite o nome da categoria. Exemplo: Conta de luz" id="nomecategoria" maxlength="35" />
                    </div>
                    <button type="submit" name="btnGravar" onclick="return ValidarCategoria()" class="btn btn-success">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>


</body>

</html>