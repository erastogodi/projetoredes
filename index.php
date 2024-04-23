<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Dados de Cômodos</title>
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

        .table-container {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Dados dos Cômodos</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>Cômodo</th>
                    <th>Nível 2,4GHz</th>
                    <th>Nível 5GHz</th>
                    <th>Velocidade 2,4GHz</th>
                    <th>Velocidade 5GHz</th>
                    <th>Interferência</th>
                    <th>Ações</th>
                </tr>
                <?php
                $sql = "SELECT * FROM dados";
                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["comodo"]."</td>";
                        echo "<td>".$row["nivel_24ghz"]."</td>";
                        echo "<td>".$row["nivel_5ghz"]."</td>";
                        echo "<td>".$row["velocidade_24ghz"]."</td>";
                        echo "<td>".$row["velocidade_5ghz"]."</td>";
                        echo "<td>".$row["interferencia"]."</td>";
                        echo "<td><a href='edit.php?id=".$row["id"]."'>Editar</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>0 resultados</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
