<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/BDPDO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

class UsuarioDAO {
    public static function pegar_usuario($usuario_id, $usuario_senha) {
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
            return ["status"=>TRUE, "msg"=>"Usuário salvo com sucesso!</br>"];
        } catch (Exception $e) {
            return ["status"=>FALSE, "msg"=>"Erro ao salvar o usuário no banco de dados!</br>".$e->getMessage()."</br>"];
        }
    }
}