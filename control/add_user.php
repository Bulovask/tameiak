<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

function add_user($nome, $cpf, $funcao, $senha) {
    $usuario = new Usuario(NULL, $nome, $cpf, $funcao, $senha);
    $tentativa = UsuarioDAO::salvar_usuario($usuario);
    if($tentativa["status"]) {
        sendMsg("sucess", "Sucesso: Usuário salvo!");
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", "Erro: Verifique se já não existe alguem com o mesmo CPF!");
    }
    header("Location: /tameiak/add_user.php");
    exit();
}

$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];
$senha = $_POST["senha"];

add_user($nome, $cpf, $funcao, $senha);