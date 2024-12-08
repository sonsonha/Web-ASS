<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->game_name) && !empty($data->publisher) && !empty($data->genre) && !empty($data->price) && !empty($data->release_date)) {
    $game_data = [
        'game_name' => $data->game_name,
        'publisher' => $data->publisher,
        'genre' => $data->genre,
        'price' => $data->price,
        'discount' => $data->discount ?? 0,
        'downloads' => $data->downloads ?? 0,
        'release_date' => $data->release_date,
        'description' => $data->description ?? '',
        'avt' => $data->avt ?? '',
        'background' => $data->background ?? '',
        'introduction' => $data->introduction ?? '',
        'rating' => $data->rating ?? null,
        'download_link' => $data->download_link ?? '',
        'recOS' => $data->recOS ?? '',
        'recProcessor' => $data->recProcessor ?? '',
        'recMemory' => $data->recMemory ?? '',
        'recGraphics' => $data->recGraphics ?? '',
        'recDirectX' => $data->recDirectX ?? '',
        'recStorage' => $data->recStorage ?? '',
        'minOS' => $data->minOS ?? '',
        'minProcessor' => $data->minProcessor ?? '',
        'minMemory' => $data->minMemory ?? '',
        'minGraphics' => $data->minGraphics ?? '',
        'minDirectX' => $data->minDirectX ?? '',
        'minStorage' => $data->minStorage ?? ''
    ];

    $gameController = new GameController($db);
    $gameController->addGame($game_data);

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameters'
    ]);
}

?>
