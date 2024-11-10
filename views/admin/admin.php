<?php include(__DIR__ . '/../templates/header.php'); ?>


<div class="container mt-5">
    <h1>Admin - User Management</h1>
    <table class="table table-striped table-dark mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>In-game Name</th>
                <th>Reputation Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample Data -->
            <tr>
                <td>1</td>
                <td>player1</td>
                <td>player1@example.com</td>
                <td>PlayerOne</td>
                <td>85</td>
                <td>
                    <button class="btn btn-danger btn-sm">Ban</button>
                    <button class="btn btn-warning btn-sm">Warn</button>
                    <button class="btn btn-success btn-sm">Reward</button>
                </td>
            </tr>
            <!-- Repeat for more users -->
        </tbody>
    </table>
</div>

<?php include(__DIR__ . '/../templates/footer.php'); ?>