<?php
require_once(__DIR__ . '/../../config/Conexao.php');
require_once(__DIR__ . '/EspecieController.php');
require_once(__DIR__ . '/TutorController.php');

class AnimalController {

    private $pdo;
    private $especieController;
    private $tutorController;
   
    public function __construct(TutorController $tutorController, EspecieController $especieController) {
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

}
