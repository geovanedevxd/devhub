<?php
// Configurações para o MySQL
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'devhub'; // Substitua pelo nome do seu banco de dados

// Cria a conexão
$conn = mysqli_connect($host, $username, $password, $database);

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// echo "Conexão realizada com sucesso!";
?>

