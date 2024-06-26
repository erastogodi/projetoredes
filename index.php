<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';



// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nomeLocal = $_POST['nome-local'];
    $tipoAmbiente = $_POST['tipo-ambiente'];

    // Construa a consulta SQL
    $sql = "INSERT INTO local (nome_local, tipo_ambiente) VALUES ('$nomeLocal', '$tipoAmbiente')";

    // Execute a consulta
    if ($conexao->query($sql) === TRUE) {
        // Redirecionar para a página SalvarComodo.php
        header("Location: SalvarComodo.php");
        exit(); // Certifique-se de sair após o redirecionamento
    } else {
        echo "Erro ao inserir dados: " . $conexao->error;
    }
    // Feche a conexão com o banco de dados
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medição de Sinais de Rede - Inserir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        nav {
            background-color: #f4f4f4;
            padding: 10px;
            text-align: center;
        }
        form {
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Cadastro de Ambiente</h1>
    </header>
    
    <nav>
        <a href="index.php">Inserir Cômodos</a> |
        <a href="relatorio.html">Relatório</a> |
        <a href="mapa.html">Mapa de Calor</a>
    </nav>

    <!-- Formulário para escolher o nome do local e o tipo de ambiente -->
    <form id="escolher-ambiente" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Escolher Nome do Local e Tipo de Ambiente</h2>
        <label for="nome-local">Nome do Local:</label>
        <input type="text" id="nome-local" name="nome-local"><br>
        <label for="tipo-ambiente">Tipo de Ambiente:</label>
        <select id="tipo-ambiente" name="tipo-ambiente">
            <option value="residencial">Residencial</option>
            <option value="comercial">Comercial</option>
        </select><br>
        <input type="submit" name="submit" value="Continuar">
    </form>

    <footer>
        <p>&copy; 2024 Medição de Sinais de Rede</p>
    </footer>
</body>
</html>
