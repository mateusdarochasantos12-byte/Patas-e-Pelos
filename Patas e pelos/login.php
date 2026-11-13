
<?php

session_start();

// 1. Dados de conexão com o banco
$servidor = "localhost";
$usuario = "root";
$senha_bd = "";
$banco = "patas_and_pelos";

// 2. Conectando ao banco
$conexao = mysqli_connect($servidor, $usuario, $senha_bd, $banco);

if (!$conexao) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// 3. Recebendo os dados do formulário
$nome = trim($_POST['nome'] ?? '');
$CPF = trim($_POST['CPF'] ?? '');
$senha = $_POST['senha'] ?? '';

// 4. Verificando se os campos foram preenchidos
if (empty($nome) || empty($CPF) || empty($senha)) {
    die("Preencha todos os campos!");
}

// 5. Consultando o banco de dados
$sql = "SELECT * FROM cadastro_cliente
        WHERE nome_completo = ?
        AND CPF = ?
        AND senha_criada = ?";

$stmt = mysqli_prepare($conexao, $sql);

mysqli_stmt_bind_param($stmt, "sss", $nome, $CPF, $senha);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

// 6. Verificando se encontrou o cliente
if (mysqli_num_rows($resultado) > 0) {

    // Login realizado
    $_SESSION['nome'] = $nome;
    $_SESSION['CPF'] = $CPF;

    header("Location: Index.html");
    exit();

} else {

    echo "<script>
        alert('Nome, CPF ou senha incorretos!');
        window.location.href = 'login.html';
    </script>";

}

// 7. Encerrando a conexão
mysqli_stmt_close($stmt);
mysqli_close($conexao);

?>
