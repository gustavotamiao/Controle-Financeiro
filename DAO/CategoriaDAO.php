<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao
{


    public function CadastrarCategoria($nome)
    {

        if (trim($nome) == '') {
            return 0;
        }
        //1 passo: criar uma variavel que recebera o obj de conexao
        $conexao = parent::retornaConexao();
        //2 passo: criar uma variavel que recebera o twxto do comando SQL que devera ser executado no BD
        $comando_sql = 'INSERT INTO tb_categoria
                        (nome_categoria, id_usuario)
                        values (?, ?);';
        //3 passo: criar um obj que sera cong e levado no BD para ser executado
        $sql = new PDOStatement();
        //4 passo: colocar dentro do obj $sql a conexao preparada para executar o comando_sql
        $sql = $conexao->prepare($comando_sql);
        //5 passo: verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar bindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try {
            //6 passo: executar no BD
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function AlterarCategoria($nome, $idCategoria)
    {

        if (trim($nome) == '' || $idCategoria == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'UPDATE tb_categoria
                          SET  nome_categoria = ?
                         where id_categoria = ?
                           and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $idCategoria);
        $sql->bindValue(3, UtilDAO::CodigoLogado());
        try {

            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ExcluirCategoria($idCategoria)
    {

        if($idCategoria == ''){
            return 0;
        }


        $conexao = parent::retornaConexao();

        $comando_sql = 'DELETE 
                          from tb_categoria 
                         where id_categoria = ?
                           and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
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


    public function ConsultarCategoria()
    {

        $conexao = parent::retornaConexao();

        $comando_sql = 'SELECT id_categoria,
                               nome_categoria
                          from tb_categoria
                         where id_usuario = ? order by nome_categoria ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function DetalharCategoria($idCategoria)
    {

        $conexao = parent::retornaConexao();
        
        $comando_sql = 'select id_categoria,
                               nome_categoria
                          from tb_categoria
                         where id_categoria = ?
                           and id_usuario =?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
}
