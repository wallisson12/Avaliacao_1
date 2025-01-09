<?php
use Moobi\Avaliacao\Config\Ambiente;
use Moobi\Avaliacao\Config\Mensagem;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro De Filiado</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/../Avaliacao/public/Css/main.css">
</head>
<body>
    <?php require(__DIR__ . '/../parcial/nav.php')?>

<form id="formcadastrofiliado" action="<?php Ambiente::getUrl('Filiado/cadastrar',true)?>" method="post">

    <div class="mb-3">

        <div class="form-group">
            <div class="row d-flex justify-content-center p-2">
                <h3>Cadastro De Filiado</h3>
            </div>
        </div>

        <div class="form-group">
            <div class="row d-flex justify-content-center">
			    <?php echo Mensagem::getMensagem()?>
            </div>
        </div>

        <div id="tabs">
                <ul>
                    <li><a href="#tabs-1">Dados Pessoais</a></li>
                    <li><a href="#tabs-2">Dados Empresa</a></li>
                    <li><a href="#tabs-3">Dados Contato</a></li>
                </ul>
                <div id="tabs-1">
                    <?php require(__DIR__ . '/../parcial/Filiado/dados_pessoais.php')?>
                </div>
                <div id="tabs-2">
	                <?php require(__DIR__ . '/../parcial/Filiado/dados_empresa.php')?>
                </div>
                <div id="tabs-3">
                    <?php require(__DIR__ . '/../parcial/Filiado/dados_contato.php')?>
                </div>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
    <script src="../../../public/Js/Filiado.js"></script>
    <script src="/../Avaliacao/public/Js/TabsFiliado.js"></script>
    <script src="/../Avaliacao/public/Js/ValidacaoCadastroFiliado.js"></script>

</body>
</html>
