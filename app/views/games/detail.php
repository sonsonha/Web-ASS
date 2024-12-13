<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .customs {
            background-color:rgb(27, 27, 66);
            color: #f5f5f5;
        }
        .background-banner {
            height: 300px;
            background-size: cover;
            background-position: center;
        }
        .game-thumbnail {
            max-width: 100%;
            height: auto;
        }
        h1, h2, h4 {
            color: #ffdd57;
        }
        a {
            color: #1e90ff;
        }
        a:hover {
            color: #87cefa;
        }
        .btn-primary {
            background-color: #1e90ff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #4682b4;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>


<body class="customs">
<?php include __DIR__ . '/../layouts/header.php'; ?>


    <main class="container my-4">
        <!-- Background Banner -->
        <div id="background-banner" class="background-banner mb-4"></div>

        <!-- Game Details -->
        <div class="row">
            <div class="col-md-4">
                <img id="game-thumbnail" class="game-thumbnail rounded" alt="Game Thumbnail">
            </div>

            <div class="col-md-8">
                <h1 id="game-title"></h1>
                <p><strong>Publisher:</strong> <span id="publisher"></span></p>
                <p><strong>Genre:</strong> <span id="genre"></span></p>
                <p><strong>Release Date:</strong> <span id="release-date"></span></p>
                <p><strong>Downloads:</strong> <span id="downloads"></span></p>

                <div class="mb-3">
                    <h4>Price: <span id="final-price"></span></h4>
                    <p id="original-price" class="text-muted text-decoration-line-through"></p>
                    <div id="discount-badge" class="badge bg-danger d-none"></div>
                </div>

                <button id="add-to-cart-btn" class="btn btn-success">Add to Cart</button>
                <a id="download-link" href="#" class="btn btn-primary d-none">Download</a>
            </div>
        </div>

        <!-- Introduction -->
        <section class="mt-4">
            <h2>Introduction</h2>
            <p id="introduction"></p>
        </section>

        <!-- Description -->
        <section class="mt-4">
            <h2>About the Game</h2>
            <p id="description"></p>
        </section>

        <!-- System Requirements -->
        <section class="mt-4">
            <h2>System Requirements</h2>
            <div class="row">
                <div class="col-md-6">
                    <h4>Minimum</h4>
                    <ul id="minimum-req"></ul>
                </div>
                <div class="col-md-6">
                    <h4>Recommended</h4>
                    <ul id="recommended-req"></ul>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const gameId = new URLSearchParams(window.location.search).get('id');

            if (!gameId) {
                console.error('No game ID provided.');
                return;
            }

            fetch(`/../api/get_game_info.php?id=${gameId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success' && data.data) {
                        populateGameDetails(data.data);
                    } else {
                        console.error('Error fetching game details:', data.message);
                    }
                })
                .catch(error => console.error('Error fetching game details:', error));
        });

        function populateGameDetails(game) {
            document.getElementById('background-banner').style.backgroundImage = `url('${game.background}')`;
            document.getElementById('game-thumbnail').src = game.avt;
            document.getElementById('game-title').textContent = game.game_name;
            document.getElementById('publisher').textContent = game.publisher;
            document.getElementById('genre').textContent = game.genre;
            document.getElementById('release-date').textContent = game.release_date;
            document.getElementById('downloads').textContent = game.downloads;

            // Price and Discount
            const finalPrice = document.getElementById('final-price');
            const originalPrice = document.getElementById('original-price');
            const discountBadge = document.getElementById('discount-badge');

            if (game.discount && parseFloat(game.discount) > 0) {
                const discountedPrice = (parseFloat(game.price) - parseFloat(game.discount)).toFixed(2);
                finalPrice.textContent = `$${discountedPrice}`;
                originalPrice.textContent = `$${game.price}`;
                discountBadge.textContent = `${game.discount} OFF`;
                discountBadge.classList.remove('d-none');
            } else {
                finalPrice.textContent = `$${game.price}`;
                originalPrice.textContent = '';
                discountBadge.classList.add('d-none');
            }

            // Introduction and Description
            document.getElementById('introduction').textContent = game.introduction || 'No introduction available.';
            document.getElementById('description').textContent = game.description || 'No description available.';

            // System Requirements
            populateSystemRequirements({
                minimum: {
                    OS: game.minOS,
                    Processor: game.minProcessor,
                    Memory: game.minMemory,
                    Graphics: game.minGraphics,
                    Storage: game.minStorage
                },
                recommended: {
                    OS: game.recOS,
                    Processor: game.recProcessor,
                    Memory: game.recMemory,
                    Graphics: game.recGraphics,
                    Storage: game.recStorage
                }
            });

            // Add to Cart or Download Button
            const addToCartButton = document.getElementById('add-to-cart-btn');
            const downloadLink = document.getElementById('download-link');

            if (game.download_link) {
                downloadLink.href = game.download_link;
                downloadLink.classList.remove('d-none');
                addToCartButton.classList.add('d-none');
            } else {
                addToCartButton.addEventListener('click', () => alert('Added to cart!'));
            }
        }

        function populateSystemRequirements(systemReq) {
            const minReq = document.getElementById('minimum-req');
            const recReq = document.getElementById('recommended-req');

            minReq.innerHTML = '';
            recReq.innerHTML = '';

            Object.entries(systemReq.minimum).forEach(([key, value]) => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${key}:</strong> ${value || 'N/A'}`;
                minReq.appendChild(li);
            });

            Object.entries(systemReq.recommended).forEach(([key, value]) => {
                const li = document.createElement('li');
                li.innerHTML = `<strong>${key}:</strong> ${value || 'N/A'}`;
                recReq.appendChild(li);
            });
        }
    </script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<?php include __DIR__ . '/../layouts/footer.php'; ?>
</body>
</html>
