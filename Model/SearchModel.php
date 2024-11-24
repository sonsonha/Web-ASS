<?php
class SearchModel {
    public static function getGames() {
        return [
            ['id' => 1, 'name' => 'Cyberpunk 2077', 'image' => '/assets/img/cyberpunk.jpg', 'description' => 'Open-world RPG.'],
            ['id' => 2, 'name' => 'The Witcher 3', 'image' => '/assets/img/witcher.jpg', 'description' => 'Fantasy RPG.'],
            ['id' => 3, 'name' => 'Red Dead Redemption 2', 'image' => '/assets/img/reddead.jpg', 'description' => 'Wild West adventure.'],
        ];
    }
}
?>
    