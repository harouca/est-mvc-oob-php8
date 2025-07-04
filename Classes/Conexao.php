<?php

namespace App\Classes;
use PDO;
use PDOException;

/**
 * Classe para gerenciar a conexão com o banco de dados
 * * @package App\Classes
 * @author Humberto Vilar Arouca
 * @version 1.0
 * @since 2025-07-01
 * * Esta classe é responsável por estabelecer e encerrar conexões com o banco de dados MySQL.
 * * Ela utiliza as configurações definidas no arquivo de configuração config.php.
 * * * A classe Conexao possui propriedades para armazenar as informações de conexão, como host, usuário, senha, banco e porta.
 * 
 * @param string $host Endereço do servidor MySQL
 * @param string $usuario Nome de usuário para autenticação no MySQL
 * @param string $senha Senha para autenticação no MySQL
 * @param string $banco Nome do banco de dados a ser utilizado
 * @param int $porta Porta do servidor MySQL (padrão: 3306)
 * @param PDO|null $conexao Instância da conexão PDO, inicializada como null
 */

class Conexao {
    public string $host;
    public string $usuario;
    public string $senha;
    public string $banco;
    public int $porta;
    public ?PDO $conexao = null;

    
    /**
     * Construtor da classe Conexao
     * Carrega as configurações do banco de dados a partir do arquivo config.php
     * @throws RuntimeException Se o arquivo de configuração não for encontrado
     */
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

    /**
     * Método para estabelecer a conexão com o banco de dados
     * Utiliza PDO para criar uma conexão com o MySQL
     * @throws PDOException Se ocorrer um erro ao tentar conectar
     */
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

    /**
     * Método para encerrar a conexão com o banco de dados
     */
    public function desconectar(): void {
        $this->conexao = null;
        // echo "Conexão encerrada.";
    }
}

?>