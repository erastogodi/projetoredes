<?php
// Inicializa variáveis para armazenar mensagens de erro ou sucesso
$mensagem_erro = $mensagem_sucesso = '';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo 'tipo-ambiente' está definido no array $_POST
    if (isset($_POST['tipo-ambiente'])) {
        // Obtém o valor do tipo de ambiente do array $_POST
        $tipo_ambiente = $_POST['tipo-ambiente'];
        
        // Adicione este valor à sua consulta SQL

        // Inclua o arquivo de conexão
        include 'conexao.php';

        // Verifica se os campos do formulário foram definidos
        if(isset($_POST['nome-comodo']) && isset($_POST['nivel-interferencia']) && isset($_POST['tipo-comodo'])){
            // Obtém os dados do formulário
            $nome_comodo = $_POST['nome-comodo'];
            $nivel_interferencia = $_POST['nivel-interferencia'];
            $tipo_comodo = $_POST['tipo-comodo']; 

            // Query para inserir os dados no banco de dados
            $sql = "INSERT INTO comodos (nome, nivel_interferencia, tipo_ambiente) VALUES ('$nome_comodo', '$nivel_interferencia', '$tipo_comodo')";

            // Executa a query
            $resultado = mysqli_query($conexao, $sql);

            if ($resultado) {
                // Define a mensagem de sucesso
                $mensagem_sucesso = 'Cômodo adicionado com sucesso!';
            } else {
                // Define a mensagem de erro
                $mensagem_erro = 'Erro ao adicionar cômodo: ' . mysqli_error($conexao);
            }

            // Fecha a conexão com o banco de dados
            mysqli_close($conexao);
        } else {
            $mensagem_erro = "Por favor, preencha todos os campos do formulário.";
        }
    } else {
        // Se o campo 'tipo-ambiente' não estiver definido no array $_POST, exibe uma mensagem de erro
        $mensagem_erro = "O campo 'tipo-ambiente' não foi enviado pelo formulário.";
    }
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
            background-color: #f4f4f4;
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
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
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
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .mensagem-erro,
        .mensagem-sucesso {
            margin-top: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .mensagem-erro {
            background-color: #ffcccc;
            color: #cc0000;
        }
        .mensagem-sucesso {
            background-color: #ccffcc;
            color: #006600;
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
        <h1>Inserir Cômodos e Móveis</h1>
    </header>
    
    <nav>
        <a href="index.html">Inserir Cômodos</a> |
        <a href="relatorio.html">Relatório</a> |
        <a href="mapa.html">Mapa de Calor</a>
    </nav>

    <!-- Exibe mensagens de erro ou sucesso -->
    <?php if (!empty($mensagem_erro)): ?>
        <div class="mensagem-erro"><?php echo $mensagem_erro; ?></div>
    <?php elseif (!empty($mensagem_sucesso)): ?>
        <div class="mensagem-sucesso"><?php echo $mensagem_sucesso; ?></div>
    <?php endif; ?>

    <!-- Formulário para inserir cômodos -->
    <form id="inserir-comodo" method="post">
        <h2>Inserir Cômodo</h2>
        <label for="nome-comodo">Nome do Cômodo:</label>
        <input type="text" id="nome-comodo" name="nome-comodo" required>
        <label for="nivel-interferencia">Nível de Interferência:</label>
        <select id="nivel-interferencia" name="nivel-interferencia">
            <option value="baixo">Baixo</option>
            <option value="médio">Médio</option>
            <option value="alto">Alto</option>
        </select>
        <!-- Adicionando campo oculto para armazenar o tipo de ambiente -->
        <input type="hidden" name="tipo-ambiente" value="<?php echo isset($tipo_ambiente) ? $tipo_ambiente : ''; ?>">
        <label for="tipo-comodo">Tipo de Ambiente:</label>
        <select id="tipo-comodo" name="tipo-comodo">
            <!-- Aqui você pode adicionar opções dinamicamente, se necessário -->
        </select>
        <input type="submit" value="Adicionar Cômodo">
    </form>

    <footer>
        <p>&copy; 2024 Medição de Sinais de Rede</p>
    </footer>
</body>
</html>
