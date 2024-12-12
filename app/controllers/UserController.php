<?php
require_once '../../app/models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
    }

    public function createUser($data){
        header('Content-Type: application/json');
        if (!$data || !isset($data['firstName'], $data['lastName'], $data['username'], $data['email'], $data['password'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid data.'
            ]);
            return;
        }

        $result = $this->userModel->createUser(
            $data['firstName'],
            $data['lastName'],
            $data['username'],
            $data['email'],
            $data['password']
        );

        if ($result === "Account created successfully!") {
            echo json_encode([
                'status' => 'success',
                'message' => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => $result
            ]);
        }
    }

    public function loginUser($data) {
        header('Content-Type: application/json');

        if (!$data || !isset($data['email']) || !isset($data['password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data.']);
            return;
        }

        $user = $this->userModel->authenticate($data['email'], $data['password']);

        if ($user !== null) {
            echo json_encode(['status' => 'success', 'message' => 'Login successful!', 'user' => $user]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
        }
    }

    public function changePassword($data) {
        if (!isset($data['email']) || !isset($data['current_password']) || !isset($data['new_password'])) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
            return;
        }

        $user = $this->userModel->authenticate($data['email'], $data['current_password']);

        if ($user === null) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or current password.']);
            return;
        }

        if ($this->userModel->updatePassword($user['id'], $data['new_password'])) {
            echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
        }
    }


    public function getUserInfo($userId) {
      header('Content-Type: application/json');
      $user = $this->userModel->getUserInfo($userId);

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


    public function getShopingCart($userId) {
        header('Content-Type: application/json');
        $user = $this->userModel->getShopingCart($userId);

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

    public function deleteShoppingCart($userId, $gameId) {
        header('Content-Type: application/json');
        $user = $this->userModel->deleteShoppingCart($userId, $gameId);

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

    public function updateProfile($user_id, $username, $phone, $url_link, $birth){
        header('Content-Type: application/json');
        $result = $this->userModel->updateProfile($user_id, $username, $phone, $url_link, $birth);


        if ($result) {
            echo json_encode([
                'status' => 'success',
                'data' => $result
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Update profile failed'
            ]);
        }
    }

    public function addCoins($data) {
        if (!isset($data['user_id']) || !isset($data['coins'])) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required parameters: user_id or coins']);
            return;
        }

        $userId = $data['user_id'];
        $coinToAdd = $data['coins'];

        if ($this->userModel->addCoins($userId, $coinToAdd)) {
            echo json_encode(['status' => 'success', 'message' => 'Coins added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add coins.']);
        }
    }
  }