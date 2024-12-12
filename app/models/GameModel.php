<?php

class GameModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addGame($game_data) {
        $query = "INSERT INTO game (
            game_name, publisher, genre, price, discount, downloads, release_date, description,
            avt, background, introduction, rating, download_link, recOS, recProcessor,
            recMemory, recGraphics, recDirectX, recStorage, minOS, minProcessor, minMemory,
            minGraphics, minDirectX, minStorage
        ) VALUES (
            :game_name, :publisher, :genre, :price, :discount, :downloads, :release_date, :description,
            :avt, :background, :introduction, :rating, :download_link, :recOS, :recProcessor,
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
        $stmt->bindParam(':avt', $game_data['avt']);
        $stmt->bindParam(':background', $game_data['background']);
        $stmt->bindParam(':introduction', $game_data['introduction']);
        $stmt->bindParam(':rating', $game_data['rating']);
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

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding game: " . $e->getMessage());
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
            avt = :avt,
            background = :background,
            introduction = :introduction,
            rating = :rating,
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

        // Gán tham số
        $stmt->bindParam(':game_name', $game_data['game_name']);
        $stmt->bindParam(':publisher', $game_data['publisher']);
        $stmt->bindParam(':genre', $game_data['genre']);
        $stmt->bindParam(':price', $game_data['price']);
        $stmt->bindParam(':discount', $game_data['discount']);
        $stmt->bindParam(':downloads', $game_data['downloads']);
        $stmt->bindParam(':release_date', $game_data['release_date']);
        $stmt->bindParam(':description', $game_data['description']);
        $stmt->bindParam(':avt', $game_data['avt']);
        $stmt->bindParam(':background', $game_data['background']);
        $stmt->bindParam(':introduction', $game_data['introduction']);
        $stmt->bindParam(':rating', $game_data['rating']);
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
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating game: " . $e->getMessage());
            return false;
        }
    }


    public function deleteGame($game_id) {
        $query = "DELETE FROM game WHERE id = :game_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":game_id", $game_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getRepresentativeGameByGenre($genre) {
        $query = "
            SELECT
                g.genre AS genre,
                t.url AS url
            FROM game g
            JOIN thumbnails t ON g.id = t.game_id
            WHERE g.genre = :genre
            LIMIT 1
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $result['slug'] = str_replace(' ', '-', $result['genre']);
            return $result;
        }

        return null;
    }

    public function getGamesByGenre($genre) {
        $query = "
            SELECT *
            FROM game
            WHERE genre = :genre
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getThumbnailsByGameId($game_id) {
        $query = "SELECT type, url
                  FROM thumbnails
                  WHERE game_id = :game_id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả bản ghi
        } catch (PDOException $e) {
            error_log("Error fetching thumbnails: " . $e->getMessage());
            return false;
        }
    }

    public function getGameInfo($id) {
        $query = "SELECT * FROM game WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching game info: " . $e->getMessage());
            return false;
        }
    }



}
?>
