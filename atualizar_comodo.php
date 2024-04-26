<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome_comodo_atual']) && isset($_POST['novo_nome_comodo'])) {
    $nomeComodoAtual = mysqli_real_escape_string($conexao, $_POST['nome_comodo_atual']);
    $novoNomeComodo = mysqli_real_escape_string($conexao, $_POST['novo_nome_comodo']);

    $sqlAtualizarComodo = "UPDATE comodos SET nome = '$novoNomeComodo' WHERE nome = '$nomeComodoAtual'";
    if ($conexao->query($sqlAtualizarComodo)) {
        echo "Cômodo atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar cômodo: " . $conexao->error;
    }
}

$conexao->close();
?>
