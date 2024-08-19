<?php
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Tokens {
    public static function init() {
        if(!isset($_SESSION["token_list"])) {
            $_SESSION["token_list"] = [];
        }
    }

    public static function newToken($user) {
        self::init();
        $token = password_hash("token", PASSWORD_DEFAULT);
        $_SESSION["token_list"][$token] = [
            "user-id" => $user->getID(),
            "user-password" => $user->getSenha(),
            "user-function" => $user->getFuncao(),
            "time" => time() + 1860 // expira em 31 minutos
        ];
        return $token;
    }

    public static function listTokens() {
        self::init();
        foreach ($_SESSION["token_list"] as $token => $options) { 
            echo substr("\n" . $token, 0, 15) . "...";

        }
    }
}