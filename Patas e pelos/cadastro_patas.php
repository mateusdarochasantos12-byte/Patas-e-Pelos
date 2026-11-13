<?php
$servidor = "localhost";
$usuario = "root";
$senha_bd = "";
$banco = "patas_and_pelos";


$cadastro_cliente = mysqli_connect ($servidor, $usuario, $senha_bd, $banco);

if (!$cadastro_cliente) {
    die("Erro de conexão: " . mysqli_connect_error());
}


$nome = $_POST['nome_completo'];
$CPF = $_POST['CPF'];
$senha_desejada = $_POST['senha_desejada'];
$senha_criada = $_POST['senha_criada'];
$Email = $_POST['Email'];
$telefone = $_POST['telefone'];


$sql = "INSERT INTO cadastro_cliente (nome_completo , CPF, senha_desejada ,senha_criada,Email, telefone )
VALUES ('$nome', '$CPF', '$senha_desejada','$senha_criada','$Email','$telefone')";

if(mysqli_query($cadastro_cliente, $sql)) {
    echo "<h3> Aluno cadastrado com sucesso!</h3>";
    echo "<a href='Index.html'>Voltar</a>";
} else {
    echo "Erro ao cadstrar: " . mysqli_error($cadastro_cliente);
}


mysqli_close($cadastro_cliente);

?>