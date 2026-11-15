<?php
$servidor = "localhost";
$usuario = "root";
$senha_bd = "";
$banco = "patas_and_pelos";

$conexao = mysqli_connect($servidor, $usuario, $senha_bd, $banco);

if (!$conexao) {
    die("Erro de conexão: " . mysqli_connect_error());
}

$sql_tabela = "CREATE TABLE IF NOT EXISTS agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_tutor VARCHAR(100) NOT NULL,
    telefone VARCHAR(30) NOT NULL,
    nome_pet VARCHAR(50) NOT NULL,
    servico VARCHAR(100) NOT NULL,
    data_desejada DATE NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

mysqli_query($conexao, $sql_tabela);
?>