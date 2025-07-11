<?php

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';


$redirectUrl = '/veterinaria/app/view/ListarAnimais.php';

$codigoAnimal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($codigoAnimal <= 0) {
    header('Location: ' . $redirectUrl);
    exit();
}

try {
    $conexao = Conexao::conectar();
    $especieController = new EspecieController();
    $tutorController = new TutorController();
    $animalController = new AnimalController($tutorController, $especieController);

    $sucesso = $animalController->deletarAnimal($codigoAnimal);

    if ($sucesso) {
        header('Location: ' . $redirectUrl . '?status=excluido_sucesso');
    } else {
        header('Location: ' . $redirectUrl . '?status=erro');
    }
    exit();

} catch (PDOException $e) {
    error_log("Erro ao tentar deletar animal: " . $e->getMessage());
    header('Location: ' . $redirectUrl . '?status=erro');
    exit();
}
