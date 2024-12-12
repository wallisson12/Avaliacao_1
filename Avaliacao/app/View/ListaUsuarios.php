<?php
require_once __DIR__ . "/../../Config/Session_Handler.php";
require_once __DIR__ . "/../../Config/Ambiente.php";

/** @var array $aUsuarios */
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>

<h3>Lista De Usuarios</h3>

<section>
    <table>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Tipo Usuario</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($aUsuarios as $oUsuario) { ?>
            <tr>
                <td><?php echo $oUsuario->getNome() ?></td>
                <td><?php echo $oUsuario->getTipoUsuario() ?></td>
                <?php if(Session_Handler::obterSessao('tipo') === 'Administrador') { ?>
                    <td><a href=<?php Ambiente::getUrl('Usuario/editar',true)?>?id=<?php echo $oUsuario->getId()?>>Editar</td>
                    <td>
                        <form action="<?php Ambiente::getUrl('Usuario/excluir',true)?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $oUsuario->getId()?>">
                            <input type="submit" value="Excluir">
                        </form>
                    </td>
                <?php } ?>
            </tr>

        <?php } ?>
        </tbody>

    </table>
</section>


<a href=<?php Ambiente::getUrl('Usuario/indexDashborad',true)?>>Voltar</a>

</body>
</html>
