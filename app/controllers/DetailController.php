<?php
require_once "Model/SearchModel.php";

class DetailController {
    public function detail($id) {
        $games = SearchModel::getGames();
        $game = array_filter($games, function ($game) use ($id) {
            return $game['id'] == $id;
        });
        $game = reset($game); // Lấy phần tử đầu tiên (nếu có)

        if ($game) {
            include "views/detail/detail.php";
        } else {
            include "views/error/404.php";
        }
    }
}
?>