<?php

class Sql extends PDO{
    
    private $conn;
    
    public function __construct()
    {
        # realizando conexao com o banco de dados
        $this->conn = new PDO("mysql:host=localhost;dbname=newslatter", "root", "");
    }

    
    private function SetParams($statment, $Parametros = array())
    {
        # code...
        foreach ($Parametros as $key => $value) {
            /*
            Percorrendo os parametros,realizando o bind através do SetParam

            */
            $this->SetParam($statment,$key,$value);
         }

    }
    private function SetParam($statment,$key,$value)
    {
        # code...
        $statment->bindParam($key,$value);
    }

    public function ExecQuery($query,$Parametros = array())
    {
        # code...
         $stmt = $this->conn->prepare($query);
         $this->SetParams($stmt, $Parametros);
         $stmt->execute();
         return $stmt;
    }

    

    public function Select($MyQuery,$Parametros = array()):array
    {
        # Realiza a Consulta SQL
        $stmt = $this->ExecQuery($MyQuery,$Parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    

}
