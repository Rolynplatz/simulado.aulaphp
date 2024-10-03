<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "Rolyn";
$password = "Minamino13";
$dbname = "Escola";
$port= 3307;

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificando se o ID do aluno foi fornecido
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Excluindo o aluno do banco de dados
    $deleteQuery = "DELETE FROM alunos WHERE id = $id";
    if ($conn->query($deleteQuery) === TRUE) {
        header("Location:cadastro.php"); // Redireciona com mensagem de sucesso
        exit();
    } else {
        header("Location:cadastro.php"); // Redireciona com mensagem de erro
        exit();
    }
} else {
    header("Location:cadastro.php" ); // Redireciona se não houver ID
    exit();
}

// Fechando a conexão
$conn->close();
?>