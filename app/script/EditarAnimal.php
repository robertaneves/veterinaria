<?php

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';


$redirectUrl = '/veterinaria/app/view/ListarAnimais.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Animal
    $codigoAnimal = isset($_POST['codigo_animal']) ? (int)$_POST['codigo_animal'] : 0 ;
    $nomeAnimal = isset($_POST['nome_animal']) ? trim ($_POST['nome_animal']) : '';
    $dataAnimal = isset($_POST['data_animal']) ? trim($_POST['data_animal']) : '';
    $sexo = isset($_POST['sexo']) ? trim($_POST['sexo']) : '';
    $observacao = isset($_POST['observacao']) ? trim($_POST['observacao']) : '';

    //Espécie
    $nomeEspecie = isset($_POST['nome_especie']) ? trim ($_POST['nome_especie']) : '';

    // Tutor
    $nomeTutor = isset($_POST['nome_tutor']) ? trim ($_POST['nome_tutor']) : '';
    $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
    $telefoneTutor = isset($_POST['telefone_tutor']) ? trim($_POST['telefone_tutor']) : '';
    $endereco = isset($_POST['endereco']) ? trim($_POST['endereco']) : '';

    if ($codigoAnimal <= 0 || empty($nomeAnimal) || empty($dataAnimal) || empty($nomeEspecie) || empty($nomeTutor) || empty($cpf)) {
        header('Location: ' . $redirectUrl . '?status=erro_validacao');
        exit();
    }

    try {
        $especieController = new EspecieController();
        $tutorController = new TutorController();
        $animalController = new AnimalController($tutorController, $especieController);
        
        $sucesso = $animalController->editarAnimal(
            $codigoAnimal,
            $nomeAnimal,
            $dataAnimal,
            $sexo,
            $observacao,
            $nomeEspecie,
            $nomeTutor,
            $cpf,
            $telefoneTutor,
            $endereco
        );

        if ($sucesso) {
            header('Location: ' . $redirectUrl . '?status=editado');
        } else {
            header('Location: ' . $redirectUrl . '?status=erro');
        }
        exit();

    } catch (Exception $e) {
        error_log("Erro ao processar a edição do animal: " . $e->getMessage());
        header('Location: ' . $redirectUrl . '?status=erro');
        exit();
    }

} else {
    header('Location: ' . $redirectUrl);
    exit();
}
?>
