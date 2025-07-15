<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/css/EditarAnimal.css">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-purple text-white">
                <h2 class="mb-0">Editar Animal: <?= isset($animal) ? htmlspecialchars($animal['nome_animal']) : 'Animal' ?></h2>
            </div>
            <div class="card-body">
                <form action="../script/EditarAnimal.php" method="POST">

                    <input type="hidden" name="codigo_animal" value="<?= isset($animal) ? $animal['codigo_animal'] : '' ?>">

                    <div class="mb-3">
                        <label for="nome_animal" class="form-label">Nome do Animal</label>
                        <input type="text" class="form-control" id="nome_animal" name="nome_animal" value="<?= isset($animal) ? htmlspecialchars($animal['nome_animal']) : '' ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="data_animal" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_animal" name="data_animal" value="<?= isset($animal) ? htmlspecialchars($animal['data_animal']) : '' ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select class="form-select" id="sexo" name="sexo" required>
                                <option value="M" <?= (isset($animal) && $animal['sexo'] === 'M') ? 'selected' : '' ?>>Macho</option>
                                <option value="F" <?= (isset($animal) && $animal['sexo'] === 'F') ? 'selected' : '' ?>>Fêmea</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="especie_id" class="form-label">Espécie</label>
                        <select class="form-select" id="especie_id" name="especie_id" required>
                            <option value="">Selecione a espécie</option>

                            <?php
                            $current_category = '';
                            foreach ($especies as $especie):
                                if ($especie['categoria'] !== $current_category) {
                                    if ($current_category !== '') {
                                        echo '</optgroup>';
                                    }
                                    $current_category = $especie['categoria'];
                                    echo '<optgroup label="' . htmlspecialchars($current_category) . '">';
                                }

                                $isSelected = (isset($animal) && $especie['codigo_especie'] == $animal['codigo_especie']) ? 'selected' : '';
                            ?>

                                <option value="<?= $especie['codigo_especie'] ?>" <?= $isSelected ?>>
                                    <?= htmlspecialchars($especie['nome_especie']) ?>
                                </option>

                            <?php
                            endforeach;

                            if ($current_category !== '') {
                                echo '</optgroup>';
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <div class="mb-3">
                            <label for="observacao" class="form-label">Observação</label>
                            <textarea class="form-control" id="observacao" name="observacao" rows="3"><?= isset($animal) ? htmlspecialchars($animal['observacao']) : '' ?></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tutor</label>
                        <input type="text" class="form-control" value="<?= isset($animal) ? htmlspecialchars($animal['nome_tutor']) : '' ?>" readonly>
                    </div>

                    <div class="d-flex justify-content-end">
                        <a href="ListarAnimais.php" class="btn btn-secondary me-2">Cancelar</a>
                        <button type="submit" class="btn btn-purple">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>