<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cômodo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh; /* Altura mínima da viewport */
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        .form-container {
            width: 50%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 10px 0;
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
        <h1>Editar Cômodo</h1>
    </header>
    
    <div class="container">
        <div class="form-container">
            <?php
            include 'conexao.php';

            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);

                $sql = "SELECT * FROM comodos WHERE id = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    ?>
                    <form action="update.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <label for="nome-comodo">Nome do Cômodo:</label>
                        <input type="text" id="nome-comodo" name="nome-comodo" value="<?php echo $row['nome']; ?>" required><br>
                        <label for="nivel-interferencia">Nível de Interferência:</label>
                        <input type="number" id="nivel-interferencia" name="nivel-interferencia" value="<?php echo $row['nivel_interferencia']; ?>" required><br>
                        <label for="nivel-sinal-2-4GHz">Nível de Sinal 2.4GHz:</label>
                        <input type="text" id="nivel-sinal-2-4GHz" name="nivel-sinal-2-4GHz" value="<?php echo $row['nivel_sinal_2_4GHz']; ?>" required><br>
                        <label for="nivel-sinal-5GHz">Nível de Sinal 5GHz:</label>
                        <input type="text" id="nivel-sinal-5GHz" name="nivel-sinal-5GHz" value="<?php echo $row['nivel_sinal_5GHz']; ?>" required><br>
                        <label for="velocidade-2-4GHz">Velocidade 2.4GHz:</label>
                        <input type="number" id="velocidade-2-4GHz" name="velocidade-2-4GHz" value="<?php echo $row['velocidade_2_4GHz']; ?>" required><br>
                        <label for="velocidade-5GHz">Velocidade 5GHz:</label>
                        <input type="number" id="velocidade-5GHz" name="velocidade-5GHz" value="<?php echo $row['velocidade_5GHz']; ?>" required><br>
                        <input type="submit" value="Atualizar Cômodo">
                    </form>
                    <?php
                } else {
                    echo "Nenhum cômodo encontrado para o ID fornecido.";
                }
                $stmt->close();
            } else {
                echo "ID não especificado.";
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
