<?php

class Usuario
{
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
        # CARREGA OS DADOS DE UM USUÁRIO PELO ID
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuarios WHERE id =:id", array(
            ":id" => $id
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
        # REALIZA O SELECT DE TODOS OS ÚLTIMOS USUÁRIOS 
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuarios ORDER BY cadastro DESC");
        return $resultado;
    }

    public static function SearchUser($login)
    {
        # REALIZA A BUSCA DAS INFOMAÇÕES DE UM USUÁRIO ESPECÍFICO
        $sql =  new Sql();
        return $sql->Select("SELECT * FROM usuarios WHERE login like :search ORDER BY cadastro DESC", array(
            ":search" => "%{$login}%"
        ));
    }

    public function Autentication($login, $senha)
    {
        # REALIZA A VERIFICAÇÃO DOS DADOS DE LOGIN E SENHA
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuarios WHERE login =:login AND senha=:senha", array(
            ":login" => $login,
            ":senha" => $senha
        ));
        if (count($resultado) > 0) {
            # CASO ENCONTRADO O USUÁRIO NO SISTEMA, REALIZA O SET DAS INFORMAÇÕES
            $linha = $resultado[0];
            $this->setId($linha['id']);
            $this->setLogin($linha['login']);
            $this->setSenha($linha['senha']);
            $this->setCadastro($linha['cadastro']);
            $this->setNivel($linha['nivel']);
        } else {
            $erro = "Error Login/Senha errados";
            return $erro;
        }
        return $resultado;
    }

    public function LastUser()
    {
        # RETORNA OS DADOS DO ÚLTIMO USUÁRIO CADASTRADO
        $sql = new Sql();
        $resultado = $sql->Select("SELECT * FROM usuarios ORDER BY id DESC limit 1");
        return $resultado;
    }

    public function Insert($login, $senha)
    {
        # REALIZA O INSERT DOS DADOS
        $sql = new Sql();
        $resultado = $sql->ExecQuery("INSERT INTO usuarios(login,senha) VALUES(:login,:senha)", array(
            ":login" => $login,
            ":senha" => $senha
        ));
        if ($resultado) {
            # RETORNA O ÚLTIMO USUÁRIO CADASTRADO
            $usuario = new Usuario();
            return $usuario->LastUser();
        } else {
            return "Insert Falha";
        }
    }

    public function Update($login, $senha)
    {
        # REALIZA O SET DAS NOVAS INFORMAÇÕES PARA O OBJETO E EXECUTA A QUERY DE UPDATE
        $this->setLogin($login);
        $this->setSenha($senha);

        $sql = new Sql();
        $resultado = $sql->ExecQuery("UPDATE usuarios SET login =:login, senha=:senha WHERE id=:id", array(
            ":id" => $this->getId(),
            ":login" => $this->getLogin(),
            ":senha" => $this->getSenha(),
        ));

        if ($resultado) {
            # CARREGA AS INFORMAÇÕES DO USUARIO E RETORNA OS DADOS ATUALIZADOS
            $usuario = new Usuario();
            return $usuario->LoadbyID($this->getId());
        } else {
            return "Falha na atualização";
        }
    }

    public function Delete()
    {
        #REALIZA O DELETE DO USUÁRIO
        $sql = new Sql();
        $resultado = $sql->ExecQuery("DELETE FROM usuarios WHERE id=:id", array(
            ":id" => $this->getId()
        ));

        if ($resultado) {
            # RESETANDO OS VALORES E RETORNANDO A CONFIRMAÇÃO DO DELETE
            $this->setId("");
            $this->setLogin("");
            $this->setSenha("");
            $this->setCadastro("");
            $this->setNivel("");
            return "Deletado com sucesso";
        } else {
            return "Ops...Aconteceu algum error";
        }
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
