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
            color: white !important;
        }

        .card {
            background-color: #2a2b38 !important;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 20px;
            color: white !important;
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
                    <h3 class="text-center">Change password</h3>

                    <!-- Change Password Section -->
                    <hr class="my-4">

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
    const changePasswordForm = document.getElementById('change-password-form');
    const passwordFeedback = document.getElementById('password-feedback');
    const updatePasswordBtn = document.getElementById('update-password-btn');

    // Update password
    updatePasswordBtn.addEventListener('click', async () => {
        const email = localStorage.getItem('email'); // Lấy email từ localStorage hoặc thay đổi nếu bạn sử dụng cách khác để lấy email
        const oldPassword = document.getElementById('old-password').value.trim();
        const newPassword = document.getElementById('new-password').value.trim();
        const confirmPassword = document.getElementById('confirm-password').value.trim();

        if (!email) {
            alert('Email không tồn tại, vui lòng kiểm tra lại!');
            return;
        }

        if (newPassword !== confirmPassword) {
            passwordFeedback.textContent = "Passwords do not match!";
            passwordFeedback.classList.remove('d-none');
            return;
        }

        passwordFeedback.classList.add('d-none'); // Ẩn thông báo lỗi

        try {
            const response = await fetch('/../api/changed_password.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    email: email,
                    current_password: oldPassword,
                    new_password: newPassword,
                }),
            });

            const result = await response.json();

            if (response.ok && result.status === 'success') {
                alert('Password changed successfully!');
                changePasswordForm.reset(); // Reset form sau khi đổi mật khẩu thành công
            } else {
                passwordFeedback.textContent = result.message || 'Failed to change password.';
                passwordFeedback.classList.remove('d-none');
            }
        } catch (error) {
            console.error('Error updating password:', error);
            passwordFeedback.textContent = 'An unexpected error occurred. Please try again.';
            passwordFeedback.classList.remove('d-none');
        }
    });
});

    </script>
</body>
</html>
