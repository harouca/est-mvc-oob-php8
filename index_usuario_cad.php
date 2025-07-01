<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudo OO - Classe e Objetos</title>
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

// verifica se a classe Usuario existe
if (!class_exists('App\Classes\Usuario')) {
    die('Erro: A classe Usuario não foi encontrada.');
}

// Instanciar a classe Usuario e criar o objeto
$usuario = new Usuario();
$msg = $usuario->cadastrar(
    'João da Silva',
    'joao@example.com',
    25
);

echo $msg;
?>

</html>