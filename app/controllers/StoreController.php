<?php
require_once '../../app/models/StoreModel.php';

class StoreController {
    private $storeModel;

    public function __construct($db) {
        $this->storeModel = new StoreModel($db);
    }

    public function getNewReleaseGame() {
      header('Content-Type: application/json');
      $game = $this->storeModel->getNewReleaseGame();

      if ( $game) {
          echo json_encode([
              'status' => 'success',
              'data' => $game
          ]);
      } else {
          echo json_encode([
              'status' => 'error',
              'message' => 'New release game not found'
          ]);
      }
    }

    public function getTopRateGame() {
      header('Content-Type: application/json');
      $game = $this->storeModel->getTopRateGame();

      if ( $game) {
          echo json_encode([
              'status' => 'success',
              'data' => $game
          ]);
      } else {
          echo json_encode([
              'status' => 'error',
              'message' => 'Top Rate game not found'
          ]);
      }
    }

    public function getTrendingGame() {
      header('Content-Type: application/json');
      $game = $this->storeModel->getTrendingGame();

      if ( $game) {
          echo json_encode([
              'status' => 'success',
              'data' => $game
          ]);
      } else {
          echo json_encode([
              'status' => 'error',
              'message' => 'Trending game not found'
          ]);
      }
    }

    public function getCarouselsGame() {
        header('Content-Type: application/json');
        $game = $this->storeModel->getCarouselsGame();

        if ( $game) {
            echo json_encode([
                'status' => 'success',
                'data' => $game
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Trending game not found'
            ]);
        }
    }
  }
  