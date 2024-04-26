<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome_comodo'])) {
    $nomeComodo = mysqli_real_escape_string($conexao, $_POST['nome_comodo']);

    $sqlExcluirComodo = "DELETE FROM comodos WHERE nome = '$nomeComodo'";
    if ($conexao->query($sqlExcluirComodo)) {
        echo "Cômodo '$nomeComodo' excluído com sucesso!";
    } else {
        echo "Erro ao excluir cômodo: " . $conexao->error;
    }
} else {
    echo "Nome do cômodo não recebido.";
}

$conexao->close();
?>
