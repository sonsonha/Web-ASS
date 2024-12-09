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
    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <main class="container my-5">
        <h1 class="text-center text-white mb-4">User Profile</h1>
        <div class="row justify-content-center">
            <!-- User Information -->
            <div class="col-md-6 p-4 rounded" style="background-color: #1b2838;">
                <div class="text-center mb-3">
                    <img id="user-avatar" src="/public/assets/images/default-avatar.png" alt="User Avatar" class="rounded-circle" width="150">
                    <button id="change-picture-btn" class="btn btn-outline-light btn-sm mt-3">Edit Profile</button>
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
    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Profile JS -->
    <script src="/../assets/js/user_profile.js"></script>

    <script>
        // Lấy userid từ URL
        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get('userid');

        if (userId) {
            // Gọi API lấy thông tin người dùng
            fetch(`/path/to/get_user_info.php?userid=${userId}`)
                .then(response => response.json())
                .then(data => {
                    // Kiểm tra nếu API trả về thông tin người dùng hợp lệ
                    if (data && data.success) {
                        // Cập nhật thông tin người dùng lên giao diện
                        document.getElementById('user-avatar').src = data.user.avatar || '/public/assets/images/default-avatar.png';
                        document.getElementById('user-name').innerText = data.user.name;
                        document.getElementById('user-username').innerText = data.user.username;
                        document.getElementById('user-email').innerText = data.user.email;
                        document.getElementById('user-phone').innerText = data.user.phone;
                        document.getElementById('user-birth').innerText = data.user.birth;

                        // Cập nhật phần Game Owned
                        const gamesOwned = document.getElementById('games-owned');
                        gamesOwned.innerHTML = ''; // Làm trống trước khi thêm dữ liệu mới
                        data.user.games.forEach(game => {
                            const gameElement = document.createElement('div');
                            gameElement.classList.add('col-md-4');
                            gameElement.innerHTML = `
                                <div class="card" style="background-color: #2b3945;">
                                    <img src="${game.coverImage}" alt="${game.name}" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">${game.name}</h5>
                                        <p class="card-text">${game.description}</p>
                                    </div>
                                </div>
                            `;
                            gamesOwned.appendChild(gameElement);
                        });
                    } else {
                        alert('User information could not be loaded.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching user info:', error);
                    alert('An error occurred while fetching user information.');
                });
        } else {
            alert('User ID is missing.');
        }
    </script>
</body>
</html>
