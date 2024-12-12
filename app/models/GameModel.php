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
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function checkGameExists($id) {
        $sql = "SELECT COUNT(*) FROM game WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0; 
    }
    
    public function getAllCategoriesWithThumbnail() {
        $query = "
            SELECT DISTINCT g.genre, 
                            t.url AS thumbnail_url
            FROM game g
            LEFT JOIN thumbnails t ON g.id = t.game_id AND t.type = 'image'
            GROUP BY g.genre
            ORDER BY g.genre
        ";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($categories as &$category) {
            $random_thumbnail = $this->getRandomThumbnailByGenre($category['genre']);
            
            $category['thumbnail_url'] = $random_thumbnail ? $random_thumbnail['url'] : null;
        }
    
        return $categories;
    }
    
    public function getRandomThumbnailByGenre($genre) {
        $query = "
            SELECT url 
            FROM thumbnails t
            JOIN game g ON t.game_id = g.id
            WHERE g.genre = :genre AND t.type = 'image'
            ORDER BY RAND() 
            LIMIT 1
        ";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':genre', $genre, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function addThumbnail($game_id, $thumbnail_data) {
        $query = "INSERT INTO thumbnails (game_id, url, type) VALUES (:game_id, :url, :type)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        $stmt->bindParam(':url', $thumbnail_data['url'], PDO::PARAM_STR);
        $stmt->bindParam(':type', $thumbnail_data['type'], PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding thumbnail: " . $e->getMessage());
            return false;
        }
    }
    public function addToCart($accountId, $gameId, $price) {
        $this->db->beginTransaction();

        try {
            $query = "SELECT id FROM user WHERE account_id = :account_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':account_id', $accountId, PDO::PARAM_INT);
            $stmt->execute();

            $userId = $stmt->fetchColumn();

            if (!$userId) {
                throw new Exception('User not found.');
            }

            $query = "INSERT INTO don_hang (user_id, order_date, total_amount, status, payment_status)
                      VALUES (:user_id, CURDATE(), :total_amount, 'Pending', 'Paid')";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':total_amount', $price);
            $stmt->execute();

            $orderId = $this->db->lastInsertId();

            $query = "INSERT INTO chi_tiet_don_hang (order_id, game_id, quantity) VALUES (:order_id, :game_id, 1)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();

            return ['status' => 'success', 'message' => 'Added to cart successfully.'];
        } catch (Exception $e) {
            $this->db->rollBack();
            return ['status' => 'error', 'message' => 'Failed to add to cart: ' . $e->getMessage()];
        }
    }

    public function buyGames($accountId, $gameIds) {

        $query = "SELECT id, coins FROM user WHERE account_id = :account_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':account_id', $accountId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ['status' => 'error', 'message' => 'User not found.'];
        }

        $userId = $user['id'];
        $userCoins = $user['coins'];

        $this->db->beginTransaction();

        try {
            $totalAmount = 0;

            foreach ($gameIds as $gameId) {
                $query = "SELECT price, discount FROM game WHERE id = :game_id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
                $stmt->execute();
                $game = $stmt->fetch(PDO::FETCH_ASSOC);
                $discountedPrice = $game['price'] * (1 - $game['discount'] / 100);
                $totalAmount += $discountedPrice;
            }

            // Kiểm tra số dư coin
            if ($userCoins < $totalAmount) {
                $this->db->rollBack();
                return ['status' => 'error', 'message' => 'Insufficient coins.'];
            }

            // Cập nhật đơn hàng
            $query = "INSERT INTO don_hang (user_id, order_date, total_amount, status, payment_status, payment_date)
                      VALUES (:user_id, CURDATE(), :total_amount, 'Paid', 'Paid',CURDATE())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':total_amount', $totalAmount);
            $stmt->execute();
            $orderId = $this->db->lastInsertId();

            // Thêm từng game vào user_game và chi_tiet_don_hang
            foreach ($gameIds as $gameId) {
                $query = "INSERT INTO chi_tiet_don_hang (order_id, game_id, quantity) VALUES (:order_id, :game_id, 1)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
                $stmt->execute();

                $query = "INSERT INTO user_game (user_id, game_id) VALUES (:user_id, :game_id)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
                $stmt->execute();
            }

            $query = "UPDATE user SET coins = coins - :total_amount WHERE id = :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':total_amount', $totalAmount);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();

            return ['status' => 'success', 'message' => 'Order created and coins deducted successfully.'];
        } catch (Exception $e) {
            $this->db->rollBack();
            return ['status' => 'error', 'message' => 'Game already owned'];
        }
    }

}
?>
