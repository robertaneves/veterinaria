<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';

$redirectUrl = '/veterinaria/app/view/ListarAnimais.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomeAnimal = isset($_POST['nome_animal']) ? trim($_POST['nome_animal']) : '';
    $dataAnimal = isset($_POST['data_animal']) ? trim($_POST['data_animal']) : '';
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $nomeEspecie = isset($_POST['nome_especie']) ? trim($_POST['nome_especie']) : '';
    $observacao = isset($_POST['observacao']) ? trim($_POST['observacao']) : '';
    
    $nomeTutor = isset($_POST['nome_tutor']) ? trim($_POST['nome_tutor']) : '';
    $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
    $telefoneTutor = isset($_POST['telefone_tutor']) ? trim($_POST['telefone_tutor']) : '';
    $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : '';


    if (empty($nomeAnimal) || empty($dataAnimal) || empty($sexo) || empty($nomeEspecie) || empty($nomeTutor) || empty($cpf)) {
        header('Location: ' . $redirectUrl . '?status=erro_validacao');
        exit();
    }

    try {
        $especieController = new EspecieController();
        $tutorController = new TutorController();
        $animalController = new AnimalController($tutorController, $especieController);
        
        $sucesso = $animalController->cadastrarAnimal(
            $nomeAnimal, 
            $dataAnimal, 
            $sexo, 
            $observacao, 
            $nomeEspecie, 
            $nomeTutor, 
            $telefoneTutor, 
            $cpf, 
            $endereco
        );

        if ($sucesso) {
            header('Location: ' . $redirectUrl . '?status=sucesso');
            exit();
        } else {
            header('Location: ' . $redirectUrl . '?status=erro');
            exit();
        }

    } catch (PDOException $e) {
        error_log("Erro ao criar animal: " . $e->getMessage());
        header('Location: ' . $redirectUrl . '?status=erro');
        exit();
    }

} else {
    header('Location: ' . $redirectUrl);
    exit();
}