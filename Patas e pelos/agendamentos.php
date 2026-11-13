<?php
include 'agendamentos_db.php';

// Lógica para desfazer/excluir agendamento
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $stmt = mysqli_prepare($conexao, "DELETE FROM agendamentos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: agendamentos.php?removido=1");
    exit();
}

$resultado = mysqli_query($conexao, "SELECT * FROM agendamentos ORDER BY data_desejada ASC, id DESC");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Patas & Pelos</title>
    <link rel="stylesheet" href="agendamentos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <img src="img80.jpg" id="top" alt="Patas e Pelos">
        <nav class="nav">
            <ul class="nav-list">
                <li><a href="Index.html">Home</a></li>
                <li><a href="condições.html">Novo Agendamento</a></li>
                <li><a href="agendamentos.php">Agendamentos</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="container-agendamentos">
        <h1>Agendamentos Registrados</h1>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="alerta sucesso">Agendamento confirmado com sucesso!</div>
        <?php endif; ?>

        <?php if (isset($_GET['removido'])): ?>
            <div class="alerta removido">Agendamento desfeito com sucesso.</div>
        <?php endif; ?>

        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <div class="tabela-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Tutor</th>
                            <th>Telefone</th>
                            <th>Pet</th>
                            <th>Raça</th>
                            <th>Serviço</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nome_tutor']) ?></td>
                                <td><?= htmlspecialchars($row['telefone']) ?></td>
                                <td><?= htmlspecialchars($row['nome_pet']) ?></td>
                                <td><?= htmlspecialchars($row['raca_pet']) ?></td>
                                <td><?= htmlspecialchars($row['servico']) ?></td>
                                <td><?= date('d/m/Y', strtotime($row['data_desejada'])) ?></td>
                                <td>
                                    <a href="agendamentos.php?excluir=<?= $row['id'] ?>" 
                                       class="btn-desfazer" 
                                       onclick="return confirm('Deseja realmente desfazer este agendamento?');">
                                       Desfazer
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="vazio">Nenhum agendamento registrado no momento.</p>
        <?php endif; ?>
    </main>

    <footer>
        <br>
        <h6>(31) 98378-5687</h6>
        <br>
        <h6>Av. A, 304 - Liberdade, Ribeirão das Neves - MG, 33822-700</h6>
        <br>
        <h6>Direitos reservados ©- v0.70.1</h6>
    </footer>
</body>
</html>
<?php mysqli_close($conexao); ?>