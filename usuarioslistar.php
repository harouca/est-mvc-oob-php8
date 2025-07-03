<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Usuários com Confirmação de Exclusão</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-light">

<div class="container py-4">
    <h1 class="mb-4">Lista de Usuários</h1>
    <button 
    class="btn btn-success mb-3" 
    data-bs-toggle="modal" 
    data-bs-target="#modalCadastrarUsuario">
    Novo Usuário
</button>


    <?php
    // Configurações de erro e importações, como antes...
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Usa a função de escape para evitar XSS. Usar esc para escapar strings antes de exibi-las
    function esc(?string $valor): string {
    return htmlspecialchars($valor ?? '', ENT_QUOTES, 'UTF-8');
}


    $usuarioPath = __DIR__ . '/Classes/Usuario.php';
    if (!file_exists($usuarioPath)) {
        die('<div class="alert alert-danger">Erro: O arquivo Usuario.php não foi encontrado.</div>');
    }
    require_once $usuarioPath;

    use App\Classes\Usuario;

    if (!class_exists('App\Classes\Usuario')) {
        die('<div class="alert alert-danger">Erro: A classe Usuario não foi encontrada.</div>');
    }

    if (!class_exists('App\Classes\Conexao')) {
        die('<div class="alert alert-danger">Erro: A classe Conexao não foi encontrada.</div>');
    }

    $usuario = new Usuario();

    // Processo de exclusão via POST vindo do modal
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir_id'])) {
        $idExcluir = (int)$_POST['excluir_id'];
        $msg = $usuario->excluir($idExcluir);
        echo '<div class="alert alert-info">' . esc($msg) . '</div>';
    }

    // Processamento do formulário de cadastro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'cadastrar') {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $idade = (int) ($_POST['idade'] ?? 0);

    if (empty($nome) || empty($email) || $idade <= 0) {
        echo '<div class="alert alert-danger">Por favor, preencha todos os campos corretamente.</div>';
    } else {
        $mensagem = $usuario->incluir($nome, $email, $idade);
        echo '<div class="alert alert-success">' . esc($mensagem) . '</div>';
    }
}

// Processamento do formulário de edição
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_id'])) {
    $id = (int) $_POST['editar_id'];
    $nome = $_POST['editar_nome'] ?? '';
    $email = $_POST['editar_email'] ?? '';
    $idade = (int) ($_POST['editar_idade'] ?? 0);
    $data_nascimento = $_POST['editar_nascimento'] ?? '';

    // Se desejar, use date('Y-m-d H:i:s') para timestamps
    $update_time = date('Y-m-d H:i:s');
    $create_time = date('Y-m-d H:i:s'); // ⚠️ Talvez você não queira sobrescrever o create_time!

    if (empty($nome) || empty($email) || $idade <= 0) {
        echo '<div class="alert alert-danger">Preencha todos os campos corretamente para atualizar.</div>';
    } else {
        $msg = $usuario->alterar($id, $nome, $email, $idade, $data_nascimento, $update_time, $create_time);
        echo '<div class="alert alert-success">' . esc($msg) . '</div>';
    }
}

// Listar usuários

    $listarUsuarios = $usuario->listar();

    if (empty($listarUsuarios)) {
        echo '<div class="alert alert-warning">Nenhum usuário cadastrado.</div>';
    } else {
        echo '<table class="table table-striped table-hover">';
        echo '<thead class="table-primary">';
        echo '<tr>';
        echo '<th>Nome</th>';
        echo '<th>Email</th>';
        echo '<th>Idade</th>';
        echo '<th>Ações</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

    foreach ($listarUsuarios as $user):
        $id = intval($user['id']);
        $nome = esc($user['nome']);
        $email = esc($user['email']);
        $idade = intval($user['idade']);
        $nascimento = esc($user['data_nascimento']);

    echo <<<HTML
    <tr>
        <td>$nome</td>
        <td>$email</td>
        <td>$idade</td>
        <td>
            <button 
                class="btn btn-sm btn-outline-primary me-2" 
                title="Alterar"
                data-bs-toggle="modal" 
                data-bs-target="#modalEditarUsuario"
                data-id="$id"
                data-nome="$nome"
                data-email="$email"
                data-idade="$idade"
                data-nascimento="$nascimento"
            >
                <i class="bi bi-pencil-square"></i>
            </button>

            <button 
                class="btn btn-sm btn-outline-danger" 
                title="Excluir"
                data-bs-toggle="modal" 
                data-bs-target="#confirmExcluirModal" 
                data-id="$id"
                data-nome="$nome"
            >
                <i class="bi bi-trash-fill"></i>
            </button>
        </td>
    </tr>
HTML;
endforeach;

        }

        echo '</tbody>';
        echo '</table>';
    
    ?>
