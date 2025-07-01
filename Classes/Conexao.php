<?php

namespace App\Classes;
use PDO;
use PDOException;

class Conexao {
    public string $host;
    public string $usuario;
    public string $senha;
    public string $banco;
    public int $porta;
    public ?PDO $conexao = null;

   public function __construct() {
        $configPath = __DIR__ . '/../../config/config.php';
        if (!file_exists($configPath)) {
            throw new \RuntimeException("Arquivo de configuração não encontrado: $configPath");
        }
        $config = require $configPath;

        $this->host    = $config['host'];
        $this->usuario = $config['usuario'];
        $this->senha   = $config['senha'];
        $this->banco   = $config['banco'];
        $this->porta   = $config['porta'];
    }

    public function conectar(): void {
        try {
            $this->conexao = new PDO(
                "mysql:host={$this->host};dbname={$this->banco};port={$this->porta}",$this->usuario,$this->senha
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexão estabelecida com sucesso!";
        } catch (PDOException $e) {
            echo "<strong>Erro na conexão:</strong> " . $e->getMessage();
        }
    }

    public function desconectar(): void {
        $this->conexao = null;
        // echo "Conexão encerrada.";
    }
}

?>