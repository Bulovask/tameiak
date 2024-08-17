<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/Tameiak/model/DAO/BDPDO.php";

class funcaoDAO {
    public static function pegar_funcoes() {
        try {
            
            $sql = "SELECT * FROM tameiak.funcaousuario ORDER BY id";
            
            $p_sql = BDPDO::getInstance()->prepare($sql);
            $p_sql->execute();

            $res = $p_sql->fetchAll(PDO::FETCH_ASSOC);
            
            return $res;

        } catch (Exception $e) {
            echo "Erro ao obter funções de usuário!</br>" . $e->getMessage() . "</br>";
            return array();
        }
    }
}