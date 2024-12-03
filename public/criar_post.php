<?php
include('db_connect.php'); // Inclui a conexão com o banco de dados

// Verificação do método HTTP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter dados do formulário
    $user_id = 1; // ID do usuário fixo
    $post_content = $_POST['post_content'];

    // Inserir a nova postagem no banco de dados
    $query = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param("is", $user_id, $post_content);

    if ($stmt->execute()) {
        echo "Postagem criada com sucesso!";
        // Redirecionar para a página de perfil após a postagem
        header("Location: perfil.php");
    } else {
        echo "Erro ao criar postagem: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método HTTP não permitido.";
}

$conn->close();
?>
