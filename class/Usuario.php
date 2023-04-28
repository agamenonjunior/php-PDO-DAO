<?php

class Usuario{
    private $id;
    private $login;
    private $senha;
    private $cadastro;
    private $nivel;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of login
     */ 
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set the value of login
     *
     * @return  self
     */ 
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of senha
     */ 
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */ 
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of cadastro
     */ 
    public function getCadastro()
    {
        return $this->cadastro;
    }

    /**
     * Set the value of cadastro
     *
     * @return  self
     */ 
    public function setCadastro($cadastro)
    {
        $this->cadastro = $cadastro;

        return $this;
    }

    /**
     * Get the value of nivel
     */ 
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set the value of nivel
     *
     * @return  self
     */ 
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function LoadbyID($id)
    {
        # pegando dados por ID
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuarios WHERE id =:id",array(
            ":id"=>$id
        ));
        if (count($resultado) > 0) {
            # code...
            $linha = $resultado[0];
            $this->setId($linha['id']);
            $this->setLogin($linha['login']);
            $this->setSenha($linha['senha']);
            $this->setCadastro($linha['cadastro']);
            $this->setNivel($linha['nivel']);

        }
        return $resultado;

    }

    public static function SelectAll()
    {
        # code...
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuarios ORDER BY cadastro DESC");
        return $resultado;
    }

    public static function SearchUser($login)
    {
        # code...
        $sql =  new Sql();
        return $sql->Select("SELECT * FROM usuarios WHERE login like :search ORDER BY cadastro DESC",array(
            ":search"=>"%{$login}%"
        ));
    }


    public function __toString()
    {
        #Retornando em json encode
        
        return json_encode(array(
            "id" => $this->getId(),
            "login" => $this->getLogin(),
            "senha" => $this->getSenha(),
            "cadastro" => $this->getCadastro(),
            "nivel" => $this->getNivel()
        ));
    }

}

?>