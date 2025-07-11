<?php

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $conexao = Conexao::conectar();

        $tutorController = new TutorController();
        $especieController = new EspecieController();
        $animalController = new AnimalController($tutorController, $especieController);


        // Dados do Animal
        $nomeAnimal = $_POST['nome_animal'] ?? '';
        $dataAnimal = $_POST['data_animal'] ?? '';
        $sexo = $_POST['sexo'] ?? '';
        $observacao = $_POST['observacao'] ?? '';

        // Dado da Espécie
        $nomeEspecie = $_POST['nome_especie'] ?? '';

        // Dados do Tutor
        $nomeTutor = $_POST['nome_tutor'] ?? '';
        $telefoneTutor = $_POST['telefone_tutor'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $endereco = $_POST['endereco'] ?? '';

        $erros = [];

        // Erros do animal
        if (empty($nomeAnimal)) {
            $erros[] = 'Nome do animal é obrigatório.';
        }
        if (empty($dataAnimal)) {
            $erros[] = 'A data do animal é obrigatório.';
        }
        if (empty($sexo)) {
            $erros[] = 'O sexo do animal é obrigatório.';
        }

        // Erros da espécie
        if (empty($nomeEspecie)) {
            $erros[] = 'A espécie do animal é obrigatória.';
        }

        // Erros do tutor
        if (empty($nomeTutor)) {
            $erros[] = 'Nome do tutor é obrigatório.';
        }
        if (empty($telefoneTutor)) {
            $erros[] = 'Telefone do tutor é obrigatório.';
        }
        if (empty($cpf)) {
            $erros[] = 'CPF do tutor é obrigatório.';
        }
        if (empty($endereco)) {
            $erros[] = 'Endereço do tutor é obrigatório.';
        }

        if (!empty($erros)) {
            header('Location: CriarAnimal.php?status=erro_validacao');
            exit();
        }

        $sucesso = $animalController->cadastrarAnimal($nomeAnimal, $dataAnimal, $sexo, $observacao, $nomeEspecie, $nomeTutor, $telefoneTutor, $cpf, $endereco);


        if ($sucesso) {
            header('Location: ListarAnimais.php?status=sucesso');
            exit();
        } else {
            header('Location: CriarAnimal.php?status=erro');
            exit();
        }
    } catch (PDOException $e) {
        error_log('Erro de conexão com o banco de dados: ' . $e->getMessage());
    }
} else {
    echo 'Método de requisição inválido.';
}
