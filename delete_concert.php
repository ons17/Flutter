<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id']) || empty($data['id'])) {
    echo json_encode(["message" => "Données manquantes"]);
    exit;
}

try {
    $pdo = new PDO('mysql:host=localhost;dbname=eventease', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("DELETE FROM concerts WHERE id = ?");
    $stmt->execute([$data['id']]);

    echo json_encode(["message" => "Concert supprimé avec succès"]);
} catch (PDOException $e) {
    echo json_encode(["message" => "Erreur lors de la suppression : " . $e->getMessage()]);
}
?>