<?php

require_once(__DIR__ . '/../../config/Conexao.php');

class EspecieController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::conectar();
    }

    public function cadastrarEspecie($nomeEspecie)
    {
        try {
            $sqlEspecie = 'INSERT INTO especie (nome_especie) VALUES (?)';
            $stmtEspecie = $this->pdo->prepare($sqlEspecie);
            return $stmtEspecie->execute([$nomeEspecie]);
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar espécie: ' . $e->getMessage());
            return false;
        }
    }

    public function findOrCreateAndGetId($nomeEspecie)
    {
        try {
            $sqlEspecie = 'SELECT codigo_especie FROM especie WHERE nome_especie = ?';
            $stmtEspecie = $this->pdo->prepare($sqlEspecie);
            $stmtEspecie->execute([$nomeEspecie]);

            $especie = $stmtEspecie->fetch(PDO::FETCH_ASSOC);
            if ($especie) {
                return $especie['codigo_especie'];
            } else {
                $sqlInsert = 'INSERT INTO especie (nome_especie) VALUES (?)';
                $stmtInsert = $this->pdo->prepare($sqlInsert);
                $stmtInsert->execute([$nomeEspecie]);

                return $this->pdo->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log('Erro em findOrCreateAndGetId ' . $e->getMessage());
            return 0;
        }
    }

    public function listarEspecie()
    {
        try {
            $sqlListarEspecie = 'SELECT codigo_especie, nome_especie, categoria FROM especie ORDER BY categoria, nome_especie ASC';

            $stmtListarEspecie = $this->pdo->prepare($sqlListarEspecie);
            $stmtListarEspecie->execute();
            return $stmtListarEspecie->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo('Erro ao listar espécies.' . $e->getMessage());
            return [];
        }
    }
}
