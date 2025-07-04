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
        
        return '<div class="alert alert-success alert-dismissible fade show" role="alert">
        ' . 'Registro efetuado com sucesso.' . '
      </div>';

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
        $update_time = date('Y-m-d H:i:s');
        $create_time = date('Y-m-d H:i:s');
        $this->conexao = new Conexao();
        $this->conexao->conectar();

        $sql = "INSERT INTO usuarios (nome, email, idade, update_time, create_time) 
                VALUES (:nome, :email, :idade, :update_time, :create_time)";
        $stmt = $this->conexao->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':update_time', $update_time);
        $stmt->bindParam(':create_time', $create_time);

        if ($stmt->execute()) {
            return "Cadastrado efetuado com sucesso!";
        } else {
            return "Erro ao cadastrar o usuário.";
        }
    }

    public function alterar(int $id, string $nome, string $email, int $idade, string $data_nascimento, string $update_time, string $create_time): string
{
        $this->conexao = new Conexao();
        $this->conexao->conectar();

        $sql = "UPDATE usuarios SET  
                    nome = :nome, 
                    email = :email, 
                    idade = :idade, 
                    data_nascimento = :data_nascimento, 
                    update_time = :update_time, 
                    create_time = :create_time
                WHERE id = :id";

        $stmt = $this->conexao->conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idade', $idade);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':update_time', $update_time);
        $stmt->bindParam(':create_time', $create_time);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "<br><strong>{$nome}</strong> atualizado com sucesso!";
        } else {
            return "<br>Erro ao atualizar o usuário.";
        }
}

    public function excluir(int $id): string
{
        $this->conexao = new Conexao();
        $this->conexao->conectar();

        $sql = "DELETE FROM usuarios WHERE id = :id";

        $stmt = $this->conexao->conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "Registro excluído com sucesso!";
        } else {
            return "<br>Erro ao excluir o usuário.";
        }
}



}

?>