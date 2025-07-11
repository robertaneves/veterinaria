<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $tutorController = new TutorController();
    $especieController = new EspecieController();
    $animalController = new AnimalController($tutorController, $especieController);

    // Animal
    $nomeAnimal = $_POST['nome_animal'] ?? '';
    $dataAnimal = $_POST['data_animal'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $observacao = $_POST['observacao'] ?? '';

    // Especie
    $nomeEspecie = $_POST['nome_especie'] ?? '';

    // Tutor
    $nomeTutor = $_POST['nome_tutor'] ?? '';
    $telefoneTutor = $_POST['telefone_tutor'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $endereco = $_POST['endereco'] ?? '';

    if (empty($nomeAnimal) || empty($dataAnimal) || empty($sexo) || empty($nomeEspecie) || empty($nomeTutor) || empty($cpf)) {
        header('Location: ../../view/CriarAnimal.php?status=erro_validacao');
        exit();
    }

    $sucesso = $animalController->cadastrarAnimal(
        $nomeAnimal, $dataAnimal, $sexo, $observacao, 
        $nomeEspecie, $nomeTutor, $telefoneTutor, $cpf, $endereco
    );

   // Linha CORRETA para ProcessarAnimal.php
if ($sucesso) {
    header('Location: /veterinaria/app/view/ListarAnimais.php?status=sucesso');
    exit();
} else {
    header('Location: /veterinaria/app/view/ListarAnimais.php?status=erro');
    exit();
}

} else {
    header('Location: ../../view/ListarAnimais.php');
    exit();
}
?>