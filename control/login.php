<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/token.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

function login($id, $password) {
    $usuario = UsuarioDAO::conectar_usuario($id, $password);
    if($usuario instanceof Usuario) {
        Tokens::init();
        setcookie("access_token", Tokens::newToken($usuario), time() + 1830, "/tameiak", "", false, true);
        header("Location: /tameiak/home.php");
        exit();
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", "Erro: Suas credenciais estão incorretas!");
        header("Location: /tameiak/login.php");
        exit();
    }
}

$user_id       = $_POST["id"];
$user_password = $_POST["password"];

login($user_id, $user_password);
