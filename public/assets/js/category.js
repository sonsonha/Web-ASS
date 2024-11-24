document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');
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

// Fetch and populate category games (carousel + popular games)
function fetchCategoryGames(category) {
    const gameCardsContainer = document.getElementById('gameCardsContainer');
    const trendingGamesContainer = document.getElementById('trendingGamesContainer');
    const categoryTitleElement = document.getElementById('category-title');
    let page = 1;
    let isLoading = false;
    let hasMoreGames = true;

    categoryTitleElement.textContent = `Popular ${category} Games`;

    const fetchGames = () => {
        if (isLoading || !hasMoreGames) return;

        isLoading = true;
        showSpinner(gameCardsContainer);

        fetch('test_api/fetch_category_games.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ category, page }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }
                populateCarousel(data.popular); // Populate carousel
                appendGameRows(data.popular, gameCardsContainer); // Populate popular games
                populateTrendingGames(data.popular, trendingGamesContainer);
                if (data.popular.length < 10) hasMoreGames = false; // Check if there are more games
                page++;
            })
            .catch((error) => console.error('Error fetching games:', error))
            .finally(() => {
                isLoading = false;
                removeSpinner(gameCardsContainer);
            });
    };

    fetchGames();

    window.addEventListener('scroll', () => {
        if (
            window.innerHeight + window.scrollY >=
            document.body.offsetHeight - 100
        ) {
            fetchGames();
        }
    });
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
                    <img src="${game.background_image}" class="card-img-top" alt="${game.title}">
                    <div class="card-body">
                        <h5 class="card-title">${game.title}</h5>
                        <p class="price text-success">Price: ${game.price}</p>
                        ${
                            game.discount
                                ? `<div class="discount-label">${game.discount}</div>`
                                : ''
                        }
                    </div>
                </div>
            `;

            col.querySelector('.game-card').addEventListener('click', () => {
                window.location.href = `/app/views/games/detail.php?id=${game.id}`;
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
                <img src="${game.background_image}" class="card-img-top" alt="${game.title}" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title text-white">${game.title}</h5>
                    <p class="price text-success">Price: ${game.price}</p>
                    ${
                        game.discount
                            ? `<div class="discount-label">${game.discount}</div>`
                            : ''
                    }
                </div>
            </div>
        `;

        col.querySelector('.game-card').addEventListener('click', () => {
            window.location.href = `/app/views/games/detail.php?id=${game.id}`;
        });

        container.appendChild(col);
    });
}

// Populate carousel with trending games
function populateCarousel(trendingGames) {
    const carouselInner = document.querySelector('.carousel-inner');
    const trendingSection = document.getElementById('trendingCarousel');
    carouselInner.innerHTML = '';

    trendingGames.forEach((game, index) => {
        const isActive = index === 0 ? 'active' : '';
        const slide = document.createElement('div');
        slide.className = `carousel-item ${isActive}`;
        slide.setAttribute('data-bg', game.background);

        slide.innerHTML = `
            <div class="carousel-content">
                <img src="${game.background_image}" class="game-image" alt="${game.title}">
                <div class="game-details text-white p-3 bg-dark bg-opacity-75 rounded">
                    <h2>${game.title}</h2>
                    <p>Price: ${game.price}</p>
                    ${
                        game.discount
                            ? `<span class="text-danger">${game.discount}</span>`
                            : ''
                    }
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
