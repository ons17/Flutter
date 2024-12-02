<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=eventease', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM concerts");
    $stmt->execute();

    $concerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($concerts) {
        echo json_encode(["message" => "Concerts récupérés avec succès", "data" => $concerts]);
    } else {
        echo json_encode(["message" => "Aucun concert trouvé", "data" => []]);
    }
} catch (PDOException $e) {
    echo json_encode(["message" => "Erreur lors de la récupération des concerts: " . $e->getMessage()]);
}
?>