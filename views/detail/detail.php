<?php include(__DIR__ . '/../templates/header.php'); ?>

<div class="container mt-5">
    <h1><?= htmlspecialchars($game['name']) ?></h1>
    <img src="<?= htmlspecialchars($game['image']) ?>"  style="width: 200px;">
    <p><?= htmlspecialchars($game['description']) ?></p>
</div>


