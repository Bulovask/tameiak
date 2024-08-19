<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/control/msg.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/tameiak/model/DAO/produtoDAO.php";

function add_product($codigoBarra, $nome, $descricao, $preco, $quantidadeEstoque, $ativo) {
    $produto = new Produto(NULL, $codigoBarra, $nome, $descricao, $preco, $quantidadeEstoque, NULL, $ativo, NULL);
    $tentativa = ProdutoDAO::salvar_produto($produto);
    if($tentativa["status"]) {
        sendMsg("sucess", "Sucesso: Produto salvo!");
    } else {
        // Função criada por mim. Se encontra em msg.php
        sendMsg("error", "Erro: Não foi possível salvar este produto!".$tentativa["msg"]);
    }
    header("Location: /tameiak/add_product.php");
    exit();
}

$codigoBarra = $_POST["codigoBarra"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$quantidadeEstoque = $_POST["quantidadeEstoque"];
$ativo = $_POST["ativo"];


add_product($codigoBarra, $nome, $descricao, $preco, $quantidadeEstoque, $ativo);