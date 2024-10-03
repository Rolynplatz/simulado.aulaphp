<?php
// feito 9:13

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

// Inicializando a variável de pesquisa
$searchTerm = '';

// Verificando se há uma mensagem de status na URL
$statusMessage = '';
if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
            $statusMessage = "<p class='success'>Aluno cadastrado com sucesso!</p>";
            break;
        case 'error':
            $statusMessage = "<p class='error'>Ocorreu um erro. Tente novamente.</p>";
            break;
    }
}

// Processar o cadastro de um novo aluno
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastro'])) {
    // Coletando os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $idade = (int)$_POST['idade']; // Convertendo para inteiro
    $email = $conn->real_escape_string($_POST['email']);
    $curso = $conn->real_escape_string($_POST['curso']);

    // Inserindo o aluno no banco de dados
    $insertQuery = "INSERT INTO alunos (nome, idade, email, curso) VALUES ('$nome', $idade, '$email', '$curso')";
    if ($conn->query($insertQuery) === TRUE) {
        header("Location: index.php?status=success"); // Redireciona com mensagem de sucesso
        exit();
    } else {
        header("Location: index.php?status=error"); // Redireciona com mensagem de erro
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" href="style.css"> <!-- Link para o arquivo CSS -->
</head>
<body>
    <div class="container">
        <h2>Cadastro de Aluno</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="curso">Curso:</label>
                <input type="text" id="curso" name="curso" required>
            </div>
            <div class="form-group">
                <label for="idade">Idade:</label>
                <input type="number" id="idade" name="idade" required>
            </div>
            <button type="submit" name="cadastro">Cadastrar</button>
        </form>

        <?php echo $statusMessage; // Exibir mensagem de status ?>

        <h2><a href="cadastro.php">Lista de Alunos Cadastrados</a></h2>
    </div>
</body>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Estilos do corpo da página */
body {
    font-family: Arial, sans-serif;
    background-color: #000000; /* Cor de fundo unificada */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 20px;
    height: 100vh; /* Altura total da viewport */
}

/* Estilo para títulos secundários */
h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333; /* Cor do texto para melhor legibilidade */
}

/* ========================================================================
   CONTAINERS
   ======================================================================== */

/* Estilos comuns para containers de formulário e tabela */
.form-container,
.table-container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    margin-bottom: 30px;
}

/* Especificação de largura para container de formulário, se necessário */
.form-container {
    width: 400px; /* Ajuste conforme necessário */
}

/* ========================================================================
   FORMULÁRIO
   ======================================================================== */

/* Grupo de elementos dentro do formulário */
.form-group {
    margin-bottom: 15px;
}

/* Rótulos dos campos do formulário */
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555; /* Cor do texto do rótulo */
}

/* Campos de entrada de texto, número e email */
input[type="text"],
input[type="number"],
input[type="email"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

/* Foco nos campos de entrada para melhor usabilidade */
input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus {
    border-color: #e90080;
    outline: none;
}

/* Botão de envio do formulário */
input[type="submit"] {
    background-color: #d30f71; /* Cor principal do botão */
    color: white;
    border: none;
    padding: 15px 20px;
    cursor: pointer;
    border-radius: 5px;
    width: 100%;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

/* Efeitos de interação no botão de envio */
input[type="submit"]:hover {
    background-color: #d10c3d; /* Efeito de hover */
}

input[type="submit"]:active {
    background-color: #bb0e5f; /* Efeito ao clicar no botão */
}

/* ========================================================================
   TABELA
   ======================================================================== */

/* Estilo básico da tabela */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

/* Bordas da tabela, cabeçalhos e células */
table, th, td {
    border: 1px solid #ddd;
}

/* Padding e alinhamento das células */
th, td {
    padding: 12px;
    text-align: left;
}

/* Estilo dos cabeçalhos da tabela */
th {
    background-color: #007bff; /* Cor de fundo dos cabeçalhos */
    color: white;
}

/* Listras nas linhas da tabela para melhor legibilidade */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Efeito de hover nas linhas da tabela */
tr:hover {
    background-color: #ddd;
}

/* ========================================================================
   LINKS DE AÇÃO (Exclusão)
   ======================================================================== */

/* Estilo para links de exclusão */
a.excluir {
    color: #dc3545;
    font-weight: bold;
    text-decoration: none;
    border: 1px solid #dc3545;
    padding: 8px 12px;
    border-radius: 5px;
    transition: all 0.3s ease;
}

/* Efeitos de interação nos links de exclusão */
a.excluir:hover {
    background-color: #dc3545;
    color: white; /* Texto branco no hover */
    border-color: #c82333; /* Borda ligeiramente mais escura */
}

a.excluir:active {
    background-color: #bd2130; /* Cor ao clicar */
    border-color: #a71d2a;
}

/* ========================================================================
   MENSAGENS DE NOTIFICAÇÃO
   ======================================================================== */

/* Estilos comuns para mensagens */
.mensagem {
    width: 80%;
    margin: 20px auto;
    padding: 15px;
    border-radius: 5px;
    text-align: center;
    font-weight: bold;
}

/* Mensagem de sucesso */
.sucesso {
    background-color: #d4edda;
    color: #155724; /* Cor de texto mais escura para melhor contraste */
    border: 1px solid #c3e6cb;
}

/* Mensagem de erro */
.erro {
    background-color: #f8d7da;
    color: #721c24; /* Cor de texto mais escura para melhor contraste */
    border: 1px solid #f5c6cb;
}

/* Definindo estilo geral */
body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

/* Container do formulário */
.form-container {
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 400px;
  padding: 20px;
}

/* Cabeçalho */
.form-container h2 {
  text-align: center;
  color: #333;
}

/* Inputs de texto e senha */
input[type="text"],
input[type="password"],
input[type="email"] {
  width: 100%;
  padding: 12px 15px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-sizing: border-box;
}

/* Botão de cadastro */
button[type="submit"] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

button[type="submit"]:hover {
  background-color: #45a049;
}

/* Links para login ou recuperação de senha */
.form-container a {
  text-decoration: none;
  color: #4CAF50;
}

.form-container a:hover {
  color: #2e7d32;
}

</html>

<?php
// Fechando a conexão
$conn->close();
?>