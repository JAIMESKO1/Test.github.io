

<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>
<body>
    <h1>Bienvenue, <?= htmlspecialchars($user['username']); ?>!</h1>
    <img src="<?= htmlspecialchars($user['avatar'] ? "https://cdn.discordapp.com/avatars/{$user['id']}/{$user['avatar']}.png" : 'https://cdn.discordapp.com/embed/avatars/0.png'); ?>" alt="Avatar">
    <p>ID Utilisateur : <?= htmlspecialchars($user['id']); ?></p>
    <p>Nom d'utilisateur : <?= htmlspecialchars($user['username']); ?>#<?= htmlspecialchars($user['discriminator']); ?></p>
</body>
</html>
