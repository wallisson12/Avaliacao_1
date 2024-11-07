<?php

$url = isset($_GET['url']) ? $_GET['url'] : 'home/index';
$url = rtrim($url, '/');
$segments = explode('/', $url);

$controllerName = ucfirst($segments[0]) . 'Controller';
$metodoNome = isset($segments[1]) ? $segments[1] : 'index';

if (class_exists($controllerName) && method_exists($controllerName, $metodoNome)) {
    $controller = new $controllerName();
    $controller->$metodoNome();
} else
{
    $homeController = new HomeController();
    $homeController->index();
}

