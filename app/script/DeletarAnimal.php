<?php

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';

$codigoAnimal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($codigoAnimal <= 0) {
    header('Location: ../view/ListarAnimais.php');
    exit();
}

try {
    $conexao = Conexao::conectar();
    $especieController = new EspecieController();
    $tutorController = new TutorController();

    $animalController = new AnimalController($tutorController, $especieController);

    $animalController->deletarAnimal($codigoAnimal);

    if ($sucesso) {
        header('Location: ../../view/ListarAnimais.php?status=excluido_sucesso');
    } else {
        header('Location: ../../view/ListarAnimais.php?status=erro');
    }
    exit();
} catch (PDOException $e) {
    error_log("Erro ao tentar deletar animal: " . $e->getMessage());
}

header('Location: ../view/ListarAnimais.php');
exit();
