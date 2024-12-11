<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../assets/css/user_profile.css">
</head>
<body>
    <!-- Include Header -->
    <?php include __DIR__ . '/../layouts/header.php'; ?>

    <main class="container my-5">
        <h1 class="text-center text-white mb-4">User Profile</h1>
        <div class="row justify-content-center">
            <!-- User Information -->
            <div class="col-md-6 p-4 rounded" style="background-color: #1b2838;">
                <div class="text-center mb-3">
                    <img id="user-avatar" src="/public/assets/images/default-avatar.png" alt="User Avatar" class="rounded-circle" width="150">
                </div>
                <!-- Moved Edit button here -->
                <div class="text-center mb-3">
                    <button id="change-picture-btn" class="btn btn-outline-light btn-sm">Edit Profile</button>
                </div>

                <div class="text-center mb-3">
                    <h3 id="user-name">User Name</h3>
                </div>
                <div class="text">
                    <p><strong>Username:</strong> <span id="user-username">Loading...</span></p>
                </div>
                <div class="mb-3 text">
                    <p><strong>Email:</strong> <span id="user-email">Loading...</span></p>
                </div>
                <div class="mb-3 text">
                    <p><strong>Phone number:</strong> <span id="user-phone">Loading...</span></p>
                </div>
                <div class="mb-3 text">
                    <p><strong>Birth:</strong> <span id="user-birth">Loading...</span></p>
                </div>
                <!-- Editable Form (Initially Hidden) -->
                <div id="edit-profile-form" class="d-none">
                    <form id="profile-form">
                        <div class="mb-3">
                            <label for="edit-username" class="form-label">Username</label>
                            <input type="text" id="edit-username" class="form-control" placeholder="Enter your username">
                            <div class="invalid-feedback">Username is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-phone" class="form-label">Phone</label>
                            <input type="text" id="edit-phone" class="form-control" placeholder="Enter your phone">
                            <div class="invalid-feedback">Phone is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-birth" class="form-label">Birth</label>
                            <input type="date" id="edit-birth" class="form-control">
                            <div class="invalid-feedback">Birth date is required.</div>
                        </div>
                        <div class="mb-3">
                            <label for="edit-avatar" class="form-label">Profile Image URL</label>
                            <input type="url" id="edit-avatar" class="form-control" placeholder="Enter image URL">
                        </div>
                        <button type="button" class="btn btn-success" id="update-btn">Update</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Games Owned Section -->
        <section class="mt-5">
            <h2 class="text-white mb-4">Games Owned</h2>
            <div id="games-owned" class="row g-4">
                <!-- Games will be dynamically populated -->
            </div>
        </section>
    </main>

    <!-- Include Footer -->
    <?php include __DIR__ . '/../layouts/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Profile JS -->
    <!-- <script src="/../assets/js/user_profile.js"></script> -->

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const userId = localStorage.getItem('user_id') || 1; // Default to 1 for testing
            const EditProfile = document.getElementById('change-picture-btn');
            const updateBtn = document.getElementById('update-btn');
            const editProfileForm = document.getElementById('edit-profile-form');
            const profileForm = document.getElementById('profile-form');

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

            // Edit Profile button click handler
            EditProfile.addEventListener('click', () => {
                // Toggle the editable form (show/hide)
                editProfileForm.classList.toggle('d-none');
                if (!editProfileForm.classList.contains('d-none')) {
                    document.getElementById('edit-username').value = document.getElementById('user-name').innerText;
                    document.getElementById('edit-email').value = document.getElementById('user-email').innerText;
                    document.getElementById('edit-phone').value = document.getElementById('user-phone').innerText;
                    document.getElementById('edit-birth').value = document.getElementById('user-birth').innerText;
                    document.getElementById('edit-avatar').value = document.getElementById('user-avatar').src;
                }
            });

            // Update button click handler
            updateBtn.addEventListener('click', async () => {
                const username = document.getElementById('edit-username').value;
                const phone = document.getElementById('edit-phone').value;
                const birth = document.getElementById('edit-birth').value;
                let avatar = document.getElementById('edit-avatar').value || '/public/assets/images/default-avatar.png'; // Default profile image if empty

                // Validate required fields
                if (!username || !phone || !birth) {
                    if (!username) {
                        document.getElementById('edit-username').classList.add('is-invalid');
                    }
                    if (!phone) {
                        document.getElementById('edit-phone').classList.add('is-invalid');
                    }
                    if (!birth) {
                        document.getElementById('edit-birth').classList.add('is-invalid');
                    }
                    return;
                }

                // Send updated data to the backend
                try {
                    const response = await fetchData('http://localhost/test_api/user_api/update_user_profile.php', {
                        user_id: userId,
                        username,
                        phone,
                        birth,
                        avatar,
                    });
                    
                    if (response.success) {
                        alert('Profile updated successfully!');
                        window.location.reload(); // Reload the page to reflect updated data
                    } else {
                        alert('Failed to update profile.');
                    }
                } catch (error) {
                    console.error('Error updating profile:', error);
                    alert('An error occurred while updating profile.');
                }
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
            document.getElementById('user-phone').textContent = user.phone || 'Unknown';
            document.getElementById('user-birth').textContent = user.birth || 'Unknown';
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
    </script>
</body>
</html>
