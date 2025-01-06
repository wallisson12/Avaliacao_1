<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Filiado</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/../Avaliacao/public/Css/main.css">
</head>
<body>

<form action="<?php Ambiente::getUrl('Filiado/cadastrar',true)?>" method="post">


    <div class="mb-3">

        <div class="form-group">
            <div class="row d-flex justify-content-center p-2">
                <h3>Cadastro De Filiado</h3>
            </div>
        </div>

        <div><?php echo Mensagem::getMensagem() ?></div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Nome</label>
                <input class="form-control form-control-lg" type="text" name="nome" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">CPF</label>
                <input class="form-control form-control-lg" type="text" name="cpf" required>
                <span id=""></span>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">RG</label>
                <input class="form-control form-control-lg" type="text" name="rg" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Data Nascimento</label>
                <input class="form-control form-control-lg" id="dataNascimento" type="date" name="data_nascimento" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Idade</label>
                <input class="form-control form-control-lg" id="idade" type="number" name="idade" readonly>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Empresa</label>
                <input class="form-control form-control-lg" type="text" name="empresa">
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Cargo</label>
                <input class="form-control form-control-lg" type="text" name="cargo">
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <fieldset class="d-flex flex-column">
                    <label class="form-label col-form-label">Situacao</label>
                    <select class="form-select form-select-lg mb-3 p-3 rounded padraoSelects" name="situacao">
                        <option value="Ativo">Ativo</option>
                        <option value="Aposentado">Aposentado</option>
                        <option value="Licenciado">Licenciado</option>
                        <option value=""></option>
                    </select>
                </fieldset>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Telefone Residencial</label>
                <input class="form-control form-control-lg" type="text" name="telefone" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-6 offset-md-3">
                <label class="form-label col-form-label">Celular</label>
                <input class="form-control form-control-lg" type="text" name="celular" required>
            </div>
        </div>

        <div class="form-group">
            <div class="col-auto mb-3 col-md-4 offset-md-4 p-4">
                <input class="form-control btn btn-secondary btn-lg" type="submit" name="cadastrar" value="Cadastrar">
            </div>
        </div>
    </div>
</form>

    <div class="col-auto col-md-4">
        <a class="btn btn-dark btn-lg" role="button" href=<?php Ambiente::getUrl('Filiado/indexDashborad',true)?>>Voltar</a>
    </div>

    <script src="/../Avaliacao/public/Js/Filiados.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
