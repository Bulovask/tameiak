<?php

class produto {
    private $id;
    private $codigoBarra;
    private $nome;
    private $descricao;
    private $preco;
    private $quantidadeEstoque;
    private $dataCadastro;
    private $ativo;
    private $categorias;

    public function __construct($id, $codigoBarra, $nome, $descricao, $preco,
                        $quantidadeEstoque, $dataCadastro, $ativo, $categorias=[]) {
        $this->id = $id;
        $this->codigoBarra = $codigoBarra;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->quantidadeEstoque = $quantidadeEstoque;
        $this->dataCadastro = $dataCadastro;
        $this->ativo = $ativo;
        $this->categorias = $categorias;
    }

    public function getID() {
        return $this->id;
    }

    public function getCodigoBarra() {
        return $this->codigoBarra;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getQuantidadeEstoque() {
        return $this->quantidadeEstoque;
    }

    public function getDataCadastro() {
        return $this->dataCadastro;
    }

    public function getAtivo() {
        return $this->ativo;
    }

    public function getCategorias() {
        return $this->categorias;
    }
}