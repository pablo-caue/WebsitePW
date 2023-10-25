CREATE DATABASE IF NOT EXISTS lava_rapido;

USE lava_rapido;

CREATE TABLE IF NOT EXISTS cliente (
    id INT(4) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(16) NOT NULL,
    sobrenome VARCHAR(16) NOT NULL,
    email VARCHAR(32) NOT NULL,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE IF NOT EXISTS veiculo (
    placa VARCHAR(10) PRIMARY KEY NOT NULL,
    tipo VARCHAR(16) NOT NULL,
    cor VARCHAR(16) NOT NULL,
    ano INT NOT NULL,
    modelo VARCHAR(16) NOT NULL
);

CREATE TABLE IF NOT EXISTS produto (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nome VARCHAR(16) NOT NULL,
    marca VARCHAR(16) NOT NULL
);

CREATE TABLE IF NOT EXISTS funcionario (
    cpf VARCHAR(11) PRIMARY KEY NOT NULL,
    nome VARCHAR(32) NOT NULL,
    horario_chegada TIME NOT NULL,
    horario_saida TIME NOT NULL
);

CREATE TABLE IF NOT EXISTS lavagem (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipo_lavagem VARCHAR(16) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS agendamento (
    codigo INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_produto INT,
    cpf_funcionario VARCHAR(11) NOT NULL,
    id_cliente INT(4) NOT NULL,
    placa_carro VARCHAR(10) NOT NULL,
    horario DATETIME NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES produto(id),
    FOREIGN KEY (cpf_funcionario) REFERENCES funcionario(cpf),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id),
    FOREIGN KEY (placa_carro) REFERENCES veiculo(placa)
);

DELIMITER $$

CREATE PROCEDURE IF NOT EXISTS spPegarNomeClientePeloId (IN cliente_id INT(4))
    BEGIN
    SELECT * FROM cliente WHERE id = cliente_id;
    END $$

CREATE PROCEDURE IF NOT EXISTS spIncluiFuncionario (IN cpf VARCHAR(11), IN nome VARCHAR(32), IN horario_chegada TIME, IN horario_saida TIME)
    BEGIN
    INSERT INTO funcionario (cpf, nome, horario_chegada, horario_saida) VALUES (cpf, nome, horario_chegada, horario_saida);
    END $$

CREATE PROCEDURE IF NOT EXISTS spIncluiProduto (IN p_nome VARCHAR(16), IN p_marca VARCHAR(16), OUT id_produto INT)
    BEGIN
    INSERT INTO produto(nome, marca) VALUES (p_nome, p_marca);
    SELECT id from produto WHERE nome = p_nome;
    END $$

CREATE PROCEDURE IF NOT EXISTS spIncluiLavagem (IN l_tipo_lavagem VARCHAR(16), IN l_valor VARCHAR(16), OUT id_lavagem INT)
    BEGIN
    INSERT INTO lavagem(tipo_lavagem, valor) VALUES (l_tipo_lavagem, l_valor);
    SELECT id from lavagem WHERE tipo_lavagem = l_tipo_lavagem;
    END $$

CREATE PROCEDURE IF NOT EXISTS spIncluiCliente (IN c_nome VARCHAR (16) ,IN c_sobrenome VARCHAR (16),IN c_email VARCHAR (32), IN c_cpf VARCHAR(11), IN c_password VARCHAR(32))
    BEGIN
    INSERT INTO cliente(nome, sobrenome, email, cpf, senha) VALUES (c_nome, c_sobrenome, c_email, c_cpf, c_password);
    END $$

CREATE PROCEDURE IF NOT EXISTS spPegarCliente (IN c_email VARCHAR(32), IN c_password VARCHAR(32), OUT id_cliente INT(4))
    BEGIN
    SELECT id FROM cliente WHERE email = c_email AND senha = c_password;
    END $$


DELIMITER ;

CALL spIncluiFuncionario('057.467.248-66', 'Giovane Lidorio Multini', '08:00', '14:00');
CALL spIncluiFuncionario('376. 877.158-02', 'Eduarda Castilho Martins', '08:00', '14:00');
CALL spIncluiFuncionario('004.564.788-76', 'Felipe Miguel Aranha', '08:00', '14:00');
CALL spIncluiFuncionario('507.662.428-03', 'Cauê Daniel Hugo Ramos', '14:00', '22:00');
CALL spIncluiFuncionario('049.044.558-60', 'Paulo Matheus Pereira', '14:00', '22:00');
CALL spIncluiFuncionario('498.868.578-03', 'Sueli Galvão', '14:00', '22:00');

CALL spIncluiProduto('v-mol','Vonixx', @id_produto);
CALL spIncluiProduto('lava carros','Centralsul', @id_produto);
CALL spIncluiProduto('lava auto','Radnaq', @id_produto);

CALL spIncluiLavagem('Lavagem Simples', '30.00', @id_lavagem);
CALL spIncluiLavagem('Lavagem Simples + Cera','40.00', @id_lavagem);
CALL spIncluiLavagem('Lavagem Completa','50.00', @id_lavagem);
CALL spIncluiLavagem('Lavagem + Cera','60.00', @id_lavagem);
CALL spIncluiLavagem('Lavagem + Polimento','75.00', @id_lavagem);

