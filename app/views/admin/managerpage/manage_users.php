<div id="manageUsers" class="content-section active">
    <h2 class="mt-10">Manage Users</h2>
    <table class="table table-striped table-dark">
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
        <tbody id="userTableBody">
            <!-- Rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<script>
    // Mock Data (giả lập dữ liệu từ backend)
    const mockUsers = [
        { id: 1, username: 'player1', email: 'player1@example.com', inGameName: 'PlayerOne', reputation: 85 },
        { id: 2, username: 'player2', email: 'player2@example.com', inGameName: 'PlayerTwo', reputation: 50 },
        { id: 3, username: 'player3', email: 'player3@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 4, username: 'player4', email: 'player4@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 5, username: 'player5', email: 'player5@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 6, username: 'player6', email: 'player6@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 7, username: 'player7', email: 'player7@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 8, username: 'player8', email: 'player8@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 9, username: 'player9', email: 'player9@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 10, username: 'player10', email: 'player10@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 11, username: 'player11', email: 'player11@example.com', inGameName: 'PlayerThree', reputation: 120 },
        { id: 12, username: 'player12', email: 'player12@example.com', inGameName: 'PlayerThree', reputation: 120 },
    ];

    // Hàm hiển thị dữ liệu người dùng
    function populateUserTable(users) {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = ''; // Xóa nội dung cũ

        users.forEach((user) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.inGameName}</td>
                <td>${user.reputation}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="viewUser(${user.id})">View</button>
                    <button class="btn btn-primary btn-sm" onclick="editUser(${user.id})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="banUser(${user.id})">Ban</button>
                    <button class="btn btn-secondary btn-sm" onclick="deleteUser(${user.id})">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Hàm xử lý khi bấm "View"
    function viewUser(id) {
        const user = mockUsers.find((u) => u.id === id);
        if (user) {
            alert(`Viewing User:\nUsername: ${user.username}\nEmail: ${user.email}\nIn-game Name: ${user.inGameName}`);
        } else {
            alert('User not found!');
        }
    }

    // Hàm xử lý khi bấm "Edit"
    function editUser(id) {
        const user = mockUsers.find((u) => u.id === id);
        if (user) {
            const newUsername = prompt('Enter new username:', user.username);
            const newReputation = prompt('Enter new reputation points:', user.reputation);
            if (newUsername) user.username = newUsername;
            if (newReputation) user.reputation = parseInt(newReputation, 10);

            populateUserTable(mockUsers); // Cập nhật bảng
        } else {
            alert('User not found!');
        }
    }

    // Hàm xử lý khi bấm "Ban"
    function banUser(id) {
        const user = mockUsers.find((u) => u.id === id);
        if (user) {
            user.reputation = 0; // Set điểm danh tiếng về 0
            alert(`User "${user.username}" has been banned!`);
            populateUserTable(mockUsers); // Cập nhật bảng
        } else {
            alert('User not found!');
        }
    }

    // Hàm xử lý khi bấm "Delete"
    function deleteUser(id) {
        const userIndex = mockUsers.findIndex((u) => u.id === id);
        if (userIndex !== -1) {
            mockUsers.splice(userIndex, 1); // Xóa người dùng khỏi danh sách
            alert('User has been deleted!');
            populateUserTable(mockUsers); // Cập nhật bảng
        } else {
            alert('User not found!');
        }
    }

    // Giả lập tải dữ liệu từ backend và hiển thị
    document.addEventListener('DOMContentLoaded', () => {
        // Giả lập độ trễ tải dữ liệu
        setTimeout(() => {
            populateUserTable(mockUsers);
        }, 500);
    });
</script>