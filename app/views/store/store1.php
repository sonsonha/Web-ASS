<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Games</title>
</head>
<body>
    <h1 id="category-name">Loading...</h1>
    <div id="game-list">
        <!-- Games dynamically generated -->
    </div>

    <script>
        // Parse the category from the query string
        const params = new URLSearchParams(window.location.search);
        const category = params.get('category');

        if (category) {
            // Display category name
            document.getElementById('category-name').textContent = category;

            // Fetch games for the selected category
            fetch('fetch_games_by_category.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ category })
            })
                .then(response => response.json())
                .then(games => {
                    const gameList = document.getElementById('game-list');
                    games.forEach(game => {
                        const gameCard = document.createElement('div');
                        gameCard.innerHTML = `
                            <h3>${game.title}</h3>
                            <p>Release Date: ${game.release_date}</p>
                            <p>Price: ${game.price}</p>
                        `;
                        gameList.appendChild(gameCard);
                    });
                })
                .catch(error => console.error('Error fetching games:', error));
        } else {
            document.getElementById('category-name').textContent = 'Category not found!';
        }
    </script>
</body>
</html>
