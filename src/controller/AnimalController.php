<?php
require_once(__DIR__ . '/../../config/Conexao.php');
require_once(__DIR__ . '/EspecieController.php');
require_once(__DIR__ . '/TutorController.php');

class AnimalController{

    private $pdo;
    private $especieController;
    private $tutorController;

    public function __construct(TutorController $tutorController, EspecieController $especieController){
        $this->pdo = Conexao::conectar();
        $this->especieController = $especieController;
        $this->tutorController = $tutorController;
    }

    public function cadastrarAnimal($nomeAnimal, $dataAnimal, $sexo, $observacao, $codigoEspecie, $nomeTutor, $cpf, $telefoneTutor, $endereco) {
    try {
        $codigoTutor = $this->tutorController->findOrCreateAndGetId($nomeTutor, $telefoneTutor, $cpf, $endereco);

        if ($codigoEspecie == 0 || $codigoTutor == 0) {
            error_log('Falha ao obter ID de espécie ou tutor para cadastrar animal.');
            return false;
        }

        $sqlAnimal = 'INSERT INTO animal (nome_animal, data_animal, sexo, observacao, codigo_especie, codigo_tutor) VALUES (?, ?, ?, ?, ?, ?)';
        $stmtAnimal = $this->pdo->prepare($sqlAnimal);
        return $stmtAnimal->execute([$nomeAnimal, $dataAnimal, $sexo, $observacao, $codigoEspecie, $codigoTutor]);
    } catch (PDOException $e) {
        error_log('Erro ao cadastrar animal: ' . $e->getMessage());
        return false;
    }
}


    public function listarAnimais(){
        try {
            $sqlListar = 'SELECT a.codigo_animal, UPPER(a.nome_animal) AS nome_animal, a.data_animal, a.sexo, a.observacao,  e.nome_especie, UPPER (t.nome_tutor) AS nome_tutor 
              FROM animal a 
              JOIN especie e ON a.codigo_especie = e.codigo_especie
              JOIN tutor t ON a.codigo_tutor = t.codigo_tutor
              ORDER BY a.nome_animal ASC';
              
            $stmtListar = $this->pdo->prepare($sqlListar);
            $stmtListar->execute();
            return $stmtListar->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar animais: ' . $e->getMessage());
            return [];
        }
    }

    public function deletarAnimal($codigoAnimal){
        try {
            $sqlDeletar = 'DELETE FROM animal WHERE codigo_animal = ?';
            $stmtDeletar = $this->pdo->prepare($sqlDeletar);
            return $stmtDeletar->execute([$codigoAnimal]); 

        } catch (PDOException $e) {
            error_log('Erro ao deletar animal: ' . $e->getMessage());
            return false;
        }
    }

    public function buscarCD($codigoAnimal){
        try {
            $sqlCd = "SELECT animal.*, tutor.nome_tutor, tutor.cpf, tutor.telefone_tutor, tutor.endereco FROM animal JOIN tutor ON animal.codigo_tutor = tutor.codigo_tutor WHERE animal.codigo_animal = :codigo_animal";
            $stmtCd = $this->pdo->prepare($sqlCd);
            $stmtCd->bindValue(':codigo_animal', $codigoAnimal);
            $stmtCd->execute();
            return $stmtCd->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            error_log('Erro ao bsucar Codigo do animal'. $e->getMessage());
            return false;
        }
    }

    public function editarAnimal($codigoAnimal, $nomeAnimal, $dataAnimal, $sexo, $observacao, $nomeEspecie, $nomeTutor, $cpf, $telefoneTutor, $endereco){
        try {

            $codigoEspecie = $this->especieController->findOrCreateAndGetId($nomeEspecie);
            $codigoTutor = $this->tutorController->findOrCreateAndGetId($nomeTutor, $cpf, $telefoneTutor, $endereco);

            if ($codigoEspecie === 0 || $codigoTutor === 0) {
                error_log('Falha ao obter ID de espécie ou tutor para editar animal.');
                return false;
            }

            $sqlEditar = 'UPDATE animal 
            SET nome_animal = :nome_animal, 
                data_animal = :data_animal, 
                sexo = :sexo, 
                observacao = :observacao,
                codigo_especie = :codigo_especie, 
                codigo_tutor = :codigo_tutor 
            WHERE codigo_animal = :codigo_animal';

            $stmtEditar = $this->pdo->prepare($sqlEditar);

            $stmtEditar->bindValue(':codigo_animal', $codigoAnimal);
            $stmtEditar->bindValue(':nome_animal', $nomeAnimal);
            $stmtEditar->bindValue(':data_animal', $dataAnimal);
            $stmtEditar->bindValue(':sexo', $sexo);
            $stmtEditar->bindValue(':observacao', $observacao);
            $stmtEditar->bindValue(':codigo_especie', $codigoEspecie);
            $stmtEditar->bindValue(':codigo_tutor', $codigoTutor);
            return $stmtEditar->execute();

        } catch (PDOException $e) {
            error_log('Erro ao editar animal: ' . $e->getMessage());
            return false;

        }
    }
}

