
<?php
session_start();
include('db_connect.php'); // Inclui a conexão com o banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Remova a criptografia

    // Preparar a consulta para verificar se o usuário existe e se a senha está correta
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php'); // Redireciona para o dashboard
        exit(); // Adiciona exit após o redirecionamento
    } else {
        echo "Nome de usuário ou senha incorretos.";
    }

    $stmt->close();
}
$conn->close();
?>
