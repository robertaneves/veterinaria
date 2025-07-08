<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Animal</title>
    
</head>
<body>

    <h2>Cadastro de Animal</h2>

    <form action="/veterinaria/app/script/Processar.php" method="POST">

        <!-- Dados do Animal -->
        <fieldset>
            <legend>Dados do Animal</legend>

            <label for="nome_animal">Nome do Animal:</label>
            <input type="text" name="nome_animal" id="nome_animal" required>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" name="data_nascimento" id="data_nascimento" required>

            <label for="sexo">Sexo:</label>
            <select name="sexo" id="sexo" required>
                <option value="">Selecione</option>
                <option value="M">Macho</option>
                <option value="F">Fêmea</option>
            </select>

            <label for="observacao">Observações:</label>
            <textarea name="observacao" id="observacao" rows="4"></textarea>
        </fieldset>

        <!-- Dados da Espécie -->
        <fieldset>
            <label for="nome_especie">Espécie:</label>
            <select name="nome_especie" required>
                <option value="">Selecione a espécie</option>
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
        </fieldset>

        <!-- Dados do Tutor -->
        <fieldset>
            <legend>Tutor</legend>

            <label for="nome_tutor">Nome do Tutor:</label>
            <input type="text" name="nome_tutor" id="nome_tutor" required>

            <label for="telefone_tutor">Telefone:</label>
            <input type="text" name="telefone_tutor" id="telefone_tutor" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" required>

            <label for="endereco">Endereço:</label>
            <input type="text" name="endereco" id="endereco" required>
        </fieldset>

        <button type="submit">Cadastrar Animal</button>

    </form>

</body>
</html>
