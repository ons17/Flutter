<?php
$data = json_decode(file_get_contents("php://input"), true);

if (
    isset($data['id']) &&
    isset($data['title']) &&
    isset($data['artist']) &&
    isset($data['date']) &&
    isset($data['time']) &&
    isset($data['location']) &&
    isset($data['genre']) &&
    isset($data['description']) &&
    isset($data['ticket_price']) &&
    isset($data['tickets_available'])
) {
    $id = $data['id'];
    $title = $data['title'];
    $artist = $data['artist'];
    $date = $data['date'];
    $time = $data['time'];
    $location = $data['location'];
    $genre = $data['genre'];
    $description = $data['description'];
    $ticket_price = $data['ticket_price'];
    $tickets_available = $data['tickets_available'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=eventease', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE concerts SET title = ?, artist = ?, date = ?, time = ?, location = ?, genre = ?, description = ?, ticket_price = ?, tickets_available = ? WHERE id = ?");
        $stmt->execute([$title, $artist, $date, $time, $location, $genre, $description, $ticket_price, $tickets_available, $id]);

        echo json_encode(["message" => "Concert mis à jour avec succès"]);
    } catch (PDOException $e) {
        echo json_encode(["message" => "Erreur lors de la mise à jour : " . $e->getMessage()]);
    }
} else {
    echo json_encode(["message" => "Données manquantes"]);
}
?>