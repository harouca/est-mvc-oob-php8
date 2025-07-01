<?php
namespace App\Classes;
use PDO;
use PDOException;

$conexaoPath = __DIR__ . '/Conexao.php';
if (!file_exists($conexaoPath)) {
    die('Erro: O arquivo Conexao.php não foi encontrado.');
}
require_once $conexaoPath;


/**
 * Classe para gerenciamento de usuários
 */
class Usuario
{
    /**
     * Propriedades do usuário
     */
    public string $nome;
    public string $email;
    public int $idade;

    /**
     * Método para cadastrar um usuário
     *
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param int $idade Idade do usuário
     * @return string Mensagem de sucesso
     */
    public function cadastrar(string $nome, string $email, int $idade): string
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->idade = $idade;

        foreach (get_object_vars($this) as $key => $value) {
            echo "$key: $value\n" . '<br>';
        }


        return "<br><strong>{$this->nome}</strong> cadastrado com sucesso!";
    }

    public object|null $conexao = null;

    public function listar(): array
    {
        $this->conexao = new Conexao();
        $this->conexao->conectar();

        $sql = "SELECT * FROM usuarios ORDER BY nome ASC";
        $stmt = $this->conexao->conexao->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function incluir (string $nome, string $email, int $idade): string
    {
        $this->conexao = new Conexao();
        $this->conexao->conectar();

        $sql = "INSERT INTO usuarios (nome, email, idade) VALUES (:nome, :email, :idade)";
        $stmt = $this->conexao->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idade', $idade);

        if ($stmt->execute()) {
            return "<br><strong>{$nome}</strong> cadastrado com sucesso!";
        } else {
            return "<br>Erro ao cadastrar o usuário.";
        }
    }

}

?>