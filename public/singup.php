<?php
include('db_connect.php'); // Inclui a conexão com o banco

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Remova a criptografia

    // Verifica se o usuário já existe
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Usuário ou e-mail já cadastrados.";
    } else {
        // Insere o novo usuário
        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            header('Location: login.php'); // Redireciona para a página de login
            exit(); // Adiciona exit após o redirecionamento
        } else {
            echo "Erro ao cadastrar. Tente novamente.";
        }
    }
    $stmt->close();
}
$conn->close();
?>

