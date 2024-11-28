<?php
// Update the article
include 'db_connection.php';

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];
$image = $data['image'];
$title = $data['title'];
$description = $data['description'];

$sql = "UPDATE articles SET image = ?, title = ?, description = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssi', $image, $title, $description, $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
