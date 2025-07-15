<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';

$animais = [];

try {

    $conexao = Conexao::conectar();
    $especieController = new EspecieController();
    $tutorController = new TutorController();
    $animalController = new AnimalController($tutorController, $especieController);

    $animais = $animalController->listarAnimais();
} catch (PDOException $e) {
    error_log('Erro na conexão ou consulta: ' . $e->getMessage());
    $animais = [];
}

$mensagemAlerta = '';
$tipoAlerta = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'sucesso':
            $mensagemAlerta = 'Animal cadastrado com sucesso!';
            $tipoAlerta = 'success';
            break;
        case 'excluido':
            $mensagemAlerta = 'Animal excluído com sucesso!';
            $tipoAlerta = 'success';
            break;
        case 'editado':
            $mensagemAlerta = 'Animal editado com sucesso!';
            $tipoAlerta = 'success';
            break;
        case 'erro':
            $mensagemAlerta = 'Ocorreu um erro ao processar sua solicitação. Tente novamente.';
            $tipoAlerta = 'danger';
            break;
        case 'erro_validacao':
            $mensagemAlerta = 'Dados inválidos foram enviados. Por favor, verifique o formulário';
            $tipoAlerta = 'warning';
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais Cadastrados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/ListarAnimais.css">

</head>

<body>
    <?php if (!empty($mensagemAlerta) && !empty($tipoAlerta)): ?>
        <div class="alert alert-<?php echo htmlspecialchars($tipoAlerta); ?> alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($mensagemAlerta); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Animais Cadastrados</h2>
            <a href="CriarAnimal.php" class="btn btn-purple">Cadastrar Novo Animal</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-custom-header">
                    <tr>
                        <th>Nome do Animal</th>
                        <th>Espécie</th>
                        <th>Nascimento</th>
                        <th>Sexo</th>
                        <th>Tutor</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($animais) > 0) : ?>
                        <?php foreach ($animais as $animal) : ?>
                            <tr class="align-middle">
                                <td><?= htmlspecialchars($animal['nome_animal']) ?></td>
                                <td><?= htmlspecialchars($animal['nome_especie']) ?></td>

                                <td><?= date('d/m/Y', strtotime($animal['data_animal'])) ?></td>

                                <td><?= $animal['sexo'] === 'M' ? 'Macho' : 'Fêmea' ?></td>
                                <td><?= htmlspecialchars($animal['nome_tutor']) ?></td>

                                <td class="text-center">
                                    <a href="../../app/script/EditarAnimal.php?id=<?= $animal['codigo_animal'] ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>

                                    <a href="../../app/script/DeletarAnimal.php?id=<?= $animal['codigo_animal']; ?>" class="btn btn-sm btn-danger"> 
                                        <i class="bi bi-trash"></i> Excluir 
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Nenhum animal cadastrado ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>