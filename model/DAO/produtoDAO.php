<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/BDPDO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/produto.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";

class ProdutoDAO {
    public static function pegar_produto_por_id($produto_id) {
        try {
            $sql="SELECT * FROM Produto WHERE id = :produto_id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":produto_id", $produto_id);
            $p_sql->execute();

            $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            if(count($res) > 0) {
                $produto = new Produto(
                    $res[0]["id"],
                    $res[0]["codigoBarra"],
                    $res[0]["nome"],
                    $res[0]["descricao"],
                    $res[0]["preco"],
                    $res[0]["quantidadeEstoque"],
                    $res[0]["dataCadastro"],
                    $res[0]["ativo"],
                    isset($res[0]["categorias"]) ? $res[0]["categorias"] : NULL 
                );
                return $produto;
            } else {
                return ["status"=>FALSE, "msg"=>"Erro: Produto não existe"];
            }
        } catch (Exeption $error) {
            return ["status"=>FALSE, "msg"=>$error];
        }
    }

    public static function salvar_produto($produto) {
        try {
            $sql = "INSERT INTO Produto(codigoBarra, nome, descricao,  preco, quantidadeEstoque) 
                VALUE (:codigoBarra, :nome, :descricao, :preco, :quantidadeEstoque)";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":codigoBarra", $produto->getCodigoBarra());
            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":descricao", $produto->getDescricao() ? $produto->getDescricao() : NULL);
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":quantidadeEstoque", $produto->getQuantidadeEstoque());
            $p_sql->execute();
            //$res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            return ["status"=>TRUE, "msg"=>"Produto salvo com sucesso!"];
        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>"Erro ao salvar o produto no banco de dados! ".$error->getMessage()];
        }
    }

    public static function deletar_produto($produto_id) {
        try {
            $sql = "DELETE FROM Produto WHERE id=:id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $produto_id);
            $p_sql->execute();

            return ["status"=>TRUE, "msg"=>"Produto Apagado!"];

        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>"Erro ao apagar"];
        }
    }

    public static function atualizar_produto($produto) {
        try {
            $sql="UPDATE Produto SET codigoBarra=:codigoBarra, nome=:nome, descricao=:descricao, preco=:preco, quantidadeEstoque=:quantidadeEstoque, ativo=:ativo
                    WHERE id = :produto_id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":produto_id", $produto->getID());
            $p_sql->bindValue(":codigoBarra", $produto->getCodigoBarra());
            $p_sql->bindValue(":nome", $produto->getNome());
            $p_sql->bindValue(":descricao", $produto->getDescricao());
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":quantidadeEstoque", $produto->getQuantidadeEstoque());
            $p_sql->bindValue(":ativo", $produto->getAtivo());
            $p_sql->execute();
            // $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            
            return ["status"=>TRUE, "msg"=>"Sucesso: Produto atualizado"];
        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>$error];
        }
    }

    public static function listar_produtos($filter = []) {
        try {
            $sql = "SELECT id, codigoBarra, nome, descricao, preco, quantidadeEstoque, dataCadastro, ativo
            from Produto
            ORDER BY :ordenar_por :ordem";
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":ordenar_por", isset($filter["ordenar_por"]) ? $filter["ordenar_por"] : "u.id");
            $p_sql->bindValue(":ordem", isset($filter["ordem"]) ? $filter["ordem"] : "ASC");
            $p_sql->execute();

            $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            return ["status"=>TRUE, "msg"=>$res];
        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>"Erro ao obter a lista de produtos! ".$error->getMessage()];
        }
    }
}