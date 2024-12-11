<div>
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
                background-color: #1a1a1a;
                color: #fff;
                border: 1px solid #333;
                margin: 20px auto;
                transform: translate(-50%, -50%);
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

            .title::before {
                width: 18px;
                height: 18px;
            }

            .title::after {
                width: 18px;
                height: 18px;
                animation: pulse 1s linear infinite;
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

            .message,
            .signin {
                font-size: 14.5px;
                color: rgba(255, 255, 255, 0.7);
            }

            .signin {
                text-align: center;
            }

            .signin a:hover {
                text-decoration: underline royalblue;
            }

            .signin a {
                color: #00bfff;
            }

            .flex {
                display: flex;
                width: 100%;
                gap: 6px;
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

            .input {
                font-size: medium;
            }

            .submit {
                border: none;
                outline: none;
                padding: 10px;
                border-radius: 10px;
                color: #fff;
                font-size: 16px;
                transform: .3s ease;
                background-color: #00bfff;
            }

            .submit:hover {
                background-color: #00bfff96;
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
        </style>
        <form class="form">
            <p class="title">Sign up</p>
            <p class="message">Signup now and get full access to our web. </p>
            <div class="flex">
                <label>
                    <input class="input" type="text" id="firstname">
                    <span>Firstname</span>
                </label>

                <label>
                    <input class="input" type="text" id="lastname">
                    <span>Lastname</span>
                </label>
            </div>
            <label>
                <input class="input" type="text" id="username">
                <span>Username</span>
            </label>
            <label>
                <input class="input" type="text" id="email">
                <span>Email</span>
            </label>

            <label>
                <input class="input" type="password" id="password">
                <span>Password</span>
            </label>
            <label>
                <input class="input" type="password" id="confirmpassword">
                <span>Confirm password</span>
            </label>
            <button class="submit" type="button" id="regitsterButton">Submit</button>
            <p class="signin">Already have an acount ? <a href="login">Login</a> </p>
        </form>

    </div>

    <script>
        const mockUsers = [{
                username: "testuser",
                email: "test@example.com"
            },
            {
                username: "johndoe",
                email: "johndoe@example.com"
            },
        ];

        document.getElementById('regitsterButton').addEventListener('click', () => {
            const firstname = document.getElementById('firstname').value.trim();
            const lastname = document.getElementById('lastname').value.trim();
            const username = document.getElementById('username').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmpassword = document.getElementById('confirmpassword').value.trim();

            // Kiểm tra các trường trống
            if (!firstname || !lastname || !username || !email || !password || !confirmpassword) {
                alert('Please enter all the information!');
                return;
            }

            // Kiểm tra mật khẩu có khớp không
            if (password !== confirmpassword) {
                alert('Passwords do not match!');
                return;
            }

            // Kiểm tra xem email hoặc username đã tồn tại trong mockUsers chưa
            const isEmailTaken = mockUsers.some((user) => user.email === email);
            const isUsernameTaken = mockUsers.some((user) => user.username === username);

            if (isEmailTaken) {
                alert('This email is already in use!');
                return;
            }

            if (isUsernameTaken) {
                alert('This username is already in use!');
                return;
            }

            // Nếu mọi thứ hợp lệ, thêm người dùng mới vào danh sách mockUsers
            const newUser = {
                firstname,
                lastname,
                username,
                email,
                password,
            };
            mockUsers.push(newUser);

            // Lưu thông tin vào localStorage
            localStorage.setItem('username', username);
            localStorage.setItem('email', email);
            localStorage.setItem('firstname', firstname);
            localStorage.setItem('lastname', lastname);

            alert('Registration successful!');
            window.location.href = 'login';
        });
        // document.getElementById('regitsterButton').addEventListener('click', async () => {
        //     const firstname = document.getElementById('firstname').value.trim();
        //     const lastname = document.getElementById('lastname').value.trim();
        //     const username = document.getElementById('username').value.trim();
        //     const email = document.getElementById('email').value.trim();
        //     const password = document.getElementById('password').value.trim();
        //     const confirmpassword = document.getElementById('confirmpassword').value.trim();

        //     if (!firstname || !lastname || !username || !email || !password || !confirmpassword) {
        //         alert('Please enter your information!');
        //         return;
        //     }
        //     if (password !== confirmpassword) {
        //         alert('Passwords do not match!');
        //         return;
        //     }
        //     // console.log('Sending:', {
        //     //     email,
        //     //     password
        //     // });

        //     try {
        //         const response = await fetch('http://localhost:8080/register', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //             },
        //             body: JSON.stringify({
        //                 firstname,
        //                 lastname,
        //                 username,
        //                 email,
        //                 password,
        //             }),
        //         });

        //         const data = await response.json();j

        //         if (response.ok) {
        //             alert(data.message);
        //             localStorage.setItem('accessToken', data.accessToken);
        //             window.location.href = 'home';
        //         } else if (data.error) {
        //             if (data.error.includes('username')) {
        //                 alert('This username is already in use!');
        //             } else if (data.error.includes('email')) {
        //                 alert('This email is already in use!');
        //             } else {
        //                 alert(data.error || 'Registration Failed!');
        //             }
        //         } else {
        //             alert('An unknown error occurred. Please try again.');
        //         }
        //     } catch (error) {
        //         console.error('Error:', error);
        //         alert('An error occurred, please try again!');
        //     }
        // });
    </script>