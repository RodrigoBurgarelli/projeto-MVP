<?php
class ConexaoBD {
    
    private $serverName = "localhost";
    private $userName = "root";
    private $password = "root";
    private $dbName = "projeto_final";

    public function conectar() {
        $conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dbName);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        $conn->set_charset("utf8");

        return $conn;
    }
}
?>