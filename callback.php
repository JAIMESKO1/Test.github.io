

<?php
include 'config.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Échanger le code contre un token d'accès
    $token_url = DISCORD_API . '/oauth2/token';
    $data = [
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => REDIRECT_URI,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $token_url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $tokens = json_decode($response, true);

    if (isset($tokens['access_token'])) {
        $access_token = $tokens['access_token'];

        // Récupérer les informations utilisateur
        $user_url = DISCORD_API . '/users/@me';
        $headers = [
            'Authorization: Bearer ' . $access_token,
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $user_url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
        ]);

        $user_response = curl_exec($curl);
        curl_close($curl);

        $user_data = json_decode($user_response, true);

        // Stocker les données en session
        session_start();
        $_SESSION['user'] = $user_data;

        header('Location: profile.php');
        exit();
    } else {
        echo "Erreur lors de l'authentification.";
    }
} else {
    echo "Aucun code de redirection fourni.";
}
?>

