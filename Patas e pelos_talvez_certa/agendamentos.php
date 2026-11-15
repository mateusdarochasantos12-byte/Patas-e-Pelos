<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

// 1. Verifica se está logado
if (!isset($_SESSION['nome'])) {
    echo json_encode(['erro' => 'nao_logado']);
    exit();
}

include 'agendamentos_db.php';

// 2. Excluir / Desfazer agendamento
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $stmt = mysqli_prepare($conexao, "DELETE FROM agendamentos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: agendamentos.html?removido=1");
    exit();
}

// 3. Buscar agendamentos e devolver os dados puros
$resultado = mysqli_query($conexao, "SELECT * FROM agendamentos ORDER BY data_desejada ASC, id DESC");
$lista = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $lista[] = $row;
}

echo json_encode([
    'logado' => true,
    'agendamentos' => $lista
]);

mysqli_close($conexao);
?>