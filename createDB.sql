DROP DATABASE ssm_bk;
CREATE DATABASE ssm_bk;
USE ssm_bk;

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
    idFuncaoUsuario INT NOT NULL
);

INSERT INTO `ssm_bk`.`categoria` (`id`, `nome`) VALUES (1, 'gato');





