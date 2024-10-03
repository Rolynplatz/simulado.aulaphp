<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "Rolyn";
$password = "Minamino13";
$dbname = "Escola";
$port = 3307;

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificando se o ID do aluno foi fornecido
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Obtendo os dados atuais do aluno
    $selectQuery = "SELECT * FROM alunos WHERE id = $id";
    $result = $conn->query($selectQuery);

    if ($result->num_rows > 0) {
        $aluno = $result->fetch_assoc();
    } else {
        echo "Aluno não encontrado.";
        exit();
    }
} else {
    echo "ID do aluno não foi fornecido.";
    exit();
}

// Fechando a conexão
$conn->close();
?>

<!-- Formulário HTML para editar o aluno -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
</head>
<body>
    <h2>Editar Aluno</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $aluno['id']; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>"><br>
        Idade: <input type="number" name="idade" value="<?php echo $aluno['idade']; ?>"><br>
        Email: <input type="email" name="email" value="<?php echo $aluno['email']; ?>"><br>
        <input type="submit" value="Atualizar">
    </form>
    
</body>
<style>
<style>
</html>