
CREATE TABLE especie (
    codigo_especie INT PRIMARY KEY AUTO_INCREMENT,
    nome_especie VARCHAR(50) NOT NULL UNIQUE 
);

CREATE TABLE tutor(
    codigo_tutor INT PRIMARY KEY AUTO_INCREMENT,
    nome_tutor VARCHAR(100) NOT NULL, 
    telefone_tutor VARCHAR(20),
    cpf VARCHAR(14) UNIQUE NOT NULL, 
    endereco TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
);

CREATE TABLE tratamento (
    codigo_tratamento INT PRIMARY KEY AUTO_INCREMENT,
    nome_tratamento VARCHAR(100) NOT NULL, 
    descricao_tratamento TEXT
);


CREATE TABLE animal (
    codigo_animal INT PRIMARY KEY AUTO_INCREMENT,
    nome_animal VARCHAR(100) NOT NULL,
    data_animal DATE,
    sexo ENUM('F','M') NOT NULL,
    observacao TEXT,
    codigo_especie INT NOT NULL,
    codigo_tutor INT NOT NULL, 

    CONSTRAINT fk_animal_especie FOREIGN KEY (codigo_especie) REFERENCES especie(codigo_especie), 
    CONSTRAINT fk_animal_tutor FOREIGN KEY (codigo_tutor) REFERENCES tutor(codigo_tutor) 
);


CREATE TABLE prontuario (
    codigo_animal INT,
    codigo_tratamento INT,
    data_tratamento DATETIME,
    descricao_observacao TEXT,
    anexo_exame VARCHAR(255) NULL,
    PRIMARY KEY (codigo_animal, codigo_tratamento, data_tratamento),
    FOREIGN KEY (codigo_animal) REFERENCES animal(codigo_animal),
    FOREIGN KEY (codigo_tratamento) REFERENCES tratamento(codigo_tratamento)
);