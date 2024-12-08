<?php
require_once __DIR__ . '/../models/GameModel.php';
class GameController {
    private $gameModel;

    // Constructor nhận đối tượng GameModel
    public function __construct($db) {
        $this->gameModel = new GameModel($db);
    }

    // Phương thức thêm game mới
    public function addGame($game_data) {
        header('Content-Type: application/json');
    
        $result = $this->gameModel->addGame($game_data);
    
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Game added successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add game'
            ]);
        }
    }

    public function getGameInfo($id) {
        header('Content-Type: application/json');
    
        $game = $this->gameModel->getGameInfo($id);
    
        if ($game) {
            echo json_encode([
                'status' => 'success',
                'data' => $game
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Game not found'
            ]);
        }
    }
    

    public function updateGame() {
    header('Content-Type: application/json');
    $game_data = json_decode(file_get_contents("php://input"), true);

    if (!empty($game_data['game_id']) && !empty($game_data['game_name']) && !empty($game_data['publisher']) && !empty($game_data['genre']) && isset($game_data['price'])) {
        $result = $this->gameModel->editGame($game_data['game_id'], $game_data);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Game updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update game'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input data. Please provide required fields.'
        ]);
    }
}


    public function deleteGame() {
        header('Content-Type: application/json');
        $game_data = json_decode(file_get_contents("php://input"), true);
    
        if (isset($game_data['game_id'])) {
            if ($this->gameModel->deleteGame($game_data['game_id'])) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Game deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete game'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Game ID parameter is missing'
            ]);
        }
    }
    
    public function getRepresentativeGameByGenre($genre) {

        header('Content-Type: application/json');

        $gameData = $this->gameModel->getRepresentativeGameByGenre($genre);
    
        if ($gameData) {
            echo json_encode([
                'status' => 'success',
                'data' => [
                    $gameData['genre'],
                    $gameData['url'],
                    $gameData['slug']
                ]
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No data found for this genre'
            ]);
        }
    }

    public function getGamesByGenre($genre) {
        header('Content-Type: application/json');
        $games = $this->gameModel->getGamesByGenre($genre);
    
        if ($games) {
            echo json_encode([
                'status' => 'success',
                'data' => $games
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No games found for this genre'
            ]);
        }
    }

    public function getThumbnails($game_id) {
        header('Content-Type: application/json');

        if (!empty($game_id)) {
            $thumbnails = $this->gameModel->getThumbnailsByGameId($game_id);

            if ($thumbnails) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $thumbnails
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to fetch thumbnails or no data found'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid game ID'
            ]);
        }
    }
    
    
    
    
}



?>
