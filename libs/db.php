<?php

class DatabaseConnection {
    private $host = "localhost";
    private $port = "5432";
    private $dbname = "calculo_trabalhista";
    private $user = "minha senha";
    private $password = "meu usuario";
    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}", 
                $this->user, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}

class DatabaseQuery extends DatabaseConnection {
    public function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro na consulta: " . $e->getMessage());
        }
    }
}

class DatabaseDML extends DatabaseConnection {
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            die("Erro ao executar DML: " . $e->getMessage());
        }
    }
}

// Exemplo de uso
$dbQuery = new DatabaseQuery();
$result = $dbQuery->fetchAll("SELECT * FROM usuarios WHERE idade > ?", [25]);
print_r($result);

$dbDML = new DatabaseDML();
$dbDML->execute("INSERT INTO usuarios (nome, idade) VALUES (?, ?)", ["João", 30]);

?>
