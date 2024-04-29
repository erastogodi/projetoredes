<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nomeComodo = mysqli_real_escape_string($conexao, $_POST['nome-comodo']);
    $nivelInterferencia = intval($_POST['nivel-interferencia']);
    $nivelSinal2_4GHz = floatval($_POST['nivel-sinal-2-4GHz']);
    $nivelSinal5GHz = floatval($_POST['nivel-sinal-5GHz']);
    $velocidade2_4GHz = intval($_POST['velocidade-2-4GHz']);
    $velocidade5GHz = intval($_POST['velocidade-5GHz']);

    $sql = "UPDATE comodos SET 
                nome = ?, 
                nivel_interferencia = ?, 
                nivel_sinal_2_4GHz = ?, 
                nivel_sinal_5GHz = ?, 
                velocidade_2_4GHz = ?, 
                velocidade_5GHz = ? 
            WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("siddiii", 
        $nomeComodo, 
        $nivelInterferencia, 
        $nivelSinal2_4GHz, 
        $nivelSinal5GHz, 
        $velocidade2_4GHz, 
        $velocidade5GHz, 
        $id);

    if ($stmt->execute()) {
        echo "Cômodo atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar cômodo: " . $conexao->error;
    }
    $stmt->close();
    $conexao->close();
} else {
    echo "Informações necessárias não fornecidas.";
}
?>
