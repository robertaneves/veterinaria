<?php

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';

$redirectUrl = '/veterinaria/app/view/ListarAnimais.php';

// Pega o ID da URL
$codigoAnimal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Validação básica do ID
if ($codigoAnimal <= 0) {
    header('Location: ' . $redirectUrl . '?status=erro_id_invalido');
    exit();
}

try {
    // Instancia os controllers
    $especieController = new EspecieController();
    $tutorController = new TutorController();
    $animalController = new AnimalController($tutorController, $especieController);

    // Busca dados do animal
    $animal = $animalController->buscarCD($codigoAnimal);

    if (!$animal) {
        header('Location: ' . $redirectUrl . '?status=erro_animal_nao_encontrado');
        exit();
    }

    // Carrega espécies e tutores
    $especies = $especieController->listarEspecie();
    $tutores = $tutorController->listarTutores();

    // Inclui a view da edição
    require_once __DIR__ . '/../view/EdicaoAnimal.php';

} catch (Exception $e) {
    error_log('Erro ao carregar dados para a edição: ' . $e->getMessage());
    header('Location: ' . $redirectUrl . '?status=erro_excecao');
    exit();
}
