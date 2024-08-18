<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/token.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

function login($id, $password) {
    $usuario = UsuarioDAO::pegar_usuario($id, $password);
    if($usuario instanceof Usuario) {
        Tokens::init();
        setcookie("access_token", Tokens::newToken($usuario), time() + 1830, "/tameiak", "", false, true);
        header("Location: /tameiak/home.php");
        exit();
    } else {
        header("Location: /tameiak/login.php?msg=error");
        exit();
    }
}

$user_id       = $_POST["id"];
$user_password = $_POST["password"];

login($user_id, $user_password);
