<?php include 'conexao.php';

if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $comodo = $_POST['comodo'];
    $nivel_24ghz = $_POST['nivel_24ghz'];
    $nivel_5ghz = $_POST['nivel_5ghz'];
    $velocidade_24ghz = $_POST['velocidade_24ghz'];
    $velocidade_5ghz = $_POST['velocidade_5ghz'];
    $interferencia = $_POST['interferencia'];

    $sql = "UPDATE dados SET comodo='$comodo', nivel_24ghz='$nivel_24ghz', nivel_5ghz='$nivel_5ghz', velocidade_24ghz='$velocidade_24ghz', velocidade_5ghz='$velocidade_5ghz', interferencia='$interferencia' WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        echo "<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Atualizar Dados do Cômodo</title>
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

        p.success {
            margin-top: 20px;
            color: #008000; /* Verde */
        }

        a {
            color: #4CAF50; /* Verde */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Atualizar Dados do Cômodo</h2>
        <p class='success'>Dados atualizados com sucesso!</p>
        <p><a href='index.php'>Voltar para a página inicial</a></p>
    </div>
</body>
</html>";
    } else {
        echo "Erro ao atualizar os dados: " . $mysqli->error;
    }
} else {
    echo "ID não especificado.";
}
?>
