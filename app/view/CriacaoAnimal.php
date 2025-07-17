<?php
require_once __DIR__ . '/../../src/controller/EspecieController.php';
$especieController = new EspecieController();
$especies = $especieController->listarEspecie();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Animal</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (para ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <!-- Seu CSS Personalizado -->
    <link rel="stylesheet" href="../../public/assets/css/CriarAnimal.css">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container p-4 p-md-5">
                    <h2 class="text-center mb-4">Cadastro de Animal</h2>
                    <form action="../../app/script/CriarAnimal.php" method="POST">
                        
                        <fieldset class="mb-4">
                            <legend class="h5 mb-3 fw-bold fieldset-legend">Dados do Animal</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nome_animal" class="form-label">Nome do Animal:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                        <input type="text" class="form-control" name="nome_animal" id="nome_animal" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="data_animal" class="form-label">Data de Nascimento:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                        <input type="date" class="form-control" name="data_animal" id="data_animal" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
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
                                <div class="col-md-6 mb-3">
                                    <label for="codigo_especie" class="form-label">Espécie:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-paw"></i></span>
                                        <select class="form-select" name="codigo_especie" id="codigo_especie" required>
                                            <!-- Seu loop PHP para espécies aqui -->
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
                                            ?>
                                                <option value="<?= htmlspecialchars($especie['codigo_especie']) ?>">
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
                            </div>
                            <div class="mb-3">
                                <label for="observacao" class="form-label">Observações:</label>
                                <textarea class="form-control" name="observacao" id="observacao" rows="4"></textarea>
                            </div>
                        </fieldset>

                        <fieldset class="mb-4">
                            <legend class="h5 mb-3 fw-bold fieldset-legend">Dados do Tutor</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nome_tutor" class="form-label">Nome do Tutor:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                        <input type="text" class="form-control" name="nome_tutor" id="nome_tutor" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cpf" class="form-label">CPF:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                        <input type="text" class="form-control" name="cpf" id="cpf" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefone_tutor" class="form-label">Telefone:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                        <input type="text" class="form-control" name="telefone_tutor" id="telefone_tutor" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="endereco" class="form-label">Endereço:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                                        <input type="text" class="form-control" name="endereco" id="endereco" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-purple btn-lg">Cadastrar Animal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00', { reverse: true });
            $('#telefone_tutor').mask('(00) 00000-0000');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>