<?php
require_once 'autoLoad.php';
class Rota
{
    public static function rotear(array $aDados)
    {
        $url = strip_tags(filter_input(INPUT_GET, 'url', FILTER_DEFAULT));

        $verificacao = (!empty($url)) ? $url : 'home/index';

        $url = array_filter(explode('/', $verificacao));

        $controllerClass = ucfirst($url[0]) . 'Controller';
        $metodo = $url[1];

        if(class_exists($controllerClass) && method_exists($controllerClass,$metodo))
        {
            $controller = new $controllerClass();
            $controller->$metodo($aDados);
        }
        else
        {
            $controller = new HomeController();
            $controller->index($aDados);
        }

    }

}


