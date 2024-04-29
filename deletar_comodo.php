<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM comodos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $stmt->close();
        $conexao->close();
        // Redirecionamento após a exclusão com sucesso
        header("Location: salvarcomodo.php?status=success");
        exit;
    } else {
        echo "Erro ao excluir cômodo: " . $conexao->error;
        $stmt->close();
    }
} else {
    echo "ID não especificado.";
}
$conexao->close();
?>
