<?php

class HomeController
{
    public function index(array $aDados = null)
    {
        require_once __DIR__ . "/../View/Home.php";
    }

}