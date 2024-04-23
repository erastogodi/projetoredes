<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Dados do Cômodo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Dados do Cômodo</h2>
        <?php
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM dados WHERE id = '$id'";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <label for="comodo">Cômodo:</label>
                    <input type="text" id="comodo" name="comodo" value="<?php echo $row['comodo']; ?>" required>
                    <label for="nivel_24ghz">Nível 2,4GHz:</label>
                    <input type="number" id="nivel_24ghz" name="nivel_24ghz" value="<?php echo $row['nivel_24ghz']; ?>" required>
                    <label for="nivel_5ghz">Nível 5GHz:</label>
                    <input type="number" id="nivel_5ghz" name="nivel_5ghz" value="<?php echo $row['nivel_5ghz']; ?>" required>
                    <label for="velocidade_24ghz">Velocidade 2,4GHz:</label>
                    <input type="number" id="velocidade_24ghz" name="velocidade_24ghz" value="<?php echo $row['velocidade_24ghz']; ?>" required>
                    <label for="velocidade_5ghz">Velocidade 5GHz:</label>
                    <input type="number" id="velocidade_5ghz" name="velocidade_5ghz" value="<?php echo $row['velocidade_5ghz']; ?>" required>
                    <label for="interferencia">Interferência:</label>
                    <input type="number" id="interferencia" name="interferencia" value="<?php echo $row['interferencia']; ?>" required>
                    <button type="submit">Salvar</button>
                </form>
                <?php
            } else {
                echo "Nenhum resultado encontrado.";
            }
        } else {
            echo "ID não especificado.";
        }
        ?>
    </div>
</body>
</html>
