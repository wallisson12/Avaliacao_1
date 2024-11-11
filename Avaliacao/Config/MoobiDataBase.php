<?php

class MoobiDataBase
{
    public PDO $pdo;
    private string $sHost;
    private string $sPorta;
    private string $sBanco;
    private string $sUsuario;
    private string $sSenha;
    public function __construct()
    {
        $this->sHost = "localhost";
        $this->sPorta = "3305";
        $this->sBanco = "Wallisson";
        $this->sUsuario = "root";
        $this->sSenha = "";

        $this->pdo = new PDO("mysql:host={$this->sHost};port={$this->sPorta};dbname={$this->sBanco}", $this->sUsuario, $this->sSenha);
    }
}