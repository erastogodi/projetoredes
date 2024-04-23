<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "projetoredes";

$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Falha na conexão com o banco de dados: " . $mysqli->connect_error);
}
?>
