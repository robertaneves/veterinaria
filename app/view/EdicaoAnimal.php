<?php
// Este bloco PHP é uma suposição de como você carrega os dados.
// Certifique-se de que ele corresponde ao seu script que prepara a página.
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../config/Conexao.php';
require_once __DIR__ . '/../../src/controller/AnimalController.php';
require_once __DIR__ . '/../../src/controller/EspecieController.php';
require_once __DIR__ . '/../../src/controller/TutorController.php';

$animal = null;
$especies = [];

$codigoAnimal = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($codigoAnimal > 0) {
    try {
        $conexao = Conexao::conectar();
        $especieController = new EspecieController();
        $tutorController = new TutorController();
        // Assumindo que o construtor do AnimalController precisa das dependências
        $animalController = new AnimalController($tutorController, $especieController);

        $animal = $animalController->buscarCD($codigoAnimal);
        $especies = $especieController->listarEspecie();

        if (!$animal) {
            // Lógica para animal não encontrado
            echo "Animal não encontrado!";
            exit;
        }
    } catch (Exception $e) {
        error_log('Erro ao carregar dados para edição: ' . $e->getMessage());
        echo "Ocorreu um erro ao carregar os dados.";
        exit;
    }
} else {
    echo "ID do animal inválido.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="../../public/assets/css/EditarAnimal.css">
</head>

<body>

    <div class="container container-custom my-5">
        <form action="../script/EditarAnimal.php" method="POST">

            <div class="form-header mb-4">
                <h2><i class="fa-solid fa-paw me-2"></i> Editar Animal</h2>
                <p>Altere os dados do animal e do seu tutor nos campos abaixo.</p>
            </div>

            <div class="row">
                <!-- Coluna de Informações do Animal -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Informações do Animal</h4>

                            <input type="hidden" name="codigo_animal" value="<?= isset($animal) ? $animal['codigo_animal'] : '' ?>">

                            <div class="mb-3">
                                <label for="nome_animal" class="form-label">Nome do Animal</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                    <input type="text" class="form-control" id="nome_animal" name="nome_animal" value="<?= isset($animal) ? htmlspecialchars($animal['nome_animal']) : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="data_animal" class="form-label">Data de Nascimento</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                    <input type="date" class="form-control" id="data_animal" name="data_animal" value="<?= isset($animal) ? htmlspecialchars($animal['data_animal']) : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="sexo" class="form-label">Sexo:</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-venus-mars"></i></span>
                                    <select class="form-select" name="sexo" id="sexo" required>
                                        <option value="" selected disabled>Selecione...</option>
                                        <option value="M">Macho</option>
                                        <option value="F">Fêmea</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="especie_id" class="form-label">Espécie</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-paw"></i></span>
                                    <select class="form-select" id="especie_id" name="especie_id" required>
                                        <option value="" disabled>Selecione a espécie</option>
                                        <?php
                                        $categoria = '';
                                        foreach ($especies as $especie):
                                            if ($especie['categoria'] !== $categoria) {
                                                if ($categoria !== '') {
                                                    echo '</optgroup>';
                                                }
                                                $categoria = $especie['categoria'];
                                                echo '<optgroup label="' . htmlspecialchars($categoria) . '">';
                                            }
                                            $isSelected = (isset($animal) && $especie['codigo_especie'] == $animal['codigo_especie']) ? 'selected' : '';
                                        ?>
                                            <option value="<?= htmlspecialchars($especie['codigo_especie']) ?>" <?= $isSelected ?>>
                                                <?= htmlspecialchars($especie['nome_especie']) ?>
                                            </option>
                                        <?php
                                        endforeach;
                                        if ($categoria !== '') {
                                            echo '</optgroup>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="observacao" class="form-label">Observação</label>
                                <textarea class="form-control" id="observacao" name="observacao" rows="3"><?= isset($animal) ? htmlspecialchars($animal['observacao']) : '' ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Coluna de Informações do Tutor -->
                <div class="col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Informações do Tutor</h4>

                            <div class="mb-3">
                                <label for="cpf_tutor" class="form-label">CPF (não pode ser alterado)</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                    <input type="text" class="form-control" id="cpf_tutor" name="cpf_tutor" value="<?= isset($animal) ? htmlspecialchars($animal['cpf']) : '' ?>" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nome_tutor" class="form-label">Nome do Tutor</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" class="form-control" id="nome_tutor" name="nome_tutor" value="<?= isset($animal) ? htmlspecialchars($animal['nome_tutor']) : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="telefone_tutor" class="form-label">Telefone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                    <input type="text" class="form-control" id="telefone_tutor" name="telefone_tutor" value="<?= isset($animal) ? htmlspecialchars($animal['telefone_tutor']) : '' ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="endereco_tutor" class="form-label">Endereço</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                    <input type="text" class="form-control" id="endereco_tutor" name="endereco_tutor" value="<?= isset($animal) ? htmlspecialchars($animal['endereco']) : '' ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="d-flex justify-content-end mt-3">
                <a href="ListarAnimais.php" class="btn btn-outline-secondary me-3">Cancelar</a>
                <button type="submit" class="btn btn-purple">Salvar Alterações</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00', {
                reverse: true
            });
            $('#telefone_tutor').mask('(00) 00000-0000');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>