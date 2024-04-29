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
            min-height: 100vh; /* Altura mínima da viewport */
            display: flex;
            flex-direction: column;
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
        .container {
            flex: 1; /* Ajusta a div container para ocupar todo o espaço disponível */
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 20px;
        }
        .form-container,
        .comodos-container {
            width: 45%;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            margin: 0 10px;
            box-sizing: border-box;
        }
        .form-container {
            border: 2px solid #333;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            float: left;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            clear: both;
            float: none;
            margin-top: 10px;
        }
        #comodos-inseridos h2 {
            margin-bottom: 10px;
        }
        #comodos-inseridos p {
            margin: 5px 0;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Inserir Cômodo</h1>
    </header>
    
    <nav>
        <a href="#">Inserir Cômodos</a> |
        <a href="#">Medições</a> |
        <a href="#">Mapa de Calor</a>
    </nav>

    <div class="container">
        <!-- Formulário para inserir o nome do cômodo e o nível de interferência -->
        <div class="form-container">
            <form id="inserir-comodo" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h2>Adicionar Cômodo</h2>
                <label for="nome-comodo">Nome do Cômodo:</label>
                <input type="text" id="nome-comodo" name="nome-comodo" required><br>
                <label for="nivel-interferencia">Nível de Interferência:</label>
                <input type="number" id="nivel-interferencia" name="nivel-interferencia" required><br>
                <label for="nivel-sinal-2-4GHz">Nível de Sinal (dBm) 2.4GHz:</label>
                <input type="text" id="nivel-sinal-2-4GHz" name="nivel-sinal-2-4GHz" required><br>
                <label for="nivel-sinal-5GHz">Nível de Sinal (dBm) 5GHz:</label>
                <input type="text" id="nivel-sinal-5GHz" name="nivel-sinal-5GHz" required><br>
                <label for="velocidade-2-4GHz">Velocidade (Mbps) 2.4GHz:</label>
                <input type="number" id="velocidade-2-4GHz" name="velocidade-2-4GHz" required><br>
                <label for="velocidade-5GHz">Velocidade (Mbps) 5GHz:</label>
                <input type="number" id="velocidade-5GHz" name="velocidade-5GHz" required><br>
                <input type="submit" name="submit" value="Cadastrar Cômodo">
            </form>
        </div>

        <!-- Seção dos cômodos inseridos -->
        <div class="comodos-container" id="comodos-inseridos">
            <?php
            include 'conexao.php';  // Inclua o arquivo de conexão com o banco de dados

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome-comodo']) && isset($_POST['nivel-interferencia'])) {
                $nomeComodo = mysqli_real_escape_string($conexao, $_POST['nome-comodo']);
                $nivelInterferencia = intval($_POST['nivel-interferencia']);
                $nivelSinal2_4GHz = floatval($_POST['nivel-sinal-2-4GHz']);
                $nivelSinal5GHz = floatval($_POST['nivel-sinal-5GHz']);
                $velocidade2_4GHz = intval($_POST['velocidade-2-4GHz']);
                $velocidade5GHz = intval($_POST['velocidade-5GHz']);

                // Verifique se já existe um cômodo com o mesmo nome no mesmo local_id
                $sqlVerificarComodo = "SELECT id FROM comodos WHERE nome = '$nomeComodo'";
                $resultadoVerificarComodo = $conexao->query($sqlVerificarComodo);
                if ($resultadoVerificarComodo->num_rows > 0) {
                    echo "Erro ao inserir cômodo: Já existe um cômodo com o mesmo nome neste local.";
                } else {
                    // Prepare a consulta SQL para inserir o cômodo
                    $stmt = $conexao->prepare("INSERT INTO comodos (nome, nivel_interferencia, nivel_sinal_2_4GHz, nivel_sinal_5GHz, velocidade_2_4GHz, velocidade_5GHz) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssddii", $nomeComodo, $nivelInterferencia, $nivelSinal2_4GHz, $nivelSinal5GHz, $velocidade2_4GHz, $velocidade5GHz);

                    if ($stmt->execute()) {
                        echo "Cômodo inserido com sucesso!";
                    } else {
                        echo "Erro ao inserir cômodo: " . $conexao->error;
                    }
                    $stmt->close();
                }
                $conexao->close();
            }

            // Exiba cômodos já inseridos
            include 'conexao.php';
            $sqlConsulta = "SELECT id, nome FROM comodos";
            $resultadoConsulta = $conexao->query($sqlConsulta);
            if ($resultadoConsulta->num_rows > 0) {
                echo "<h2>Cômodos Inseridos:</h2>";
                while ($row = $resultadoConsulta->fetch_assoc()) {
                    echo "<p>" . $row['nome'] . " 
                        <a href='edit.php?id=" . $row['id'] . "' class='editar-comodo'>Editar</a> 
                        <a href='deletar_comodo.php?id=" . $row['id'] . "' class='excluir-comodo'>Excluir</a>
                    </p>";
                }
            } else {
                echo "Nenhum cômodo foi inserido ainda.";
            }
            $conexao->close();
            ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Medição de Sinais de Rede</p>
    </footer>
</body>
</html>
