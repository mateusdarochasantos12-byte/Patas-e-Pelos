<?php
include 'agendamentos_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_tutor = trim($_POST['nome-tutor'] ?? '');
    $telefone = trim($_POST['telefone-responsavel'] ?? '');
    $nome_pet = trim($_POST['nome-pet'] ?? '');
    $raca_pet = trim($_POST['raca_pet'] ?? ''); // <--- Captura a raça
    $servico = trim($_POST['serviço'] ?? '');
    $data_desejada = trim($_POST['data-desejada'] ?? '');

    if (!empty($nome_tutor) && !empty($nome_pet) && !empty($raca_pet) && !empty($servico) && !empty($data_desejada)) {
        // Atualizado com a coluna raca_pet
        $stmt = mysqli_prepare($conexao, "INSERT INTO agendamentos (nome_tutor, telefone, nome_pet, raca_pet, servico, data_desejada) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssss", $nome_tutor, $telefone, $nome_pet, $raca_pet, $servico, $data_desejada);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: agendamentos.html?sucesso=1");
        exit();
    } else {
        echo "<script>
            alert('Por favor, preencha todos os campos obrigatórios!');
            window.location.href = 'condições.html';
        </script>";
    }
}
mysqli_close($conexao);
?>