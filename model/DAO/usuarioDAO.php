<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/BDPDO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";

class UsuarioDAO {
    public static function conectar_usuario($usuario_id, $usuario_senha) {
        try {
            if (str_starts_with($usuario_id, "#")) {
                $label_id = "id";
                $usuario_id = preg_replace("/\D/", "", $usuario_id);
                $usuario_id = intval($usuario_id);
            } else {
                $label_id = "cpf";
                $usuario_id = preg_replace("/\D/", "", $usuario_id);
            }
            
            $sql = "SELECT * FROM Usuario WHERE $label_id = :usuario_id";
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":usuario_id", $usuario_id);
            $p_sql->execute();

            $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            
            if(count($res) > 0 and password_verify($usuario_senha, $res[0]["hash_senha"])) {
                $usuario = new Usuario(
                    $res[0]["id"],
                    $res[0]["nome"],
                    $res[0]["cpf"],
                    $res[0]["idFuncaoUsuario"],
                    NULL
                );
                return $usuario;
            }
            else {
                return ["status"=>FALSE, "msg" => "Senha ou indentificação invalida!</br>"];
            }

        } catch (Exception $e) {
            return ["status"=>FALSE, "msg" => "Erro ao obter usuário!</br>" . $e->getMessage() . "</br>"];
        }
    }

    public static function pegar_usuario_por_id($usuario_id) {
        try {
            $sql="SELECT * FROM Usuario WHERE id = :usuario_id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":usuario_id", $usuario_id);
            $p_sql->execute();

            $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            if(count($res) > 0) {
                $usuario = new Usuario(
                    $res[0]["id"],
                    $res[0]["nome"],
                    $res[0]["cpf"],
                    $res[0]["idFuncaoUsuario"],
                    NULL
                );
                return $usuario;
            } else {
                return ["status"=>FALSE, "msg"=>"Erro: Usuário não existe"];
            }
        } catch (Exeption $error) {
            return ["status"=>FALSE, "msg"=>$error];
        }
    }

    public static function salvar_usuario($usuario) {
        try {
            $sql = "INSERT INTO Usuario(nome, cpf,  idFuncaoUsuario, hash_senha) VALUE (:nome, :cpf, :idFuncaoUsuario, :hash_senha)";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":cpf", $usuario->getCPF() ? $usuario->getCPF() : NULL);
            $p_sql->bindValue(":idFuncaoUsuario", $usuario->getFuncao());
            $p_sql->bindValue(":hash_senha", password_hash($usuario->getSenha(), PASSWORD_DEFAULT));
            $p_sql->execute();
            //$res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            return ["status"=>TRUE, "msg"=>"Usuário salvo com sucesso!"];
        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>"Erro ao salvar o usuário no banco de dados! ".$error->getMessage()];
        }
    }

    public static function deletar_usuario($usuario_id) {
        try {
            if($usuario_id == 1) {
                return ["status"=>FALSE, "msg"=>"Não é possível apagar este usuário"]; 
            }
            $sql = "DELETE FROM Usuario WHERE id=:id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $usuario_id);
            $p_sql->execute();

            return ["status"=>TRUE, "msg"=>"Usuário Apagado!"];

        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>"Erro ao apagar"];
        }
    }

    public static function atualizar_usuario($usuario) {
        try {
            $sql="UPDATE Usuario SET nome=:nome, cpf=:cpf, idFuncaoUsuario=:idFuncao WHERE id = :usuario_id";
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":usuario_id", $usuario->getID());
            $p_sql->bindValue(":nome", $usuario->getNome());
            $p_sql->bindValue(":cpf", $usuario->getCPF());
            if($usuario->getID() == 1 && $usuario->getFuncao() != 2) {
                $p_sql->bindValue(":idFuncao", 2);
                sendMsg("alert", "Não é possível alterar a função deste usuário!");
            } else {
                $p_sql->bindValue(":idFuncao", $usuario->getFuncao());
            }
            $p_sql->execute();
            // $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            
            return ["status"=>TRUE, "msg"=>"Sucesso: Usuário atualizado"];
        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>$error];
        }
    }

    public static function listar_usuarios($filter = []) {
        try {
            $sql = "SELECT u.id as id, u.cpf as cpf, u.nome as nome, f.nome as funcao
            from Usuario as u join FuncaoUsuario as f on f.id=u.idFuncaoUsuario
            where (u.id = :id or :id IS NULL) AND
                  (u.cpf LIKE :cpf or u.cpf IS NULL)  AND
                  u.nome LIKE :nome AND
                  (u.idFuncaoUsuario = :funcao or :funcao IS NULL) ORDER BY :ordenar_por :ordem";
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", isset($filter["id"]) ? $filter["id"] : NULL);
            $p_sql->bindValue(":cpf", isset($filter["cpf"]) ? "%".$filter["cpf"]."%" : "%");
            $p_sql->bindValue(":nome", isset($filter["nome"]) ? "%".$filter["nome"]."%" : "%");
            $p_sql->bindValue(":funcao", isset($filter["funcao"]) ? $filter["funcao"] : NULL);
            $p_sql->bindValue(":ordenar_por", isset($filter["ordenar_por"]) ? $filter["ordenar_por"] : "u.id");
            $p_sql->bindValue(":ordem", isset($filter["ordem"]) ? $filter["ordem"] : "ASC");
            $p_sql->execute();

            $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            return ["status"=>TRUE, "msg"=>$res];
        } catch (Exception $error) {
            return ["status"=>FALSE, "msg"=>"Erro ao obter a lista de usuários! ".$error->getMessage()];
        }
    }
}