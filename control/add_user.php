<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/token.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

function add_user($nome, $cpf, $funcao, $senha) {
    $usuario = new Usuario(NULL, $nome, $cpf, $funcao, $senha);
    print_r(UsuarioDAO::salvar_usuario($usuario));
}

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];
$senha = $_POST["senha"];

add_user($nome, $cpf, $funcao, $senha);