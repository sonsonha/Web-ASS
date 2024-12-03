<?php include(__DIR__ . '/../templates/header.php'); ?>
<style>
    body {
        background-color: #121212; /* Nền đen */
        color: white; /* Chữ trắng */
        font-family: Arial, sans-serif; /* Font chữ dễ đọc */
    }
    .notification {
        display: none;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin-top: 20px;
        border-radius: 5px;
    }
</style>

<!-- Navbar giống file home.html -->
<div class="container mt-5">
    <h1>Game Support</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form id="supportForm" method="POST">
                <div class="form-group">
                    <label for="email">Email cá nhân:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="game_name">Tên game:</label>
                    <input type="text" class="form-control" id="game_name" name="game_name" required>
                </div>


                <div class="form-group">
                    <label for="description">Mô tả lỗi:</label>
                    <textarea class="form-control" id="description" name="description" rows="6" maxlength="1000" required></textarea>
                    <small class="form-text text-muted">Mô tả lỗi (tối đa 1000 ký tự)</small>
                </div>

                <button type="submit" class="btn btn-primary">Gửi</button>
            </form>

            <!-- Thông báo gửi thành công -->
            <div id="successNotification" class="notification">
                Báo cáo của bạn đã được gửi đi.
            </div>
        </div>
    </div>
</div>

<script>
    // Khi form được submit
    document.getElementById('supportForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Ngừng hành động mặc định của form (submit lại trang)

        // Lấy thông tin từ các input
        const formData = {
            email: document.getElementById('email').value,
            game_name: document.getElementById('game_name').value,
            description: document.getElementById('description').value
        };

        // Gửi dữ liệu về backend dưới dạng JSON
        fetch('process_support', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            // Kiểm tra nếu báo cáo thành công
            if (data.success) {
                // Hiển thị thông báo thành công
                document.getElementById('successNotification').style.display = 'block';
                // Reset form
                document.getElementById('supportForm').reset();
                // Ẩn thông báo sau 3 giây
                setTimeout(() => {
                    document.getElementById('successNotification').style.display = 'none';
                }, 3000);
            } else {
                // Xử lý lỗi nếu có
                alert('Có lỗi xảy ra, vui lòng thử lại!');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi gửi dữ liệu!');
        });
    });
</script>
