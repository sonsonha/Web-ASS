
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
<div>
    <style>
        /* Your existing styles... */
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
        <button class="submit" type="button" id="registerButton">Submit</button>
        <p class="signin">Already have an account? <a href="login">Login</a></p>
    </form>
</div>

<script>

document.getElementById('registerButton').addEventListener('click', async () => {
    const firstname = document.getElementById('firstname').value.trim();
    const lastname = document.getElementById('lastname').value.trim();
    const username = document.getElementById('username').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const confirmpassword = document.getElementById('confirmpassword').value.trim();

    // Check for empty fields
    if (!firstname || !lastname || !username || !email || !password || !confirmpassword) {
        alert('Please enter all the information!');
        return;
    }

    // Check if passwords match
    if (password !== confirmpassword) {
        alert('Passwords do not match!');
        return;
    }

    // Optional: Email format validation
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address!');
        return;
    }

    // Prepare the data for the API
    const userData = {
        firstName: firstname,
        lastName: lastname,
        username: username,
        email: email,
        password: password,
    };

    try {
        const response = await fetch('/../api/create_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(userData),
        });

        // Log the raw response to inspect what it contains
        const text = await response.text();
        console.log('Server Response:', text);

        let data;
        try {
            data = JSON.parse(text); // Parse the JSON response
        } catch (error) {
            console.error('Response is not valid JSON:', error);
            alert('The server returned an unexpected response. Please try again.');
            return;
        }

        if (response.ok) {
            // If successful, handle the response data
            alert(data.message || 'Registration successful!');
            window.location.href = 'login'; // Redirect to login page
        } else {
            // Handle error messages returned by the API
            alert(data.message || 'Registration failed. Please try again.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred, please try again!');
    }
});

</script>
