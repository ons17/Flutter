<?php
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['username']) && isset($data['password']) && isset($data['email'])) {
    $username = $data['username'];
    $password = $data['password'];
    $email = $data['email'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=eventease', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt->execute([$username, $password, $email]);

        echo json_encode(["message" => "Inscription réussie"]);
    } catch (PDOException $e) {
        echo json_encode(["message" => "Erreur lors de l'inscription: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "Données manquantes"]);
}
?>