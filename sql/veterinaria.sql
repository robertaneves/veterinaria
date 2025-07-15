-- --------------------------------------------------------
-- SCRIPT DE CRIAÇÃO DAS TABELAS
-- --------------------------------------------------------

-- Tabela para armazenar as espécies dos animais
CREATE TABLE `especie` (
  `codigo_especie` INT PRIMARY KEY AUTO_INCREMENT UNIQUE,
  `nome_especie` VARCHAR(50) NOT NULL UNIQUE
);

-- Tabela para armazenar os dados dos tutores (donos dos animais)
CREATE TABLE `tutor` (
  `codigo_tutor` INT PRIMARY KEY AUTO_INCREMENT,
  `nome_tutor` VARCHAR(100) NOT NULL,
  `telefone_tutor` VARCHAR(20),
  `cpf` VARCHAR(14) UNIQUE NOT NULL,
  `endereco` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela para armazenar os tipos de tratamentos disponíveis
CREATE TABLE `tratamento` (
  `codigo_tratamento` INT PRIMARY KEY AUTO_INCREMENT,
  `nome_tratamento` VARCHAR(100) NOT NULL,
  `descricao_tratamento` TEXT
);

-- Tabela principal para armazenar os dados dos animais
CREATE TABLE `animal` (
  `codigo_animal` INT PRIMARY KEY AUTO_INCREMENT,
  `nome_animal` VARCHAR(100) NOT NULL,
  `data_animal` DATE,
  `sexo` ENUM('F','M') NOT NULL,
  `observacao` TEXT,
  `codigo_especie` INT NOT NULL,
  `codigo_tutor` INT NOT NULL,
  CONSTRAINT `fk_animal_especie` FOREIGN KEY (`codigo_especie`) REFERENCES `especie`(`codigo_especie`),
  CONSTRAINT `fk_animal_tutor` FOREIGN KEY (`codigo_tutor`) REFERENCES `tutor`(`codigo_tutor`)
);

-- Tabela para o prontuário, ligando animais a tratamentos
CREATE TABLE `prontuario` (
  `codigo_animal` INT,
  `codigo_tratamento` INT,
  `data_tratamento` DATETIME,
  `descricao_observacao` TEXT,
  `anexo_exame` VARCHAR(255) NULL,
  PRIMARY KEY (`codigo_animal`, `codigo_tratamento`, `data_tratamento`),
  FOREIGN KEY (`codigo_animal`) REFERENCES `animal`(`codigo_animal`),
  FOREIGN KEY (`codigo_tratamento`) REFERENCES `tratamento`(`codigo_tratamento`)
);

-- --------------------------------------------------------
-- ALTERAÇÃO DA ESTRUTURA E INSERÇÃO DE DADOS
-- --------------------------------------------------------

-- Adiciona a coluna 'categoria' na tabela 'especie' para melhor organização
ALTER TABLE `especie` ADD `categoria` VARCHAR(50) NULL DEFAULT 'Outro' AFTER `nome_especie`;

-- Insere os dados iniciais na tabela 'especie' com suas respectivas categorias
INSERT INTO `especie` (`nome_especie`, `categoria`) VALUES
('Vira-lata (SRD)', 'Cachorro'),
('Shih Tzu', 'Cachorro'),
('Yorkshire', 'Cachorro'),
('Poodle', 'Cachorro'),
('Buldogue Francês', 'Cachorro'),
('Golden Retriever', 'Cachorro'),
('Labrador', 'Cachorro'),
('Pinscher', 'Cachorro'),
('Rottweiler', 'Cachorro'),
('Lulu da Pomerânia', 'Cachorro'),
('Siamês', 'Gato'),
('Persa', 'Gato'),
('Maine Coon', 'Gato'),
('Angorá', 'Gato'),
('Sphynx (sem pelo)', 'Gato'),
('Ragdoll', 'Gato'),
('Bengal', 'Gato'),
('Azul Russo', 'Gato'),
('British Shorthair', 'Gato'),
('Gato de Pêlo Curto', 'Gato'),
('Coelho', 'Outro'),
('Hamster', 'Outro'),
('Porquinho-da-índia', 'Outro'),
('Calopsita', 'Outro'),
('Canário', 'Outro'),
('Papagaio', 'Outro'),
('Peixe Beta', 'Outro'),
('Tartaruga Tigre d''água', 'Outro'),
('Jabuti', 'Outro'),
('Furão (Ferret)', 'Outro');

