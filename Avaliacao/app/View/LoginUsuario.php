<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Responsavel por fazer o login</title>
    <h3>Tela para realizar o login</h3>
</head>
<body>

<form action="http://localhost:5000/Avaliacao/Login/logar" method="post">

    <label>Nome: </label>
    <input type="text" name="nome" id="nome" required>

    <label>Senha: </label>
    <input type="password" name="senha" id="senha" required>

    <input type="submit" name="login" value="Login">

</form>

</body>
</html>
