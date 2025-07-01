<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudos de OO em PHP - Listar Usuários</title>
</head>
<body>

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
    $listarUsuarios = $usuario->listar();

?>
    <h1>Lista de Usuários</h1>
    
    <?php
    // Verifica se a lista de usuários está vazia
    if (empty($listarUsuarios)) {
        echo "<p>Nenhum usuário cadastrado.</p>";
        exit;
    }   
    foreach ($listarUsuarios as $user) {
        echo "<p><strong>Nome:</strong> {$user['nome']} | <strong>Email:</strong> {$user['email']} | <strong>Idade:</strong> {$user['idade']}</p>";
        echo "<hr>";
    }

    ?>
    
</body>
</html>