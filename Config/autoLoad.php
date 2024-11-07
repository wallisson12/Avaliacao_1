<?php

spl_autoload_register(function ($class)
{
    $diretorios = ['Controller/','Model/'];

    foreach($diretorios as $diretorio)
    {
        $file = __DIR__ . "/../app/$diretorio$class.php";

        if(file_exists($file))
        {
            require_once $file;
            return;
        }

    }

});
