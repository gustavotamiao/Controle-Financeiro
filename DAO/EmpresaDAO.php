<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class EmpresaDAO extends Conexao
{


    public function CadastrarEmpresa($nome, $tel, $endereco)
    {

        if (trim($nome) == '') {
            return 0;
        }


        $conexao = parent::retornaConexao();

        $comando_sql = 'INSERT INTO tb_empresa
                       (nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
                       values
                       (?, ?, ?, ?);';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $tel);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {

            $sql->execute();
            return 1;

        } catch (Exception $ex) {

            echo $ex->getMessage();
            return -1;
            
        }

    }

    public function ConsultarEmpresa()
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_empresa,
                               nome_empresa,
                               telefone_empresa,
                               endereco_empresa
                          from tb_empresa
                         where id_usuario = ? order by nome_empresa ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharEmpresa($idEmpresa)
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_empresa,
                               nome_empresa,
                               telefone_empresa,
                               endereco_empresa
                          from tb_empresa
                         where id_empresa = ?
                         and   id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    
    }

    public function AlterarEmpresa($idEmpresa, $nomeempresa, $telefoneempresa, $enderecoempresa)
    {

        if (trim($nomeempresa) == '' || $idEmpresa == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_empresa
                          SET  nome_empresa = ?,
                               telefone_empresa = ?,
                               endereco_empresa = ? 
                         where id_empresa = ?
                           and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nomeempresa);
        $sql->bindValue(2, $telefoneempresa);
        $sql->bindValue(3, $enderecoempresa);
        $sql->bindValue(4, $idEmpresa);
        $sql->bindValue(5, UtilDAO::CodigoLogado());
        try {

            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
    
    public function ExcluirEmpresa($idEmpresa)
    {

        if($idEmpresa == ''){
            return 0;
        }


        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE 
                          from tb_empresa 
                         where id_empresa = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
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