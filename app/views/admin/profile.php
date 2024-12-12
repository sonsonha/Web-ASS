<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../assets/css/user_profile.css">
    <!-- Embedded CSS for styling -->
    <style>
        /* Add styles here */
        /* copy styles from the previous block */
    </style>
</head>
<body>
    <?php include __DIR__ . '/../layouts/header.php'; ?>

    <main class="container my-5">
        <h1 class="text-center text-white mb-4">My Profile</h1>
        <div class="row justify-content-center">
            <div class="col-md-6 p-4 rounded" style="background-color: #1b2838;">
                <div class="text-center mb-3">
                    <img id="user-avatar" src="/assets/images/default-avatar.jpg" alt="User Avatar" class="rounded-circle" width="150">
                </div>
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
                <div class="text">
                    <p><strong>Coins:</strong> <span id="user-coins">Loading...</span></p>
                </div>
            </div>
        </div>

        <section class="mt-5">
            <h2 class="text-white mb-4">Games Owned</h2>
            <div id="shopping-cart" class="row g-4">
                <!-- Game cards will be dynamically populated here -->
            </div>
        </section>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #2c3e50; color: #fff;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form id="editProfileForm">
                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Full name</label>
                                <input type="text" id="editUsername" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="editPhone" class="form-label">Phone</label>
                                <input type="text" id="editPhone" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="editBirth" class="form-label">Birth</label>
                                <input type="date" id="editBirth" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="editAvatar" class="form-label">Profile Image URL</label>
                                <input type="url" id="editAvatar" class="form-control">
                            </div>
                            <button type="button" class="btn btn-success" id="saveProfileBtn">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/../layouts/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Your JavaScript functions remain unchanged, adjusting only for styles
    </script>
</body>
</html>

    <!-- Include Footer -->
    <?php include __DIR__ . '/../layouts/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Profile JS -->
    <!-- <script src="/../assets/js/user_profile.js"></script> -->

    <script>
document.addEventListener('DOMContentLoaded', async () => {
    const userId = localStorage.getItem('id') || 1;

    if (!userId) {
        alert('You need to log in to view this page.');
        window.location.href = '/login.php'; // Redirect to login page if not logged in
        return;
    }


    try {
        const profileData = await fetchShoppingCart(userId);
        
        if (profileData) {
            const userData = profileData.data; // Extract the 'data' object from the response
            console.log(userData);
            populateUserProfile(userData);
            displayGames(userData.games || []);

            document.getElementById("change-picture-btn").addEventListener("click", () => {
                openEditProfileModal(userData);
            });

            document.getElementById("saveProfileBtn").addEventListener("click", saveProfileChanges);
        }
    } catch (error) {
        console.error('Error fetching data:', error);
    }
});

function openEditProfileModal(userData) {

    document.getElementById('editUsername').value = userData.full_name || '';
    document.getElementById('editPhone').value = userData.phone_number || '';
    document.getElementById('editBirth').value = userData.date_of_birth || '';
    document.getElementById('editAvatar').value = userData.avatar || '';
    // document.getElementById('user-coins').value = userData.coins;
    console.log(userData.coins);

    new bootstrap.Modal(document.getElementById('editProfileModal')).show();
}

async function saveProfileChanges() {
    const updatedProfile = {
        id: localStorage.getItem('id'),
        fullName: document.getElementById('editUsername').value,
        phone: document.getElementById('editPhone').value,
        birth: document.getElementById('editBirth').value,
        url_link: document.getElementById('editAvatar').value
    };

    // Replace the below URL with your actual API endpoint to update the profile
    try {
        const response = await fetch('/../api/get_update_profile.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updatedProfile)
        });

        const result = await response.json();
        if (result.status === 'success') {
            alert('Profile updated successfully!');
            window.location.reload(); // To reflect the updated data on the profile page
        } else {
            alert('Failed to update profile.');
        }
    } catch (error) {
        console.error('Error updating profile:', error);
        alert('An error occurred while updating profile.');
    }
}

async function fetchShoppingCart(userId) {
    try {
        const response = await fetch(`/../api/get_shoping_cart.php?id=${userId}`, { method: 'GET' });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        const cartData = await response.json();
        console.log(cartData); // Giúp bạn xem phản hồi dữ liệu
        return cartData;
    } catch (error) {
        console.error('Error fetching shopping cart:', error);
    }
    
    return null;
}

function populateUserProfile(user) {
    console.log(user.avatar); // Kiểm tra dữ liệu avatar nào đang được gán
    document.getElementById('user-avatar').src = user.avatar || '/assets/images/default-avatar.jpg';
    document.getElementById('user-name').textContent = user.full_name || 'ZeroMember';
    document.getElementById('user-username').textContent = user.username || 'Unknown';
    document.getElementById('user-email').textContent = user.email || 'Unknown';
    document.getElementById('user-phone').textContent = user.phone_number || 'Unknown';
    document.getElementById('user-birth').textContent = user.date_of_birth || 'Unknown';
    document.getElementById('user-coins').textContent = user.coins;
}

function displayGames(games) {
    const gamesOwnedContainer = document.getElementById('shopping-cart');

    if (games.length > 0) {
        gamesOwnedContainer.innerHTML = ''; // Clear any existing content

        games.forEach((game) => {
            const gameItem = document.createElement('div');
            gameItem.className = 'col-md-4';

            gameItem.innerHTML = `
                <div class="card text-white bg-dark mb-3">
                    <img src="${game.avt}" class="card-img-top" alt="${game.game_name}">
                    <div class="card-body">
                        <h5 class="card-title">${game.game_name}</h5>
                        <p class="card-text">${game.price ? game.price + ' USD' : 'Free'}</p>
                        <button type="button" class="btn btn-success">Install now</button>
                    </div>
                </div>
            `;

            gamesOwnedContainer.appendChild(gameItem);
        });
    } else {
        gamesOwnedContainer.innerHTML = '<p class="text-center text-muted">Your shopping cart is empty.</p>';
    }
}
    </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>

