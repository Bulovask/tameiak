<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

function edit_user($id, $nome, $cpf, $funcao, $senha) {
    $usuario = new Usuario($id, $nome, $cpf, $funcao, $senha);
    $tentativa = UsuarioDAO::atualizar_usuario($usuario);
    if($tentativa["status"]) {
        sendMsg("sucess", $tentativa["msg"]);
        header("Location: /tameiak/list_users.php");
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", "Erro: Não foi possível editar o usuário atual.");
        header("Location: /tameiak/edit_user.php?id=".$id);
    }
    exit();
}

$id = $_POST["id"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$funcao = $_POST["funcao"];
$senha = $_POST["senha"];

edit_user($id, $nome, $cpf, $funcao, $senha);