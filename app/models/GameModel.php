<?php

class GameModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addGame($game_data) {
        $query = "INSERT INTO game (
            game_name, publisher, genre, price, discount, downloads, release_date, description, 
            introduction, rating, image_url, video_description, download_link, recOS, recProcessor, 
            recMemory, recGraphics, recDirectX, recStorage, minOS, minProcessor, minMemory, 
            minGraphics, minDirectX, minStorage
        ) VALUES (
            :game_name, :publisher, :genre, :price, :discount, :downloads, :release_date, :description, 
            :introduction, :rating, :image_url, :video_description, :download_link, :recOS, :recProcessor, 
            :recMemory, :recGraphics, :recDirectX, :recStorage, :minOS, :minProcessor, :minMemory, 
            :minGraphics, :minDirectX, :minStorage
        )";
    
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':game_name', $game_data['game_name']);
        $stmt->bindParam(':publisher', $game_data['publisher']);
        $stmt->bindParam(':genre', $game_data['genre']);
        $stmt->bindParam(':price', $game_data['price']);
        $stmt->bindParam(':discount', $game_data['discount']);
        $stmt->bindParam(':downloads', $game_data['downloads']);
        $stmt->bindParam(':release_date', $game_data['release_date']);
        $stmt->bindParam(':description', $game_data['description']);
        $stmt->bindParam(':introduction', $game_data['introduction']);
        $stmt->bindParam(':rating', $game_data['rating']);
        $stmt->bindParam(':image_url', $game_data['image_url']);
        $stmt->bindParam(':video_description', $game_data['video_description']);
        $stmt->bindParam(':download_link', $game_data['download_link']);
        $stmt->bindParam(':recOS', $game_data['recOS']);
        $stmt->bindParam(':recProcessor', $game_data['recProcessor']);
        $stmt->bindParam(':recMemory', $game_data['recMemory']);
        $stmt->bindParam(':recGraphics', $game_data['recGraphics']);
        $stmt->bindParam(':recDirectX', $game_data['recDirectX']);
        $stmt->bindParam(':recStorage', $game_data['recStorage']);
        $stmt->bindParam(':minOS', $game_data['minOS']);
        $stmt->bindParam(':minProcessor', $game_data['minProcessor']);
        $stmt->bindParam(':minMemory', $game_data['minMemory']);
        $stmt->bindParam(':minGraphics', $game_data['minGraphics']);
        $stmt->bindParam(':minDirectX', $game_data['minDirectX']);
        $stmt->bindParam(':minStorage', $game_data['minStorage']);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error: " . $errorInfo[2];
            return false;
        }
    }

    public function editGame($game_id, $game_data) {
        $query = "UPDATE game SET 
            game_name = :game_name,
            publisher = :publisher,
            genre = :genre,
            price = :price,
            discount = :discount,
            downloads = :downloads,
            release_date = :release_date,
            description = :description,
            introduction = :introduction,
            rating = :rating,
            image_url = :image_url,
            video_description = :video_description,
            download_link = :download_link,
            recOS = :recOS,
            recProcessor = :recProcessor,
            recMemory = :recMemory,
            recGraphics = :recGraphics,
            recDirectX = :recDirectX,
            recStorage = :recStorage,
            minOS = :minOS,
            minProcessor = :minProcessor,
            minMemory = :minMemory,
            minGraphics = :minGraphics,
            minDirectX = :minDirectX,
            minStorage = :minStorage
        WHERE id = :game_id";
    
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':game_name', $game_data['game_name']);
        $stmt->bindParam(':publisher', $game_data['publisher']);
        $stmt->bindParam(':genre', $game_data['genre']);
        $stmt->bindParam(':price', $game_data['price']);
        $stmt->bindParam(':discount', $game_data['discount']);
        $stmt->bindParam(':downloads', $game_data['downloads']);
        $stmt->bindParam(':release_date', $game_data['release_date']);
        $stmt->bindParam(':description', $game_data['description']);
        $stmt->bindParam(':introduction', $game_data['introduction']);
        $stmt->bindParam(':rating', $game_data['rating']);
        $stmt->bindParam(':image_url', $game_data['image_url']);
        $stmt->bindParam(':video_description', $game_data['video_description']);
        $stmt->bindParam(':download_link', $game_data['download_link']);
        $stmt->bindParam(':recOS', $game_data['recOS']);
        $stmt->bindParam(':recProcessor', $game_data['recProcessor']);
        $stmt->bindParam(':recMemory', $game_data['recMemory']);
        $stmt->bindParam(':recGraphics', $game_data['recGraphics']);
        $stmt->bindParam(':recDirectX', $game_data['recDirectX']);
        $stmt->bindParam(':recStorage', $game_data['recStorage']);
        $stmt->bindParam(':minOS', $game_data['minOS']);
        $stmt->bindParam(':minProcessor', $game_data['minProcessor']);
        $stmt->bindParam(':minMemory', $game_data['minMemory']);
        $stmt->bindParam(':minGraphics', $game_data['minGraphics']);
        $stmt->bindParam(':minDirectX', $game_data['minDirectX']);
        $stmt->bindParam(':minStorage', $game_data['minStorage']);
        $stmt->bindParam(':game_id', $game_id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Error: " . $errorInfo[2];
            return false;
        }
    }
    
    public function deleteGame($game_id) {
        $query = "DELETE FROM game WHERE id = :game_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":game_id", $game_id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    
}
?>
