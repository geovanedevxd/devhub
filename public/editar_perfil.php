<?php
include('db_connect.php'); // Inclui a conexão com o banco de dados

// ID do usuário fixo
$user_id = 1;

// Buscar informações do usuário no banco de dados
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
} else {
    die("Erro ao buscar informações do usuário.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - DevHub</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Editar Perfil</h1>
        <form action="atualizar_perfil.php" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite seu Nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio" required><?php echo htmlspecialchars($user['bio']); ?></textarea>

            <label for="projeto_atual">Projeto Atual:</label>
            <input type="text" id="projeto_atual" placeholder="Digite aqui seu projeto atual" name="projeto_atual" value="<?php echo htmlspecialchars($user['projeto_atual']); ?>" required>

            <label for="foto_perfil">Foto de Perfil:</label>
            <input type="file" id="foto_perfil" name="foto_perfil">

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>

</html>







