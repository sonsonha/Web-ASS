<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $genre = isset($data['genre']) ? $data['genre'] : null;

    if ($genre) {
        $gameController = new GameController($db);
        $gameController->getRepresentativeGameByGenre($genre);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Genre parameter is missing'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
