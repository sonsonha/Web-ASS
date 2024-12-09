<?php
class StoreModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getNewReleaseGame() {
      $query = "
          SELECT * FROM game
          ORDER BY release_date DESC
          LIMIT 10";

      $stmt = $this->db->prepare($query);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopRateGame() {
      $query = "
          SELECT * FROM game
          ORDER BY rating DESC
          LIMIT 10";

      $stmt = $this->db->prepare($query);
      $stmt->execute();

      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTrendingGame() {
    $query = "
        SELECT * FROM game
        ORDER BY downloads DESC
        LIMIT 10";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
