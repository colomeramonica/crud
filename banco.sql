create database hamburgueria;
use hamburgueria;

CREATE TABLE cardapio (
    id_item INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(30),
    descricao VARCHAR(100),
    preco FLOAT,
    CONSTRAINT pk_cardapio PRIMARY KEY (id_item)
);

CREATE TABLE pedidos (
    id_pedido INT NOT NULL AUTO_INCREMENT,
    id_item INT,
    forma_pgto VARCHAR(30),
    endereco VARCHAR(300),
    data_pedido DATETIME,
    status VARCHAR(100) DEFAULT 'Pendente',
    CONSTRAINT pk_pedido PRIMARY KEY (id_pedido),
    CONSTRAINT fk_produto_pedido FOREIGN KEY (id_item)
        REFERENCES cardapio (id_item)
);

CREATE TABLE avaliacoes (
    id_avaliacao INT NOT NULL AUTO_INCREMENT,
    descricao VARCHAR(300),
    nota INT(10),	
    id_pedido INT,
    CONSTRAINT pk_avaliacao PRIMARY KEY (id_avaliacao),
    CONSTRAINT fk_avaliacao_pedido FOREIGN KEY (id_pedido)
        REFERENCES pedidos (id_pedido)
);

CREATE TABLE faturamento (
    id_faturamento INT NOT NULL AUTO_INCREMENT,
    data_semana DATE,
    valor FLOAT,
    CONSTRAINT pk_faturamento PRIMARY KEY (id_faturamento)
);