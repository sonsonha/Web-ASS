<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #1a1a1a;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
    }

    .form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 350px;
        padding: 20px;
        border-radius: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #1a1a1a;
        color: #fff;
        border: 1px solid #333;
    }

    .title {
        font-size: 28px;
        font-weight: 600;
        letter-spacing: -1px;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 30px;
        color: #FFA203;
    }

    .title::before,
    .title::after {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        border-radius: 50%;
        left: 0px;
        background-color: #FFA203;
    }

    .title::after {
        animation: pulse 1s linear infinite;
    }

    @keyframes pulse {
        from {
            transform: scale(0.9);
            opacity: 1;
        }

        to {
            transform: scale(1.8);
            opacity: 0;
        }
    }

    .message,
    .signin {
        font-size: 14.5px;
        color: rgba(255, 255, 255, 0.7);
    }

    .signin {
        text-align: center;
    }

    .signin a {
        color: #00bfff;
        text-decoration: none;
    }

    .signin a:hover {
        text-decoration: underline;
    }

    .form label {
        position: relative;
        display: block;
    }

    .form label .input {
        background-color: #333;
        color: #fff;
        width: 100%;
        padding: 10px;
        outline: none;
        border: 1px solid rgba(105, 105, 105, 0.397);
        border-radius: 10px;
        font-size: 13px;
    }

    .form label .input+span {
        position: absolute;
        left: 10px;
        top: 30px;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.5);
        transition: 0.3s;
    }

    .form label .input:focus+span,
    .form label .input:valid+span {
        top: -15px;
        font-size: 12px;
        color: #00bfff;
    }

    .submit {
        border: none;
        padding: 10px;
        border-radius: 10px;
        background-color: #00bfff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .submit:hover {
        background-color: #00bfff96;
    }
</style>

<div class="container">

    <form class="form" id="loginForm">
        <p class="title">Login</p>
        <p class="message">Welcome! Please login to your account.</p>
        <label>
            <input class="input" type="text" id="email">
            <span>Email</span>
        </label>
        <label>
            <input class="input" type="password" id="password">
            <span>Password</span>
        </label>
        <label>
            <input type="checkbox" id="rememberMe" style="margin-right: 10px;"> Remember me
        </label>
        <button class="submit" type="button" id="loginButton">Login</button>
        <p class="signin">Don't have an account? <a href="register">Sign up</a></p>
    </form>

</div>

<script>
    // Xử lý sự kiện login
    document.getElementById('loginButton').addEventListener('click', async () => {
        console.log("Login button clicked");
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const rememberMe = document.getElementById('rememberMe').checked; // Kiểm tra "Remember me"

        if (!email || !password) {
            alert('Please enter your email and password!');
            return;
        }

        try {
            // Gửi dữ liệu tới server với định dạng yêu cầu
            const response = await fetch('/../api/login_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    action: 'login',
                    email: email,
                    password: password
                }),
            });

            const data = await response.json();
            console.log(data);
            if (response.ok) {
                // Lưu thông tin vào localStorage
                localStorage.setItem('isLoggedIn', true);
                localStorage.setItem('id', data.user.id);
                localStorage.setItem('username', data.user.username);
                localStorage.setItem('email', data.user.email);
                localStorage.setItem('role', data.user.role);
                localStorage.setItem('phone_number', data.user.phone_number);

                // Lưu thông tin vào cookies nếu "Remember me" được chọn
                if (rememberMe) {
                    document.cookie = `email=${email}; max-age=604800; path=/`; // Lưu email trong cookie 1 tuần
                    document.cookie = `password=${password}; max-age=604800; path=/`; // Lưu mật khẩu trong cookie 1 tuần
                } else {
                    // Xóa cookie nếu "Remember me" không được chọn
                    document.cookie = `email=; max-age=0; path=/`;
                    document.cookie = `password=; max-age=0; path=/`;
                }

                // Chuyển hướng sau khi đăng nhập thành công
                if (data.user.role === 'Admin') {
                    window.location.href = 'admin';
                } else {
                    window.location.href = 'zerostress-game-store';
                }
                // window.location.href = 'zerostress-game-store';
            } else {
                alert(data.error || 'Login Failed!');
            }
        } catch (error) {
            alert('Invalid email or password!');
        }
    });

    // Hàm lấy giá trị của cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    // Kiểm tra cookies khi người dùng quay lại trang
    window.onload = function() {
        const email = getCookie('email');
        const password = getCookie('password');

        // Kiểm tra nếu có email và mật khẩu trong cookies
        if (email && password) {
            // Tự động điền vào form đăng nhập
            document.getElementById('email').value = email;
            document.getElementById('password').value = password;
            document.getElementById('rememberMe').checked = true; // Tích chọn "Remember me"
        }
    };
</script>
