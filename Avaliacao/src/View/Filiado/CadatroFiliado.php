<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Filiado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <h3>Cadastro De Filiado</h3>

    <form action="<?php Ambiente::getUrl('Filiado/cadastrar',true)?>" method="post">

        <div><?php echo Mensagem::getMensagem() ?></div>

        <div>
            <label>Nome</label>
            <input type="text" name="nome" required>
        </div>

        <div>
            <label>CPF</label>
            <input type="text" name="cpf" required>
            <span id=""></span>
        </div>

        <div>
            <label>RG</label>
            <input type="text" name="rg" required>
        </div>

        <div>
            <label>Data Nascimento</label>
            <input id="dataNascimento" type="date" name="data_nascimento" required>
        </div>

        <div>
            <label>Idade</label>
            <input id="idade" type="number" name="idade" readonly>
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
            <select name="situacao">
                <option value="Ativo">Ativo</option>
                <option value="Aposentado">Aposentado</option>
                <option value="Licenciado">Licenciado</option>
                <option value=""></option>
            </select>
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

    <a href=<?php Ambiente::getUrl('Filiado/indexDashborad',true)?>>Voltar</a>

    <script src="/../Avaliacao/public/Js/Filiados.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
