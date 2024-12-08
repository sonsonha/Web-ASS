document.addEventListener('DOMContentLoaded', async () => {
    const userId = localStorage.getItem('user_id') || 1; // Default to 1 for testing
    const EditProfile = document.getElementById('change-picture-btn');

    if (!userId) {
        alert('You need to log in to view this page.');
        window.location.href = '/login.php'; // Redirect to the login page
        return;
    }

    try {
        const userData = await fetchData('http://localhost/test_api/user_api/fetch_user_profile.php', { user_id: userId });
        populateUserProfile(userData);

        if (userData['game-own'] && userData['game-own'].length > 0) {
            const gamesData = await fetchData('http://localhost/test_api/user_api/fetch_games.php', { game_ids: userData['game-own'] });
            populateGamesOwned(gamesData);
        } else {
            document.getElementById('games-owned').innerHTML = '<p class="text-center text-muted">No games purchased yet.</p>';
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }

    // Redirect to specific pages for changes
    EditProfile.addEventListener('click', () => {
        window.location.href = '/Edit_profile';
    });
});

// Utility function to make POST requests
async function fetchData(url, payload) {
    const response = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
    });

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    return response.json();
}

// Populate user profile details
function populateUserProfile(user) {
    document.getElementById('user-avatar').src = user.avatar || '/public/assets/images/default-avatar.png';
    document.getElementById('user-name').textContent = user.name || 'Unknown';
    document.getElementById('user-email').textContent = user.email || 'Unknown';
}

// Populate games owned
function populateGamesOwned(games) {
    const gamesOwnedContainer = document.getElementById('games-owned');
    gamesOwnedContainer.innerHTML = ''; // Clear existing content

    games.forEach((game) => {
        const gameCard = document.createElement('div');
        gameCard.className = 'col-md-4';

        gameCard.innerHTML = `
        <a href="/app/views/games/detail.php?id=${game.id}">
            <div class="card text-white">
                <img src="${game.thumbnail}" class="card-img-top" alt="${game.title}">
                <div class="card-body">
                    <h5 class="card-title">${game.title}</h5>
                    <p class="card-text">${game.price || 'Free'}</p>
                    <button type="button" class="btn btn-success">Install now</button>
                </div>
            </div>
        </a>
        `;

        gamesOwnedContainer.appendChild(gameCard);
    });
}