</div>

<!-- MODAL ALTERAR USUÁRIO -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="formEditarUsuario">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="editar_id" id="editar_id">

          <div class="mb-3">
            <label for="editar_nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="editar_nome" id="editar_nome" required>
          </div>

          <div class="mb-3">
            <label for="editar_email" class="form-label">Email</label>
            <input type="email" class="form-control" name="editar_email" id="editar_email" required>
          </div>

          <div class="mb-3">
            <label for="editar_idade" class="form-label">Idade</label>
            <input type="number" class="form-control" name="editar_idade" id="editar_idade" required>
          </div>

          <div class="mb-3">
            <label for="editar_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" name="editar_nascimento" id="editar_nascimento" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Salvar Alterações</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Bootstrap para confirmação -->
<div class="modal fade" id="confirmExcluirModal" tabindex="-1" aria-labelledby="confirmExcluirModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="formExcluirUsuario">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmExcluirModalLabel">Confirmar Exclusão</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <p>Tem certeza que deseja excluir o usuário <strong id="nomeUsuarioExcluir"></strong>?</p>
          <input type="hidden" name="excluir_id" id="excluir_id" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal de Cadastro -->
<div class="modal fade" id="modalCadastrarUsuario" tabindex="-1" aria-labelledby="modalCadastrarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="">
        <input type="hidden" name="acao" value="cadastrar">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCadastrarUsuarioLabel">Cadastrar Novo Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="idade" class="form-label">Idade</label>
                <input type="number" class="form-control" id="idade" name="idade" required min="1">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 JS Bundle (Popper + JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Script para preencher modal com os dados do usuário clicado no botão excluir
var confirmExcluirModal = document.getElementById('confirmExcluirModal')
confirmExcluirModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var userId = button.getAttribute('data-id')
  var userName = button.getAttribute('data-nome')

  var modalTitle = confirmExcluirModal.querySelector('.modal-title')
  var modalBodyUserName = confirmExcluirModal.querySelector('#nomeUsuarioExcluir')
  var inputExcluirId = confirmExcluirModal.querySelector('#excluir_id')

  modalBodyUserName.textContent = userName
  inputExcluirId.value = userId
})

// Script para preencher modal de edição com os dados do usuário
var modalEditar = document.getElementById('modalEditarUsuario')
  modalEditar.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    document.getElementById('editar_id').value = button.getAttribute('data-id')
    document.getElementById('editar_nome').value = button.getAttribute('data-nome')
    document.getElementById('editar_email').value = button.getAttribute('data-email')
    document.getElementById('editar_idade').value = button.getAttribute('data-idade')
    document.getElementById('editar_nascimento').value = button.getAttribute('data-nascimento')
  })

  // Aguarda o carregamento do DOM
    document.addEventListener("DOMContentLoaded", function () {
        // Seleciona todos os alerts Bootstrap
        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(alert => {
            // Define o tempo para desaparecer (5 segundos = 5000 ms)
            setTimeout(() => {
                alert.classList.add('fade'); // aplica a classe fade
                alert.classList.remove('show'); // remove a classe show se tiver

                // Opcional: remove do DOM após o fade
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        });
    });

</script>

</body>
</html>
