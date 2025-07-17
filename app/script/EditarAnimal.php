<?php

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';


$redirectUrl = '/veterinaria/app/view/ListarAnimais.php';

$codigoAnimal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($codigoAnimal <= 0) {
    header('Location: ' . $redirectUrl . '?status=erro_id_invalido');
    exit();
}

try {
    $especieController = new EspecieController();
    $tutorController = new TutorController();
    $animalController = new AnimalController($tutorController, $especieController);

    $animal = $animalController->buscarCD($codigoAnimal);

    if (!$animal) {
        header('Location: ' . $redirectUrl . '?status=erro_animal_nao_encontrado');
        exit();
    }

    $especies = $especieController->listarEspecie();
    $tutores = $tutorController->listarTutores();

    require_once __DIR__ . '/../view/EdicaoAnimal.php';

} catch (Exception $e) {
    error_log('Erro ao carregar dados para a edição: ' . $e->getMessage());
    header('Location: ' . $redirectUrl . '?status=erro_excecao');
    exit();
}
