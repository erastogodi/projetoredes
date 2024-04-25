<?php
// Inclua o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupere os dados do formulário
    $nomeComodo = $_POST['nome-comodo'];
    $nivelInterferencia = $_POST['nivel-interferencia'];
    $localId = $_POST['local-id'];

    // Construa a consulta SQL para inserir o cômodo
    $sql = "INSERT INTO comodo_interferencia (local_id, nome_comodo, nivel_interferencia) 
            VALUES ('$localId', '$nomeComodo', '$nivelInterferencia')";

    // Execute a consulta
    if ($conexao->query($sql) === TRUE) {
        echo "Cômodo inserido com sucesso!";
    } else {
        echo "Erro ao inserir cômodo: " . $conexao->error;
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
    <title>Medição de Sinais de Rede - Salvar Cômodo</title>
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
        <h1>Inserir Cômodo</h1>
    </header>
    
    <nav>
        <a href="index.php">Inserir Cômodos</a> |
        <a href="relatorio.php">Relatório</a> |
        <a href="mapa.html">Mapa de Calor</a>
    </nav>

    <!-- Formulário para inserir o nome do cômodo e o nível de interferência -->
    <form id="inserir-comodo" action="salvar_comodo_processar.php" method="post">
        <h2>Adicionar Cômodo</h2>
        <label for="nome-comodo">Nome do Cômodo:</label>
        <input type="text" id="nome-comodo" name="nome-comodo" required><br>
        <label for="nivel-interferencia">Nível de Interferência:</label>
        <input type="number" id="nivel-interferencia" name="nivel-interferencia" required><br>
        <input type="hidden" name="local-id" value="<?php echo $ultimo_local_id; ?>">
        <input type="submit" name="submit" value="Cadastrar Cômodo">
    </form>

    <footer>
        <p>&copy; 2024 Medição de Sinais de Rede</p>
    </footer>
</body>
</html>
