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

// Adicionar a conexão no banco de dados
if (isset($_POST['add_contact'])) {
    $contact_id = $_POST['contact_id'];
    $add_contact_query = "INSERT INTO contacts (user_id, contact_id) VALUES (?, ?)";
    $stmt = $conn->prepare($add_contact_query);
    $stmt->bind_param("ii", $user_id, $contact_id);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - DevHub</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="headerperfil">
        <h1>Perfil</h1>
        <a href="feed.html" class="voltar">Voltar ao Feed</a>
    </header>

    <!-- Menu de Navegação -->
    <nav>
        <ul class="nav-menu">
            <li><a href="#perfil">Perfil</a></li>
            <li><a href="#amigos">Sugestões de Amigos</a></li>
            <li><a href="#mensagens">Mensagens Diretas</a></li>
            <li><a href="#configuracoes">Configurações</a></li>
        </ul>
    </nav>

    <div id="perfil-info" class="perfil-container">
        <img src="<?php echo $user['foto_perfil']; ?>" class="fotoperfil" alt="Foto do Perfil">
        <h2><?php echo htmlspecialchars($user['nome']); ?></h2>
        <p>Trabalhando atualmente em: <strong><?php echo htmlspecialchars($user['projeto_atual']); ?></strong></p>
        <p>Bio: <?php echo htmlspecialchars($user['bio']); ?></p>

        <!-- Verifique se é o próprio perfil -->
        <?php if ($user_id != 1) { ?>
            <form method="POST">
                <input type="hidden" name="contact_id" value="<?php echo $user['id']; ?>">
                <button type="submit" name="add_contact" id="addFriend">Adicionar como Amigo</button><br>
            </form>
        <?php } ?>

        <h3>Seguidores: 120 | Seguindo: 150</h3>
        <p>Projetos Anteriores:</p>
        <ul id="project-list">
            <!-- Projetos serão carregados aqui -->
        </ul>
        <br>
        <h3>Publicações Recentes</h3>
        <div id="user-posts">
            <?php
            $posts_query = "SELECT * FROM posts WHERE user_id = ? ORDER BY timestamp DESC";
            $stmt = $conn->prepare($posts_query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $posts_result = $stmt->get_result();
            if ($posts_result->num_rows > 0) {
                while ($post = $posts_result->fetch_assoc()) {
                    echo "<div class='post'>";
                    echo "<p>" . htmlspecialchars($post['content']) . "</p>";
                    echo "<span class='timestamp'>" . $post['timestamp'] . "</span>";
                    echo "</div>";
                }
            } else {
                echo "Ainda não fez nenhuma publicação.<br><br>";
            }
            ?>
        </div>

        <h3>Criar Nova Postagem</h3>
        <form action="criar_post.php" method="POST">
            <textarea name="post_content" placeholder="Escreva sua postagem aqui" required></textarea>
            <button type="submit">Postar</button>
        </form><br><br>
        <button id="editPerfil" onclick="window.location.href='editar_perfil.php'">Editar Perfil</button>
    </div>

    <div id="amigos" class="suggestions">
        <h3>Sugestões de Amigos (Será implementado na 2.0)</h3>
        <ul>
            <?php
            $suggestions_query = "SELECT * FROM users WHERE id != ? ORDER BY RAND() LIMIT 5";
            $stmt = $conn->prepare($suggestions_query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $suggestions_result = $stmt->get_result();
            while ($suggestion = $suggestions_result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($suggestion['nome']) . " <button>Adicionar como Amigo</button></li>";
            }
            ?>
        </ul>
    </div>

</body>

</html>

