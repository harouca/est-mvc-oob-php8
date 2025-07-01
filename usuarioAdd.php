<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuario</title>
</head>
<body>
<h1>Adicionar Usuário</h1>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $usuarioPath = __DIR__ . '/Classes/Usuario.php';
    if (!file_exists($usuarioPath)) {
        die('Erro: O arquivo Usuario.php não foi encontrado.');
    }
    require_once $usuarioPath;

    use App\Classes\Usuario;
    // Verifica se a classe Usuario existe
    if (!class_exists('App\Classes\Usuario')) {
        die('Erro: A classe Usuario não foi encontrada.');
    }

    // use App\Classes\Conexao;
    if (!class_exists('App\Classes\Conexao')) {
        die('Erro: A classe Conexao não foi encontrada.');
    }
    // Instanciar a classe Usuario e criar o objeto
    $usuario = new Usuario();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $idade = (int) ($_POST['idade'] ?? 0);

        // Validar os dados recebidos
        if (empty($nome) || empty($email) || $idade <= 0) {
            echo "<p>Por favor, preencha todos os campos corretamente.</p>";
        } else {
            // Chamar o método incluir da classe Usuario
            $mensagem = $usuario->incluir($nome, $email, $idade);
            echo $mensagem;
        }
    }

?>
<form action="">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="idade">Idade:</label>
    <input type="number" id="idade" name="idade" required min="1"><br><br>

    <button type="submit">Cadastrar</button>
</form>
</body>
</html>