document.addEventListener('DOMContentLoaded', () => {
    const pathParts = window.location.pathname.split('/');
    const category = pathParts[pathParts.length - 1]; 
    if (!category) {
        console.error('Category not specified');
        return;
    }

    // Set category name in the header
    const headerElement = document.querySelector('h1');
    headerElement.textContent = `${category}`;

    // Initialize sections
    fetchCategoryGames(category); // For carousel and popular games
});

function fetchCategoryGames(category) {
    const gameCardsContainer = document.getElementById('gameCardsContainer');
    const trendingGamesContainer = document.getElementById('trendingGamesContainer');
    const categoryTitleElement = document.getElementById('category-title');
    let page = 1;
    let isLoading = false;
    let hasMoreGames = true;

    categoryTitleElement.textContent = `Popular ${category} Games`;

    const fetchGames = () => {
        if (isLoading || !hasMoreGames) return;  // Prevent multiple calls if already loading or no more games

        isLoading = true;
        showSpinner(gameCardsContainer);

        fetch('http://localhost/api/get_games_by_genre.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ genre: category, page: page }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success' && data.data.length > 0) {
                    const games = data.data;
                    populateCarousel(games); // Populate carousel
                    appendGameRows(games, gameCardsContainer); // Populate game cards
                    populateTrendingGames(games, trendingGamesContainer);
                    page++; // Increase page number for next request
                } else {
                    console.log('No more games to load.');
                    hasMoreGames = false; // No more games available
                }
            })
            .catch((error) => console.error('Error fetching games:', error))
            .finally(() => {
                isLoading = false;
                removeSpinner(gameCardsContainer);
            });
    };

    fetchGames();

    // Handle scroll event to fetch more games when scrolled to bottom
}

// Populate rows for popular games
function appendGameRows(games, container) {
    const rows = Math.ceil(games.length / 5);
    for (let i = 0; i < rows; i++) {
        const row = document.createElement('div');
        row.className = 'row row-cols-1 row-cols-sm-2 row-cols-md-5 g-4';

        games.slice(i * 5, i * 5 + 5).forEach((game) => {
            const col = document.createElement('div');
            col.className = 'col';
            col.innerHTML = `
                <div class="card game-card bg-dark" data-id="${game.id}">
                    <img src="${game.avt}" class="card-img-top" alt="${game.game_name}">
                    <div class="card-body">
                        <h5 class="card-title">${game.game_name}</h5>
                        <p class="price text-success">Price: $${game.price}</p>
                        ${game.discount ? `<div class="discount-label">${game.discount}</div>` : ''}
                    </div>
                </div>
            `;

            col.querySelector('.game-card').addEventListener('click', () => {
                window.location.href = `/zerostress-game-store/${game.genre}/${game.id}/${encodeURIComponent(game.game_name.replace(/ /g, "_"))}?id=`;
            });

            row.appendChild(col);
        });

        container.appendChild(row);
    }
}

// Populate trending games section
function populateTrendingGames(games, container) {
    games.slice(0, 9).forEach((game) => {
        const col = document.createElement('div');
        col.className = 'col-12 col-md-4'; // 3 cards per row on medium+ screens
        col.innerHTML = `
            <div class="card game-card bg-dark" data-id="${game.id}" style="height: 300px; width: 300px;">
                <img src="${game.avt}" class="card-img-top" alt="${game.game_name}" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title text-white">${game.game_name}</h5>
                    <p class="price text-success">Price: $${game.price}</p>
                    ${game.discount ? `<div class="discount-label">${game.discount}</div>` : ''}
                </div>
            </div>
        `;

        col.querySelector('.game-card').addEventListener('click', () => {
            const gameName = game.game_name.replace(/ /g, "_").replace(/:/g, "_");
            window.location.href = `/zerostress-game-store/${game.genre}/${game.id}/${gameName}?id=${game.id}`;
            
        });

        container.appendChild(col);
    });
}

// Populate carousel with trending games
function populateCarousel(games) {
    const carouselInner = document.querySelector('.carousel-inner');
    const trendingSection = document.getElementById('trendingCarousel');
    carouselInner.innerHTML = '';

    games.forEach((game, index) => {
        const isActive = index === 0 ? 'active' : '';
        const slide = document.createElement('div');
        slide.className = `carousel-item ${isActive}`;
        slide.setAttribute('data-bg', game.background);

        slide.innerHTML = `
            <div class="carousel-content">
                <img src="${game.avt}" class="game-image" alt="${game.game_name}">
                <div class="game-details text-white p-3 bg-dark bg-opacity-75 rounded">
                    <h2>${game.game_name}</h2>
                    <p>Price: $${game.price}</p>
                    ${game.discount ? `<span class="text-danger">${game.discount}</span>` : ''}
                </div>
            </div>
        `;

        carouselInner.appendChild(slide);
    });

    const carousel = document.getElementById('gameCarousel');
    carousel.addEventListener('slide.bs.carousel', (event) => {
        const nextSlide = event.relatedTarget;
        const bgImage = nextSlide.getAttribute('data-bg');
        trendingSection.style.backgroundImage = `url(${bgImage})`;
    });
}

// Spinner functions
function showSpinner(container) {
    if (!document.querySelector('.spinner')) {
        const spinner = document.createElement('div');
        spinner.className = 'spinner text-center my-3';
        spinner.innerHTML = `<div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>`;
        container.appendChild(spinner);
    }
}

function removeSpinner(container) {
    const spinner = container.querySelector('.spinner');
    if (spinner) spinner.remove();
}
