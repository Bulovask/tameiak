<?php
session_start();

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
            "user-type" => $user["type"],
            "user-id" => $user["id"],
            "user-password" => $user["password"]
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