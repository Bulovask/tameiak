<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/token.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";

function login($id, $password) {
    $usuario = UsuarioDAO::pegar_usuario($id, $password);
    print_r($usuario);
}

$user_id       = $_POST["id"];
$user_password = $_POST["password"];

login($user_id, $user_password);
