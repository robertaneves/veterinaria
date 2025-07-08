<?php
require_once(__DIR__ . '/../../config/Conexao.php');


class AnimalController{

    private $pdo;
    public function __construct(){
        $this->pdo = Conexao::conectar();
    }

    /**
     * Busca o ID de uma espécie pelo nome. se não existir, cria uma nova
     * @param string $nomeEspecie
     * @return int 0 ID da especie.
     */

    private function getEspecieID($nomeEspecie){
        // Tenta encontrar a espécie pelo nome
        $stmt = $this->pdo->prepare('SELECT codigo_especie FROM especie WHERE nome_especie = ?');
        $stmt->execute([$nomeEspecie]);
        $especie = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($especie) {
            return $especie['codigo_especie'];
        } else {
            $stmt = $this->pdo->prepare('INSERT INTO especie (nome_especie) VALUES (?)');
            $stmt->execute([$nomeEspecie]);
            return $this->pdo->lastInsertId();
        }
    }

    public function cadastrarAnimal($nomeAnimal, $dataNascimento, $sexo, $observacao, $codigoEspecie, $codigoTutor){
        try {
            $sqlAnimal = 'INSERT INTO animal (nome_animal, data_nascimento, sexo, observacao, codigo_especie, codigo_tutor) 
                    VALUES (?, ?, ?, ?, ?, ?)';

            $stmtAnimal = $this->pdo->prepare($sqlAnimal);

            $sucessoAnimal = $stmtAnimal->execute([$nomeAnimal, $dataNascimento, $sexo, $observacao, $codigoEspecie, $codigoTutor]);
            return $sucessoAnimal;
        } catch (PDOException $e) {
            error_log('Erro ao inserir dados: ' . $e->getMessage());
            return false;
        }
    }
}
