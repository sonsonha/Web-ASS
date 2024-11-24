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
        <button class="submit" type="button" id="loginButton">Login</button>
        <p class="signin">Don't have an account? <a href="/app/views/auth/register.php">Sign up</a></p>
    </form>
</div>


<script>
    // Mock Data - Danh sách tài khoản mẫu
    const mockUsers = [{
            email: "admin@gmail.com",
            password: "1",
            profile: {
                username: "testuser",
                email: "test@example.com",
                role: "admin",
                phone_number: "0123456789",
            },
        },
        {
            email: "user@gmail.com",
            password: "1",
            profile: {
                username: "user123",
                email: "user@example.com",
                role: "user",
                phone_number: "0987654321",
            },
        },
    ];

    // Xử lý sự kiện login
    document.getElementById('loginButton').addEventListener('click', () => {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!email || !password) {
            alert('Please enter your email and password!');
            return;
        }

        // Kiểm tra thông tin trong mock data
        const user = mockUsers.find(
            (u) => u.email === email && u.password === password
        );

        if (user) {
            // Lưu thông tin vào localStorage
            localStorage.setItem('username', user.profile.username);
            localStorage.setItem('email', user.profile.email);
            localStorage.setItem('role', user.profile.role);
            localStorage.setItem('phone_number', user.profile.phone_number);

            // Chuyển hướng sau khi đăng nhập thành công
            window.location.href = 'home';
        } else {
            alert('Invalid email or password!');
        }
    });

    // try {
    //     const response = await fetch('http://localhost:8080/login', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({
    //             email,
    //             password
    //         }),
    //     });

    //     const data = await response.json();
    //     if (response.ok) {

    //         localStorage.setItem('accessToken', data.accessToken);
    //         localStorage.setItem('refreshToken', data.refreshToken);
    //         localStorage.setItem('username', data.profile.username);
    //         localStorage.setItem('email', data.profile.email);
    //         localStorage.setItem('role', data.profile.role);
    //         localStorage.setItem('phone_number', data.profile.phone_number);
    //         // alert(`
    //         //     Access Token: ${localStorage.getItem('accessToken')}
    //         //     Username: ${localStorage.getItem('username')}
    //         //     Email: ${localStorage.getItem('email')}
    //         //     Role: ${localStorage.getItem('role')}
    //         //     Phone Number: ${localStorage.getItem('phone_number')}
    //         // `);
    //         window.location.href = 'home';
    //     } else {
    //         alert(data.error || 'Login Failed!');
    //     }
    // } catch (error) {
    //     console.error('Error:', error);
    //     alert('An error occurred, please try again!');
    // }
    // });
</script>