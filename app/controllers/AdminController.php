<?php
require_once '../../app/models/AdminModel.php';

class AdminController {
    private $adminModel;
    
    public function __construct($db) {
        $this->adminModel = new Adminmodel($db);
    }

    // API 1: Lấy thông tin user theo username
    public function getUserInfo($username) {
        header('Content-Type: application/json');
        $user = $this->adminModel->getUserInfo($username);

        if ($user) {
            echo json_encode([
                'status' => 'success',
                'data' => $user
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'User not found'
            ]);
        }
    }

    // API 2: Lấy tất cả user
    public function getAllUsers() {
        header('Content-Type: application/json');
        $users = $this->adminModel->getAllUsers();

        if ($users) {
            echo json_encode([
                'status' => 'success',
                'data' => $users
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No users found'
            ]);
        }
    }   

    // API 3: Ban/unBan tài khoản của user
    public function toggleUserStatus($username) {
        header('Content-Type: application/json');
        $result = $this->adminModel->toggleUserStatus($username);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User status has been toggled successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to toggle user status'
            ]);
        }
    }
    // API 4: Thay đổi username của tài khoản
    public function updateUsername($oldUsername, $newUsername) {
        header('Content-Type: application/json');
        $result = $this->adminModel->updateUsername($oldUsername, $newUsername);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Username has been updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update username or new username already exists'
            ]);
        }
    }
    // API 5: Xóa tài khoản của user
    public function deleteUser($username) {
        header('Content-Type: application/json');
        $result = $this->adminModel->deleteUser($username);
    
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'User has been deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete user'
            ]);
        }
    }

    // API 6: Thay đổi reputation points của user
    public function updateReputationPoints($username, $newReputationPoints) {
        header('Content-Type: application/json');
        $result = $this->adminModel->updateReputationPoints($username, $newReputationPoints);
    
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Reputation points updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update reputation points'
            ]);
        }
    }
    // API 7: Báo lỗi game (phía user tạo mới báo lỗi)
    public function reportError($user_id, $game_id, $error_description) {
        header('Content-Type: application/json');
        $result = $this->adminModel->reportError($user_id, $game_id, $error_description);
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Error reported successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to report error'
            ]);
        }
    }
    // API 8: Xóa lỗi (admin)
    public function deleteErrorReport() {
        // Lấy dữ liệu báo lỗi từ body của yêu cầu POST
        header('Content-Type: application/json');
        $error_data = json_decode(file_get_contents("php://input"), true);
    
        // Kiểm tra xem dữ liệu có hợp lệ không (bao gồm id)
        if (isset($error_data['id'])) {
            // Gọi phương thức deleteErrorReport từ BaoLoiModel
            if ($this->adminModel->deleteErrorReport($error_data['id'])) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Error report deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete error report'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error report ID is missing'
            ]);
        }
    }
}
?>
