<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/usuarioDAO.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/vo/usuario.php";

function delete_user($id) {
    $tentativa = UsuarioDAO::deletar_usuario($id);
    if($tentativa["status"]) {
        sendMsg("sucess", $tentativa["msg"]);
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", $tentativa["msg"]);
    }
    header("Location: /tameiak/list_users.php");
    exit();
}

if(isset($_GET["id"])) {
    delete_user($_GET["id"]);
}