<?php
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>
    <div class="container container-custom">
        <?php if (!empty($mensagemAlerta) && !empty($tipoAlerta)) : ?>
            <div class="alert alert-<?php echo htmlspecialchars($tipoAlerta); ?> alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($mensagemAlerta); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center page-header">
            <div>
                <h2 class="text"><i class="fa-solid fa-paw me-2"></i> Animais Cadastrados</h2>
                <p class="mb-0">Visualize, edite ou exclua os registros de animais.</p>
            </div>
            <a href="CriacaoAnimal.php" class="btn btn-purple"><i class="fa-solid fa-plus me-2"></i> Cadastrar Animal</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome do Animal</th>
                        <th colspan="3">Detalhes</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($animais) > 0) : ?>
                        <?php foreach ($animais as $animal) : ?>
                            <tr>
                                <td>
                                    <span class="badge-nome">
                                        <i class="fa-solid fa-tag icone"></i><?= htmlspecialchars($animal['nome_animal']) ?>
                                    </span>
                                </td>
                                <td class="td-icon">
                                    <span class="badge-dado"><i class="fa-solid fa-dog icone"></i><?= htmlspecialchars($animal['nome_especie']) ?></span>
                                    <span class="badge-dado"><i class="fa-solid fa-calendar-days icone"></i><?= date('d/m/Y', strtotime($animal['data_animal'])) ?></span>
                                </td>
                                <td class="td-icon">
                                    <span class="badge-dado"><i class="fa-solid fa-<?= $animal['sexo'] === 'M' ? 'mars' : 'venus' ?> icone"></i><?= $animal['sexo'] === 'M' ? 'Macho' : 'Fêmea' ?></span>
                                    <span class="badge-dado"><i class="fa-solid fa-user icone"></i><?= htmlspecialchars($animal['nome_tutor']) ?></span>
                                </td>
                                <td class="text-center">
                                    <a href="../../app/script/EditarAnimal.php?id=<?= $animal['codigo_animal'] ?>" class="btn btn-sm" style="background-color: #6B21A8; color: white;">
                                        <i class="fa-solid fa-pencil me-1"></i> Editar
                                    </a>
                                    <a href="../../app/script/DeletarAnimal.php?id=<?= $animal['codigo_animal']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este animal?')">
                                        <i class="fa-solid fa-trash me-1"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum animal cadastrado ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
    }

    .container-custom {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .text {
        color: #343a40;
    }

    .btn-purple {
        background-color: #6B21A8;
        color: #fff;
    }

    .btn-purple:hover {
        background-color: #5a189a;
        color: #fff;
    }

    .badge-nome,
    .badge-dado {
        background-color: #f3e8ff;
        color: #6B21A8;
        font-weight: 500;
        padding: 6px 10px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .icone {
        color: #6B21A8;
        margin-right: 6px;
    }

    .td-icon {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .table td {
        vertical-align: middle;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .fa-paw{
        color: #6B21A8;
    }
</style>

</html>