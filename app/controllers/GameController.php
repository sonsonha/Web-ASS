<?php
require_once '../../app/models/GameModel.php';
class GameController {
    private $gameModel;

    // Constructor nhận đối tượng GameModel
    public function __construct($db) {
        $this->gameModel = new GameModel($db);
    }

    // Phương thức thêm game mới
    public function addGame($game_data) {
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

    public function updateGame() {
        // Lấy dữ liệu game từ body của yêu cầu POST
        $game_data = json_decode(file_get_contents("php://input"), true);
    
        // Kiểm tra xem dữ liệu có hợp lệ không (bao gồm cả game_id)
        if (isset($game_data['game_id'], $game_data['game_name'], $game_data['publisher'], $game_data['genre'], $game_data['price'])) {
            // Gọi phương thức editGame từ GameModel
            if ($this->gameModel->editGame($game_data['game_id'], $game_data)) {
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
                'message' => 'Invalid input data'
            ]);
        }
    }

    public function deleteGame() {
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
    
    
    
}



?>
