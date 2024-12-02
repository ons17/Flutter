<?php
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username']) && isset($data['password'])) {
    $username = $data['username'];
    $password = $data['password'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=eventease', 'root', password: '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password == $user['password']) {
                echo json_encode(["message" => "Connexion réussie"]);
            } else {
                echo json_encode(["message" => "Nom d'utilisateur ou mot de passe incorrect"]);
            }
        } else {
            echo json_encode(["message" => "Nom d'utilisateur ou mot de passe incorrect"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["message" => "Erreur lors de la connexion: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "Données manquantes"]);
}
?>