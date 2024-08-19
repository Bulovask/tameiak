<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/produtoDAO.php";

function delete_product($id) {
    $tentativa = ProdutoDAO::deletar_produto($id);
    if($tentativa["status"]) {
        sendMsg("sucess", $tentativa["msg"]);
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", $tentativa["msg"]);
    }
    header("Location: /tameiak/list_products.php");
    exit();
}

if(isset($_GET["id"])) {
    delete_product($_GET["id"]);
}