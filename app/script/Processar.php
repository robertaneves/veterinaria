<?php
require_once '../../src/controller/AnimalController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $animalController = new AnimalController();
    
    // Especie
    $nomeEspecie = $_POST['nome_especie'] ?? null;
    // $codigoEspecie = $animalController->getEspecieID($nomeEspecie); 

    // Animal
    $nomeAnimal = $_POST['nome_animal'];
    $dataNascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $observacao = $_POST['observacao'];


    // Tutor
    $codigoTutor = $_POST['codigo_tutor'] ?? null;   
    $nomeTutor = $_POST['nome_tutor'] ?? null;
    $telefoneTutor = $_POST['telefone_tutor'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $endereco = $_POST['endereco'] ?? null;


    
    $resultadoAnimal = $animalController->cadastrarAnimal($nomeAnimal, $dataNascimento, $sexo, $observacao, $codigoEspecie, $codigoTutor);
    $resultadoEspecie = $especieController->cadastrarEspecie($nomeEspecie);
    $resultadoEspecie = $tutorController->cadastrarTutor($nomeTutor, $telefoneTutor, $cpf, $endereco);

    try {
        if ($resultado) {
            echo 'Sucesso ao cadastrar o animal!';
            // header('Location: ../view/sucesso.php');
        } else {
            echo 'Falha ao cadastrar o animal.';
            // header('Location: ../view/erro.php');
        }
        
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}
?>