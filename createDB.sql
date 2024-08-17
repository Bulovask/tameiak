DROP DATABASE Tameiak;
CREATE DATABASE Tameiak;
USE Tameiak;

CREATE TABLE Categoria (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Produto (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codigoBarra INT NOT NULL UNIQUE,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    preco DECIMAL(12 , 2 ) NOT NULL
);

CREATE TABLE CategoriaProduto (
    idCategoria INT NOT NULL,
    idProduto INT NOT NULL,
    PRIMARY KEY (idCategoria , idProduto),
    FOREIGN KEY (idCategoria) REFERENCES Categoria (id),
    FOREIGN KEY (idProduto) REFERENCES Produto (id)
);

CREATE TABLE Venda (
    id INT PRIMARY KEY AUTO_INCREMENT,
    dataVenda DATETIME NOT NULL DEFAULT NOW(),
    descontos DECIMAL(12,2) NOT NULL,
    valorTotal DECIMAL(12,2) NOT NULL
);

CREATE TABLE Pedido (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quantidade INT NOT NULL,
    preco DECIMAL(12 , 2 ) NOT NULL,
    idProduto INT NOT NULL,
    idVenda INT NOT NULL,
    FOREIGN KEY (idProduto) REFERENCES Produto (id),
    FOREIGN KEY (idVenda) REFERENCES Venda (id)
);

CREATE TABLE FuncaoUsuario (
	id INT PRIMARY KEY AUTO_INCREMENT,
    nome varchar(255) NOT NULL UNIQUE
);

CREATE TABLE Usuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    cpf CHAR(11) UNIQUE,
    idFuncaoUsuario INT NOT NULL,
    hash_senha VARCHAR(255) NOT NULL
);

-- ADICIONAR

INSERT INTO FuncaoUsuario(nome) VALUES ('SEM FUNÇÃO'),
                                       ('ADMINISTRADOR'),
									   ('GERENTE'),
                                       ('OPERADOR DE CAIXA'),
									   ('ESTOQUISTA');

INSERT INTO Usuario(nome, idFuncaoUsuario, hash_senha) VALUE ('admin', (SELECT id FROM FuncaoUsuario WHERE nome = 'ADMINISTRADOR'), "$2y$10$e8hc/iLAy34MCbWC5bYqu.jmTER9IPHNcU2dlIHQCuyOhMpnUfjVC");

-- Forma padrão de adicionar novos usuários
-- INSERT INTO Usuario(nome, cpf,  idFuncaoUsuario, hash_senha) VALUE (:nome, :cpf, :idFuncaoUsuario, :hash_senha);










