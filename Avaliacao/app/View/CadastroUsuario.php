<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Usuario</title>
    <h3>Pagina para cadastrar usuario</h3>
</head>
<body>


<form action="http://localhost:5000/Avaliacao/Usuario/cadastrar"  method="post">

    <div>
        <label>Nome</label>
        <input type="text" name="nome" required>
    </div>

    <div>
        <label>Senha</label>
        <input type="password" name="senha" required>
    </div>

    <div>
        <label>Tipo</label>
        <select name="tipo">
            <option value="Administrador">Administrador</option>
            <option value="Comum">Comum</option>
        </select>
    </div>

    <input type="submit" name="cadastrar" value="Cadastrar">

</form>
<a href="http://localhost:5000/Avaliacao/Usuario/indexAdmDashborad">Voltar</a>

</body>
</html>
