<?php
require_once __DIR__ . "/../../Config/Ambiente.php";
require_once __DIR__ . "/../../Config/Mensagem.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Filiado</title>
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
        <input type="date" name="data_nascimento" required>
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

<script src="/app/View/Js/Filiados.js"></script>

</body>
</html>
