<?php
// Configurações de conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'devhub');

// Verificação de conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificação do método HTTP
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $projeto_atual = $_POST['projeto_atual'];

    // Gerenciar upload de foto de perfil, se houver
    $foto_destino = NULL;
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
        $foto_nome = basename($_FILES['foto_perfil']['name']);
        $foto_temp = $_FILES['foto_perfil']['tmp_name'];
        $foto_destino = '' . $foto_nome; // Certifique-se de que a pasta 'uploads' exista
        if (!move_uploaded_file($foto_temp, $foto_destino)) {
            die("Erro ao mover o arquivo enviado.");
        }
    }

    // Atualizar informações no banco de dados
    $sql = "UPDATE users SET nome=?, email=?, bio=?, projeto_atual=?";
    $params = [$nome, $email, $bio, $projeto_atual];

    if ($foto_destino) {
        $sql .= ", foto_perfil=?";
        $params[] = $foto_destino;
    }
    $sql .= " WHERE id=?";
    $params[] = 1; // ID do usuário fixo

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $types = str_repeat('s', count($params));
    $stmt->bind_param($types, ...$params);

    // Processar a atualização do perfil
    if ($stmt->execute()) {
        // Redirecionar automaticamente após 2 segundos
        echo "<meta http-equiv='refresh' content='2;url=perfil.php'>";
    } else {
        echo "Erro ao atualizar perfil: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método HTTP não permitido.";
}

$conn->close();
?>
