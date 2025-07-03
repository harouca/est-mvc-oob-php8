<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste de Conexao</title>
</head>
<body>
    <h1>Teste de Conexão</h1>
    <?php
    $ConexaoPath = __DIR__ . '/Conexao.php';
    // Verifica se o arquivo Conexao.php existe
    if (!file_exists($ConexaoPath)) {
        die('Erro: O arquivo Conexao.php não foi encontrado.');
    }

    // Inclui o arquivo Conexao.php
    require_once $ConexaoPath;

    // Usa o namespace Conexao
    use App\Classes\Conexao;
    
    // Tenta conectar e cria uma instância da classe Conexao
    try {
    $conexao = new Conexao();
    $conexao->conectar();
    } catch (Exception $e) {
        echo "<strong>Erro na conexão:</strong> " . $e->getMessage();
        exit;
    }

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conexao->conexao) {
        echo "<p>Conexão estabelecida com sucesso!</p>";
    } else {
        echo "<p>Falha ao estabelecer conexão.</p>";
    }

    // Encerra a conexão
    $conexao->desconectar();
    if (!$conexao->conexao) {
        echo "<p>Conexão encerrada com sucesso!</p>";
    } else {
        echo "<p>Falha ao encerrar a conexão.</p>";
    }
    ?>
</body>
</html>