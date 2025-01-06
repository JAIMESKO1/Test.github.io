
<?php
include 'config.php';

$auth_url = DISCORD_API . '/oauth2/authorize?client_id=' . CLIENT_ID .
            '&redirect_uri=' . urlencode(REDIRECT_URI) .
            '&response_type=code&scope=identify%20guilds.members.read';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Discord</title>
</head>
<body>
    <h1>Connexion via Discord</h1>
    <a href="<?= $auth_url; ?>">Se connecter avec Discord</a>
</body>
</html>

