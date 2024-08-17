<?php

class Usuario {
    private $id;
    private $nome;
    private $cpf;
    private $funcao;
    private $senha;

    public function __construct($id, $nome, $cpf, $funcao, $senha) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = preg_replace("/\D/", "", $cpf);
        $this->funcao = $funcao;
        $this->senha = $senha;
    }

    public function getID() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCPF() {
        return $this->cpf;
    }

    public function getFuncao() {
        return $this->funcao;
    }

    public function getSenha() {
        return $this->senha;
    }
}