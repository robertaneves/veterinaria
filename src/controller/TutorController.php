<?php

require_once(__DIR__ . '/../../config/Conexao.php');


class TutorController
{
    private $pdo;
    public function __construct(){
        $this->pdo = Conexao::conectar();
    }
    public function cadastrarTutor($nomeTutor, $telefoneTutor, $cpf, $endereco){
        try {
            $sqlTutor = 'INSERT INTO tutor (nome_tutor, telefone_tutor, cpf, endereco) VALUES (?, ?, ?, ?)';
            $stmtTutor = $this->pdo->prepare($sqlTutor);
            return $stmtTutor->execute([$nomeTutor, $telefoneTutor, $cpf, $endereco]);
        } catch (PDOException $e) {
            error_log('Erro ao cadastrar tutor: ' . $e->getMessage());
        }
    }

    public function findOrCreateAndGetId($nomeTutor, $telefoneTutor, $cpf, $endereco){

        try {
            $sqlSelect = 'SELECT codigo_tutor FROM tutor WHERE cpf = ?';
            $stmtSelect = $this->pdo->prepare($sqlSelect);
            $stmtSelect->execute([$cpf]);

            $tutor = $stmtSelect->fetch(PDO::FETCH_ASSOC);

            if ($tutor) {
                return $tutor['codigo_tutor'];
            } else {
                $sqlInsert = 'INSERT INTO tutor (nome_tutor, cpf, telefone_tutor, endereco) VALUES (?, ?, ?, ?)';
                $stmtInsert = $this->pdo->prepare($sqlInsert);
                $stmtInsert->execute([$nomeTutor, $cpf, $telefoneTutor, $endereco]);

                return $this->pdo->lastInsertId();
            }
        } catch (PDOException $e) {
            error_log('Erro em findOrCreateAndGetId ' . $e->getMessage());
            return 0;
        }
    }
}
