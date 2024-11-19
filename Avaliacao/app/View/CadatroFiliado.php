<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Filiado</title>
    <h3>Cadastro De Filiado</h3>
</head>
<body>

<form action="http://localhost:5000/Avaliacao/Filiado/cadastrar"  method="post">

    <div>
        <label>Nome</label>
        <input type="text" name="nome" required>
    </div>

    <div>
        <label>CPF</label>
        <input type="text" name="cpf" required>
    </div>

    <div>
        <label>RG</label>
        <input type="text" name="rg" required>
    </div>

    <div>
        <label>Data Nascimento</label>
        <input type="text" name="data_nascimento" required>
    </div>

    <div>
        <label>Empresa</label>
        <input type="text" name="empresa">
    </div>

    <div>
        <label>Cargo</label>
        <input type="text" name="cargo">
    </div>

    <div>
        <label>Situacao</label>
        <input type="text" name="situacao">
    </div>

    <div>
        <label>Telefone Residencial</label>
        <input type="text" name="telefone" required>
    </div>

    <div>
        <label>Celular</label>
        <input type="text" name="celular" required>
    </div>

        <input type="submit" name="cadastrar" value="Cadastrar">
</form>

<a href="http://localhost:5000/Avaliacao/Filiado/indexAdmDashborad">Voltar</a>

</body>
</html>
