<?php
include 'conexao.php';

// Verifica se o método POST foi usado e se os campos necessários estão presentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome_comodo_atual']) && isset($_POST['novo_nome_comodo'])) {
    $nomeComodoAtual = $_POST['nome_comodo_atual'];
    $novoNomeComodo = $_POST['novo_nome_comodo'];

    // Preparando a consulta para evitar SQL injection
    $stmt = $conexao->prepare("UPDATE comodos SET nome = ? WHERE nome = ?");
    if ($stmt) {
        // Vinculando parâmetros para marcadores
        $stmt->bind_param("ss", $novoNomeComodo, $nomeComodoAtual);

        // Executando a consulta
        if ($stmt->execute()) {
            echo "Cômodo atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar cômodo: " . $stmt->error;
        }

        // Fechando o statement
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conexao->error;
    }

    // Fechando a conexão
    $conexao->close();
} else {
    echo "Todos os dados necessários não foram enviados.";
}
?>
