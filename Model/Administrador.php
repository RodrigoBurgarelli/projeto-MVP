<?php
class Administrador {
    private $id;
    private $nome;
    private $cpf;
    private $senha;

    // Métodos Getters e Setters
    public function setID($id) { 
        $this->id = $id; 
    }
    public function getID() { 
        return $this->id; 
    }

    public function setNome($nome) { 
        $this->nome = $nome; 
    }
    public function getNome() { 
        return $this->nome; 
    }

    public function setCPF($cpf) { 
        $this->cpf = $cpf; 
    }
    public function getCPF() { 
        return $this->cpf; 
    }

    public function setSenha($senha) { 
        $this->senha = $senha; 
    }
    public function getSenha() { 
        return $this->senha; 
    }

    // Carrega os dados do administrador através do CPF
    public function carregarAdministrador($cpf) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM administrador WHERE cpf = '" . $cpf . "'";
        $re = $conn->query($sql);
        $r = $re->fetch_object();

        if ($r != null) {
            $this->id = $r->idadministrador;
            $this->nome = $r->nome;
            $this->cpf = $r->cpf;
            $this->senha = $r->senha;
            $conn->close();
            return true;
        } else {
            $conn->close();
            return false;
        }
    }

    // Lista todos os administradores cadastrados (Desafio)
    public function listaCadastrados() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT idadministrador, nome, cpf FROM administrador;";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
}
?>