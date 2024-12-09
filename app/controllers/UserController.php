<?php
require_once '../../app/models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db);
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

  }