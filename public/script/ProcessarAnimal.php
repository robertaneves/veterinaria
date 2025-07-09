<?php

// AGORA VEM O RESTO DO SEU CÓDIGO
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
        $dataNascimento = $_POST['data_nascimento'] ?? '';
        $sexo = $_POST['sexo'] ?? '';
        $observacao = $_POST['observacao'] ?? '';
        
        // Dado da Espécie
        $nomeEspecie = $_POST['nome_especie'] ?? '';

        // Dados do Tutor
        $nomeTutor = $_POST['nome_tutor'] ?? '';
        $telefoneTutor = $_POST['telefone_tutor'] ?? '';
        $cpf = $_POST['cpf'] ?? '';
        $endereco = $_POST['endereco'] ?? '';

        $sucesso = $animalController->cadastrarAnimal(
            $nomeAnimal,
            $dataNascimento,
            $sexo,
            $observacao,
            $nomeEspecie,
            $nomeTutor,
            $telefoneTutor,
            $cpf,
            $endereco
        );


        if ($sucesso) {
            echo 'Sucesso ao cadastrar o animal!';
        } else {
            echo 'Falha ao cadastrar o animal. Verifique os dados ou o log de erros.';
        }

    } catch (PDOException $e) {
        error_log('Erro de conexão com o banco de dados: ' . $e->getMessage());
    }
} else {
    echo 'Método de requisição inválido.';
}
?>