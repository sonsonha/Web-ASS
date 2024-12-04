<?php
// Include database connection
include '../config/database.php';

// Check if the request method is POST and validate the input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['game_id'])) {
    $gameId = intval($_POST['game_id']);

    // Fetch current state of comments for the game
    $query = "SELECT comments_enabled FROM games WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $gameId);
    $stmt->execute();
    $result = $stmt->get_result();
    $game = $result->fetch_assoc();

    if ($game) {
        // Toggle comments_enabled
        $newState = $game['comments_enabled'] ? 0 : 1;

        // Update the database
        $updateQuery = "UPDATE games SET comments_enabled = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param('ii', $newState, $gameId);
        $updateStmt->execute();

        // Redirect back to the game detail page
        header("Location: /app/views/games/detail.php?id=$gameId");
        exit;
    } else {
        echo "Game not found.";
    }
} else {
    echo "Invalid request.";
}
?>
