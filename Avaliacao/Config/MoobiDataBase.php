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

    /*
            * Responsavel por realizar consultas no banco de dados
            * No array passar os valores dos paramentos da query que esta sendo realizada
            * Percorrer o arry e colocar em cada '?' no sql o valor que esta no array
            * Na parte de +1 esse mais 1, eh so para o bindvalue, mas o valor do araay ja esta sendo passado na posicao certa
            *
            * @author Wallisson De Jesus wallissondejesus@moobi.com.br
            *
            * @param string $sSql  query sql
            * @param string $sParams  array onde pode ou nao ter parametros do sql
            * @return array
       */
    public function query(string $sSql,array $aParams = []): array
    {
        try
        {
            $PDOStatement = $this->pdo->prepare($sSql);

            if(!empty($aParams))
            {
                foreach($aParams as $sKey => $sValue)
                {
                    $PDOStatement->bindValue($sKey + 1, $sValue);
                }

                $PDOStatement->execute();
                return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                $PDOStatement->execute();
                return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
            }
        }catch (PDOException $e)
        {
            $e->getMessage();
            return [];
        }

    }

    /*
         * Responsavel por inserir e atualizar
         * No array passar os valores dos paramentos da query que esta sendo realizada
         * Percorrer o arry e colocar em cada '?' no sql o valor que esta no array
         * Na parte de +1 esse mais 1, eh so para o bindvalue, mas o valor do araay ja esta sendo passado na posicao certa
         *
         * @author Wallisson De Jesus wallissondejesus@moobi.com.br
         *
         * @param string $sSql  query sql
         * @param string $sParams  array onde pode ou nao ter parametros do sql
         * @return void
     */
    public function execute(string $sSql,array $aParams = []) : void
    {
        try
        {
            $PDOStatement = $this->pdo->prepare($sSql);

            if(!empty($aParams))
            {
                foreach($aParams as $sKey => $sValue)
                {
                    $PDOStatement->bindValue($sKey +1,$sValue);
                }

                $PDOStatement->execute();
            }
            else
            {
                $PDOStatement->execute();
            }

        }catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

