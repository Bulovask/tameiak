<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/produtoDAO.php";

function edit_product($id, $codigoBarra, $nome, $descricao, $preco, $quantidadeEstoque, $ativo) {
    $usuario = new Produto($id, $codigoBarra, $nome, $descricao, $preco, $quantidadeEstoque, NULL, $ativo);
    $tentativa = ProdutoDAO::atualizar_produto($usuario);
    if($tentativa["status"]) {
        sendMsg("sucess", $tentativa["msg"]);
        header("Location: /tameiak/list_products.php");
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", "Erro: Não foi possível editar o produto atual.".$tentativa["msg"]);
        header("Location: /tameiak/edit_product.php?id=".$id);
    }
    exit();
}

$id = $_POST["id"];
$codigoBarra = $_POST["codigoBarra"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$quantidadeEstoque = $_POST["quantidadeEstoque"];
$ativo = $_POST["ativo"];

edit_product($id, $codigoBarra, $nome, $descricao, $preco, $quantidadeEstoque, $ativo);