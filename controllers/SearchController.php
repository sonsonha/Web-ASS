<?php
require_once "Model/SearchModel.php";

class SearchController {
    public function search($query) {
        $games = SearchModel::getGames(); // Lấy danh sách game từ model
        $results = array_filter($games, function ($game) use ($query) {
            return stripos($game['name'], $query) !== false;
        });

        header('Content-Type: application/json');
        echo json_encode($results);
        exit;
    }
}
?>
