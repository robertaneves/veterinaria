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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../../public/assets/css/CriarAnimal.css">
</head>

<body>
    <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-container p-4 p-md-5">
                <div class="form-header mb-4">
                    <h2 class="text-start"><i class="fa-solid fa-paw me-2"></i>Cadastro de Animal</h2>
                    <p>Informe os dados do animal e do seu tutor nos campos abaixo.</p>
                </div>

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
                                            <option value="" disabled selected>Selecione...</option>
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
            $('#cpf').mask('000.000.000-00', {
                reverse: true
            });
            $('#telefone_tutor').mask('(00) 00000-0000');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-container {
            background-color: #fff;
            border-radius: 1rem;
            box-shadow: 0 0 20px rgba(135, 81, 179, 0.2);
        }

        h2 {
            color: #343a40;
            font-weight: bold;
        }

        label.form-label {
            font-weight: 500;
            color: #555;
        }

        input.form-control,
        textarea.form-control,
        select.form-select {
            border-radius: 0.75rem;
            border: 1px solid #ced4da;
            color: #495057;
        }

        input.form-control:focus,
        textarea.form-control:focus,
        select.form-select:focus {
            border-color: #8a4be1;
            box-shadow: 0 0 0 0.2rem rgba(138, 75, 225, 0.25);
        }

        .input-group-text {
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            color: #6f42c1;
        }

        .fieldset-legend {
            color: #6f42c1;
            border-left: 4px solid #b37cf0;
            padding-left: 0.5rem;
        }

        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border-radius: 0.75rem;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #5b36a6;
        }

        .input-group:focus-within .input-group-text {
        background-color: #6f42c1;
        border-color: #6f42c1;
    }

    .input-group:focus-within .input-group-text i {
        color: #ffffff;
    }

    .form-control:focus {
        border-color: #a37ee4; 
        box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25); 
        outline: 0; 
    }

    .fa-paw{
        color: #6B21A8;
    }
    </style>
</body>

</html>