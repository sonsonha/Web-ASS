<?php
require_once '../../config/database.php';  // Kết nối cơ sở dữ liệu
require_once '../../app/controllers/GameController.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->game_name) && isset($data->publisher) && isset($data->genre) && isset($data->price) && isset($data->release_date)) {
    
    $game_data = [
        'game_name' => $data->game_name,
        'publisher' => $data->publisher,
        'genre' => $data->genre,
        'price' => $data->price,
        'discount' => isset($data->discount) ? $data->discount : 0,
        'downloads' => isset($data->downloads) ? $data->downloads : 0,
        'release_date' => $data->release_date,
        'description' => isset($data->description) ? $data->description : '',
        'introduction' => isset($data->introduction) ? $data->introduction : '',
        'rating' => isset($data->rating) ? $data->rating : null,
        'image_url' => isset($data->image_url) ? $data->image_url : '',
        'video_description' => isset($data->video_description) ? $data->video_description : '',
        'download_link' => isset($data->download_link) ? $data->download_link : '',
        'recOS' => isset($data->recOS) ? $data->recOS : '',
        'recProcessor' => isset($data->recProcessor) ? $data->recProcessor : '',
        'recMemory' => isset($data->recMemory) ? $data->recMemory : '',
        'recGraphics' => isset($data->recGraphics) ? $data->recGraphics : '',
        'recDirectX' => isset($data->recDirectX) ? $data->recDirectX : '',
        'recStorage' => isset($data->recStorage) ? $data->recStorage : '',
        'minOS' => isset($data->minOS) ? $data->minOS : '',
        'minProcessor' => isset($data->minProcessor) ? $data->minProcessor : '',
        'minMemory' => isset($data->minMemory) ? $data->minMemory : '',
        'minGraphics' => isset($data->minGraphics) ? $data->minGraphics : '',
        'minDirectX' => isset($data->minDirectX) ? $data->minDirectX : '',
        'minStorage' => isset($data->minStorage) ? $data->minStorage : ''
    ];

    // Khởi tạo GameController và gọi API addGame
    $gameController = new GameController($db);
    $gameController->addGame($game_data);

} else {
    // Nếu thiếu tham số
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameters'
    ]);
}
?>
