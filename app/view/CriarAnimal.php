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

                    <form action="" method="POST">

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
                                    <label for="nome_especie" class="form-label">Espécie:</label>
                                    <select class="form-select" name="nome_especie" id="nome_especie" required>
                                        <option value="" selected disabled>Selecione a espécie...</option>
                                        <optgroup label="Cães">
                                            <option value="labrador">Labrador Retriver</option>
                                            <option value="poodle">Poodle</option>
                                            <option value="bulldog">Bulldog Francês</option>
                                            <option value="pastor">Pastor Alemão</option>
                                            <option value="golden">Golden Retriver</option>
                                            <option value="shihtzu">Shih Tzu</option>
                                            <option value="salsicha">Dachshund (Salsicha)</option>
                                            <option value="rottweiler">Rottwelier</option>
                                            <option value="lulu">Spitz Alemão (Lulu da Pomerânia)</option>
                                            <option value="pitbull">Pit Bull Terrier</option>
                                        </optgroup>
                                        <optgroup label="Gatos">
                                            <option value="persa">Persa</option>
                                            <option value="siames">Siamês</option>
                                            <option value="maine">Maine Coon</option>
                                            <option value="angora">Angorá</option>
                                            <option value="sphynx">Sphynx</option>
                                            <option value="bengal">Bengal</option>
                                            <option value="ragdoll">Ragdoll</option>
                                            <option value="azul">Azul Russo</option>
                                            <option value="scottish">Scottish Fold</option>
                                            <option value="shorthair">American Shorthair</option>
                                        </optgroup>
                                        <optgroup label="Outros">
                                            <option value="coelho">Coelho</option>
                                            <option value="hamster">Hamster</option>
                                            <option value="porquinho">Porquinho da Índia</option>
                                            <option value="calopsita">Calopsita</option>
                                            <option value="canario">Canário</option>
                                            <option value="tartaruga">Tartaruga</option>
                                            <option value="iguana">Iguana</option>
                                            <option value="ferret">Ferret (Furão)</option>
                                            <option value="Cavalo">Cavalo</option>
                                            <option value="papagaio">Papagaio</option>
                                        </optgroup>
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

    <?php if (!empty($mensagemAlerta)): ?>
        <div class="alert alert-<?= htmlspecialchars($tipoAlerta) ?> alert-dismissible fade show my-3" role="alert">
            <?= htmlspecialchars($mensagemAlerta) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>