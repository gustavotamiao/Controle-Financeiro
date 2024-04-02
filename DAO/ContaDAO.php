<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao
{


    public function CadastrarConta($banco, $agencia, $numero, $saldo)
    {

        if (trim($banco) == '' || trim($agencia) == '' || trim($numero) == '' || trim($saldo) == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();

        $comando_sql = 'INSERT INTO tb_conta
                        (banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
                        values
                        (?, ?, ?, ?, ?);';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {

            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
        
    }

    public function ConsultarConta()
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_conta,
                               banco_conta,
                               agencia_conta,
                               saldo_conta,
                               numero_conta
                          from tb_conta
                         where id_usuario = ? order by banco_conta ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharConta($idConta)
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_conta,
                               banco_conta,
                               agencia_conta,
                               saldo_conta,
                               numero_conta
                          from tb_conta
                         where id_conta = ?
                         and   id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    
    }

    public function AlterarConta($idConta, $banco, $numero, $agencia, $saldo)
    {

        if (trim($idConta) == '' || $banco == '' || $agencia == '' || $numero == '' || $saldo == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_conta
                          SET  banco_conta = ?,
                               agencia_conta = ?,
                               numero_conta = ?,
                               saldo_conta = ? 
                         where id_conta = ?
                           and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $numero);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idConta);
        $sql->bindValue(6, UtilDAO::CodigoLogado());
        try {

            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    
    public function ExcluirConta($idConta)
    {

        if($idConta == ''){
            return 0;
        }


        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE 
                          from tb_conta
                         where id_conta = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -4;
        }

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

}
