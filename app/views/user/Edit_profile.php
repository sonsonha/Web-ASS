<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1b2838 !important;
            color: white;
        }

        .card {
            background-color: #2a2b38 !important;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 20px;
        }

        .drag-area {
            border: 2px dashed #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .drag-area.drag-over {
            background-color: #3b556d;
        }

        .btn {
            margin-top: 10px;
        }

        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center">Edit Profile</h3>
                    <form id="edit-profile-form">
                        <!-- Profile Picture Section -->
                        <div class="mb-3">
                            <h5>Choose New Profile Picture</h5>
                            <div class="drag-area" id="drag-area">
                                <p>Drag and drop an image or click to upload</p>
                                <input type="file" id="profile-picture" class="form-control d-none">
                            </div>
                            <img id="preview-image" class="img-fluid mt-3" src="/public/assets/images/default-avatar.png" alt="Profile Picture" style="display: none; max-width: 200px;">
                        </div>

                        <!-- Username Section -->
                        <div class="mb-3">
                            <label for="username" class="form-label">New username</label>
                            <input type="text" id="username" class="form-control" placeholder="Enter new username">
                            <small id="username-feedback" class="text-danger d-none">Username cannot be the same as the old one</small>
                        </div>

                        <!-- Email Section -->
                        <div class="mb-3">
                            <label for="email" class="form-label">New email</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter new email">
                            <small id="email-feedback" class="text-danger d-none">Email cannot be the same as the old one</small>
                        </div>

                        <!-- Save Changes Button -->
                        <button type="submit" class="btn btn-success">Save Changes</button>
                        <small id="general-feedback" class="text-danger d-none">Please make at least one change</small>
                    </form>

                    <!-- Change Password Section -->
                    <hr class="my-4">
                    <h5>Change Password</h5>
                    <form id="change-password-form">
                        <div class="mb-3">
                            <label for="old-password" class="form-label">Old Password</label>
                            <input type="password" id="old-password" class="form-control" placeholder="Enter old password">
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label">New Password</label>
                            <input type="password" id="new-password" class="form-control" placeholder="Enter new password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Confirm New Password</label>
                            <input type="password" id="confirm-password" class="form-control" placeholder="Confirm new password">
                        </div>
                        <p id="password-feedback" class="text-danger d-none">Your passwords do not match!</p>
                        <button type="button" class="btn btn-warning" id="update-password-btn">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const dragArea = document.getElementById('drag-area');
            const profilePictureInput = document.getElementById('profile-picture');
            const previewImage = document.getElementById('preview-image');
            const editProfileForm = document.getElementById('edit-profile-form');
            const changePasswordForm = document.getElementById('change-password-form');
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const usernameFeedback = document.getElementById('username-feedback');
            const emailFeedback = document.getElementById('email-feedback');
            const generalFeedback = document.getElementById('general-feedback');
            const passwordFeedback = document.getElementById('password-feedback');
            const updatePasswordBtn = document.getElementById('update-password-btn');

            // Mock current user data from local storage
            const currentUsername = localStorage.getItem('username') || 'current_user';
            const currentEmail = localStorage.getItem('email') || 'current@example.com';

            // Drag and Drop functionality
            dragArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                dragArea.classList.add('drag-over');
            });

            dragArea.addEventListener('dragleave', () => {
                dragArea.classList.remove('drag-over');
            });

            dragArea.addEventListener('drop', (e) => {
                e.preventDefault();
                dragArea.classList.remove('drag-over');
                const file = e.dataTransfer.files[0];
                if (file) {
                    profilePictureInput.files = e.dataTransfer.files;
                    displayImage(file);
                }
            });

            dragArea.addEventListener('click', () => {
                profilePictureInput.click();
            });

            profilePictureInput.addEventListener('change', () => {
                const file = profilePictureInput.files[0];
                if (file) {
                    displayImage(file);
                }
            });

            function displayImage(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            // Save profile changes
            editProfileForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const newUsername = usernameInput.value.trim();
                const newEmail = emailInput.value.trim();

                let hasChanges = false;

                usernameFeedback.classList.add('d-none');
                emailFeedback.classList.add('d-none');
                generalFeedback.classList.add('d-none');

                if (newUsername && newUsername !== currentUsername) {
                    hasChanges = true;
                } else if (newUsername === currentUsername) {
                    hasChanges = true;
                    usernameFeedback.classList.remove('d-none');
                }

                if (newEmail && newEmail !== currentEmail) {
                    hasChanges = true;
                } else if (newEmail === currentEmail) {
                    emailFeedback.classList.remove('d-none');
                }

                if (!hasChanges && !profilePictureInput.files.length) {
                    generalFeedback.textContent = 'Please make at least one change';
                    generalFeedback.classList.remove('d-none');
                    return;
                }

                const formData = new FormData();
                formData.append('user_id', localStorage.getItem('user_id'));
                if (newUsername && newUsername !== currentUsername) formData.append('username', newUsername);
                if (newEmail && newEmail !== currentEmail) formData.append('email', newEmail);
                if (profilePictureInput.files[0]) formData.append('avatar', profilePictureInput.files[0]);

                fetch('test_api/update_profile.php', {
                    method: 'POST',
                    body: formData,
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Profile updated successfully!');
                    } else {
                        alert('Failed to update profile.');
                    }
                })
                .catch((error) => console.error('Error updating profile:', error));
            });

            // Update password
            updatePasswordBtn.addEventListener('click', () => {
                const oldPassword = document.getElementById('old-password').value;
                const newPassword = document.getElementById('new-password').value;
                const confirmPassword = document.getElementById('confirm-password').value;

                if (newPassword !== confirmPassword) {
                    passwordFeedback.textContent = "Passwords do not match!";
                    passwordFeedback.classList.remove('d-none');
                    return;
                }

                fetch('/change_password.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        user_id: localStorage.getItem('user_id'),
                        old_password: oldPassword,
                        new_password: newPassword,
                    }),
                })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Password changed successfully!');
                        passwordFeedback.classList.add('d-none');
                        changePasswordForm.reset();
                    } else {
                        passwordFeedback.textContent = data.message || 'Failed to change password.';
                        passwordFeedback.classList.remove('d-none');
                    }
                })
                .catch((error) => console.error('Error updating password:', error));
            });
        });
    </script>
</body>
</html>
