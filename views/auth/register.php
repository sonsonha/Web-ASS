<?php include(__DIR__ . '/../templates/header.php'); ?>

<div class="container mt-5">
    <h2>Register</h2>
    <form action="register_process.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-dark">Register</button>
    </form>
</div>


<?php include(__DIR__ . '/../templates/footer.php'); ?>