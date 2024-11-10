<?php
// Fallbacks if $game is undefined
$game = $game ?? ['title' => 'Unknown', 'price' => 'N/A', 'image' => '/assets/images/default.jpg'];
?>
<div class="col-md-4">
    <div class="card h-100">
        <img src="<?php echo htmlspecialchars($game['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($game['title']); ?>">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($game['title']); ?></h5>
            <p class="card-text text-success fw-bold"><?php echo htmlspecialchars($game['price']); ?></p>
            <a href="#" class="btn btn-primary">Buy Now</a>
        </div>
    </div>
</div>
