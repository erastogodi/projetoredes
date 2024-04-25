<?php
// Configurações de conexão com o banco de dados
$servername = "127.0.0.1"; // Ou o endereço do servidor MySQL
$username = "root"; // Seu nome de usuário do MySQL
$password = ""; // Sua senha do MySQL
$database = "redes"; // Nome do banco de dados que você deseja se conectar

// Criação da conexão
$conexao = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conexao->connect_error);
}  

?>
