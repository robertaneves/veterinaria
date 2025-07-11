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

    public function cadastrarAnimal($nomeAnimal, $dataAnimal, $sexo, $observacao, $nomeEspecie, $nomeTutor, $telefoneTutor, $cpf, $endereco){
        try {
            $codigoEspecie = $this->especieController->findOrCreateAndGetId($nomeEspecie);
            $codigoTutor = $this->tutorController->findOrCreateAndGetId($nomeTutor, $telefoneTutor, $cpf, $endereco);

            if ($codigoEspecie === 0 || $codigoTutor === 0) {
                error_log('Falha ao obter ID de espécie ou tutor para cadastrar animal.');
                return false;
            }

            $sqlAnimal = 'INSERT INTO animal (nome_animal, data_animal, sexo, observacao, codigo_especie, codigo_tutor) VALUES (?, ?, ?, ?, ?, ?)';
            $stmtAnimal = $this->pdo->prepare($sqlAnimal);
            return $stmtAnimal->execute([$nomeAnimal, $dataAnimal, $sexo, $observacao, $codigoEspecie, $codigoTutor]);
        } catch (PDOException $e) {
            error_log('Erro ao executar o cadastro completo do animal: ' . $e->getMessage());
            return false;
        }
    }

    public function listarAnimais(){
        try {
            $sqlListar = 'SELECT a.codigo_animal, a.nome_animal, a.data_animal, a.sexo, a.observacao, e.nome_especie, t.nome_tutor 
              FROM animal a 
              JOIN especie e ON a.codigo_especie = e.codigo_especie
              JOIN tutor t ON a.codigo_tutor = t.codigo_tutor
              ORDER BY a.nome_animal ASC';
              
            $stmtListar = $this->pdo->prepare($sqlListar);
            $stmtListar->execute();
            return $stmtListar->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao lstar animais: ' . $e->getMessage());
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

    public function editarAnimal(){
        try {
            $sqlEditar = 'UPDATE FROM animal SET nome_animal = ?, nome_especie = ?, data_animal = ?, sexo = ?, tutor = ? WHERE codigo_animal = ?';
            $stmtEditar = $this->pdo->prepare($sqlEditar);
            return $stmtEditar->execute();
        } catch (PDOException $e) {
            error_log('Erro ao editar animal: ' . $e->getMessage());

        }
    }
}
