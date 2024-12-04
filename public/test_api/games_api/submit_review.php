<?php
header('Content-Type: application/json');

// Get input data
$input = json_decode(file_get_contents('php://input'), true);
$gameId = $input['game_id'] ?? null;
$rating = $input['rating'] ?? null;
$message = $input['message'] ?? '';

if (!$gameId || !$rating) {
    echo json_encode(['success' => false, 'message' => 'Game ID and rating are required.']);
    exit;
}

// Save the review to the database
if (saveReviewToDatabase($gameId, $rating, $message)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to save review.']);
}

/**
 * Save a review to the database.
 *
 * @param int $gameId The ID of the game being reviewed.
 * @param int $rating The rating given by the user.
 * @param string $message The review message.
 * @return bool True if the review was saved successfully, false otherwise.
 */
function saveReviewToDatabase($gameId, $rating, $message) {
    // Replace these variables with your database connection details
    $host = 'localhost';
    $db = 'game_store';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    } catch (PDOException $e) {
        error_log('Database connection failed: ' . $e->getMessage());
        return false;
    }

    // Insert the review into the reviews table
    $sql = "INSERT INTO reviews (game_id, rating, message, created_at) VALUES (:game_id, :rating, :message, NOW())";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':game_id' => $gameId,
            ':rating' => $rating,
            ':message' => $message,
        ]);
        return true;
    } catch (PDOException $e) {
        error_log('Failed to save review: ' . $e->getMessage());
        return false;
    }
}
