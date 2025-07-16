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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/assets/css/CriarAnimal.css">
</head>

<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-container">
                    <h2 class="text-center mb-4">Cadastro de Animal</h2>
                    <form action="../../app/script/CriarAnimal.php" method="POST">
                        <fieldset class="mb-4">
                            <legend class="h5 mb-3 fw-bold fieldset-legend">Dados do Animal</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nome_animal" class="form-label">Nome do Animal:</label>
                                    <input type="text" class="form-control" name="nome_animal" id="nome_animal" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="data_animal" class="form-label">Data de Nascimento:</label>
                                    <input type="date" class="form-control" name="data_animal" id="data_animal" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sexo" class="form-label">Sexo:</label>
                                    <select class="form-select" name="sexo" id="sexo" required>
                                        <option value="" selected disabled>Selecione...</option>
                                        <option value="M">Macho</option>
                                        <option value="F">Fêmea</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="codigo_especie" class="form-label">Espécie:</label>
                                    <select class="form-select" name="codigo_especie" id="codigo_especie" required>
                                        <option value="" selected disabled>Selecione...</option>
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
                                    <input type="text" class="form-control" name="nome_tutor" id="nome_tutor" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cpf" class="form-label">CPF:</label>
                                    <input type="text" class="form-control" name="cpf" id="cpf" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telefone_tutor" class="form-label">Telefone:</label>
                                    <input type="text" class="form-control" name="telefone_tutor" id="telefone_tutor" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="endereco" class="form-label">Endereço:</label>
                                    <input type="text" class="form-control" name="endereco" id="endereco" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>