<?php
// Bloco de código para configurar a conexão com o banco de dados SQLite.

// Tenta criar ou conectar-se ao arquivo 'gerenciadorDeTarefas.db'.
try {
    $pdo = new PDO('sqlite:gerenciadorDeTarefas.db');
    // Define o modo de erro para lançar exceções em caso de falha.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cria a tabela 'tarefas' se ela não existir.
    $db = "CREATE TABLE IF NOT EXISTS tarefas (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        descricao TEXT NOT NULL,
        data_vencimento TEXT,
        concluida INTEGER DEFAULT 0
    )";
    $pdo->exec($db);

} catch (PDOException $e) {
    // Exibe mensagem de erro se a conexão falhar.
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    exit;
}

// Bloco de código que gerencia todas as ações do usuário (Adicionar, Concluir, Excluir).

// Processa a submissão do formulário POST para adicionar uma nova tarefa.
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    $descricao = $_POST['descricao'];
    $data_vencimento = $_POST['data_vencimento'];

    // Prepara e executa a query SQL para inserir a nova tarefa.
    $sql = "INSERT INTO tarefas (descricao, data_vencimento) VALUES (:descricao, :data_vencimento)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':data_vencimento', $data_vencimento);

    if ($stmt->execute()) {
        // Redireciona para a página principal após a adição.
        header('Location: index.php'); 
        exit;
    } else {
        echo "Erro ao adicionar tarefa.";
    }
}

// Processa a requisição GET para marcar uma tarefa como concluída.
if (isset($_GET['action']) && $_GET['action'] == 'complete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara e executa a query SQL para atualizar o status 'concluida' para 1.
    $sql = "UPDATE tarefas SET concluida = 1 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Redireciona para a página principal após a conclusão.
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao marcar tarefa como concluída.";
    }
}

// Processa a requisição GET para excluir uma tarefa.
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara e executa a query SQL para deletar a tarefa.
    $sql = "DELETE FROM tarefas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Redireciona para a página principal após a exclusão.
        header('Location: index.php');
        exit;
    } else {
        echo "Erro ao excluir tarefa.";
    }
}

// Bloco de código para buscar todas as tarefas do banco de dados para exibição.
$query = "SELECT * FROM tarefas ORDER BY id DESC";
$stmt = $pdo->query($query);
// Armazena todas as tarefas em um array.
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>

    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="add">
        <label for="descricao">Descrição da Tarefa:</label>
        <input type="text" name="descricao" required>
        <label for="data_vencimento">Data de Vencimento:</label>
        <input type="date" name="data_vencimento" required>
        <button type="submit">Adicionar Tarefa</button>
    </form>

    <h2>Tarefas Pendentes</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <?php if ($tarefa['concluida'] == 0): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['descricao']); ?> (Vencimento: <?php echo $tarefa['data_vencimento']; ?>)
                    <a href="index.php?action=complete&id=<?php echo $tarefa['id']; ?>">Marcar como concluída</a> |
                    <a href="index.php?action=delete&id=<?php echo $tarefa['id']; ?>">Excluir</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <h2>Tarefas Concluídas</h2>
    <ul>
        <?php foreach ($tarefas as $tarefa): ?>
            <?php if ($tarefa['concluida'] == 1): ?>
                <li>
                    <?php echo htmlspecialchars($tarefa['descricao']); ?> (Vencimento: <?php echo $tarefa['data_vencimento']; ?>)
                    <a href="index.php?action=delete&id=<?php echo $tarefa['id']; ?>">Excluir</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

</body>
</html>