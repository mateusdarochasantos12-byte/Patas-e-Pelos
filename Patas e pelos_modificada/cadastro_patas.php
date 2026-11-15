<?php
include 'agendamentos_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_completo = $_POST['nome_completo'] ?? '';
    $cpf = $_POST['CPF'] ?? '';
    $senha_desejada = $_POST['senha_desejada'] ?? '';
    $senha_criada = $_POST['senha_criada'] ?? '';
    $email = $_POST['Email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';

    $sql = "INSERT INTO cadastro_cliente (nome_completo, CPF, senha_desejada, senha_criada, Email, telefone) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexao, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $nome_completo, $cpf, $senha_desejada, $senha_criada, $email, $telefone);
        
        if (mysqli_stmt_execute($stmt)) {
            header("Location: login.html?cadastrado=1");
            exit();
        } else {
            echo "Erro ao cadastrar: " . mysqli_stmt_error($stmt);
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro na preparação: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
?>