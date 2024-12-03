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
                <th>Active</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- Rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<!-- View Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('viewModal')">&times;</span>
        <h2>View User</h2>
        <p id="viewUserDetails"></p>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editModal')">&times;</span>
        <h2>Edit User</h2>
        <form id="editUserForm">
            <div class="form-group">
                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="editReputation">Reputation Points:</label>
                <input type="number" id="editReputation" name="reputation" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mock Data
    const mockUsers = [{
            id: 1,
            username: 'player1',
            email: 'player1@example.com',
            inGameName: 'PlayerOne',
            reputation: 85,
            isActive: true
        },
        {
            id: 2,
            username: 'player2',
            email: 'player2@example.com',
            inGameName: 'PlayerTwo',
            reputation: 50,
            isActive: true
        },
        {
            id: 3,
            username: 'player3',
            email: 'player3@example.com',
            inGameName: 'PlayerThree',
            reputation: 120,
            isActive: true
        },
        {
            id: 4,
            username: 'player4',
            email: 'player4@example.com',
            inGameName: 'PlayerThree',
            reputation: 120,
            isActive: true
        },
        {
            id: 5,
            username: 'player5',
            email: 'player5@example.com',
            inGameName: 'PlayerThree',
            reputation: 120,
            isActive: true
        },
    ];

    // Function to populate the user table
    function populateUserTable(users) {
        const tbody = document.getElementById('userTableBody');
        tbody.innerHTML = '';

        users.forEach((user) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.inGameName}</td>
                <td>${user.reputation}</td>
                <td>${user.isActive? 'Active' : 'Banned'}</td>
                <td>
                    <button class="btn btn-info btn-sm" onclick="viewUser(${user.id})">View</button>
                    <button class="btn btn-primary btn-sm" onclick="editUser(${user.id})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="banUser(${user.id})" ${!user.isActive ? 'disabled' : ''}>Ban</button>
                    <button class="btn btn-secondary btn-sm" onclick="deleteUser(${user.id})">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Function to open the view modal
    function viewUser(id) {
        const user = mockUsers.find((u) => u.id === id);
        if (user) {
            document.getElementById('viewUserDetails').innerText = `Username: ${user.username}\nEmail: ${user.email}\nIn-game Name: ${user.inGameName}\nReputation: ${user.reputation}\nActive:${user.isActive? 'Active' : 'Banned'}`;
            document.getElementById('viewModal').style.display = 'block';
        } else {
            alert('User not found!');
        }
    }

    // Function to open the edit modal
    function editUser(id) {
        const user = mockUsers.find((u) => u.id === id);
        if (user) {
            document.getElementById('editUsername').value = user.username;
            document.getElementById('editReputation').value = user.reputation;

            // Handle form submission
            document.getElementById('editUserForm').onsubmit = function(e) {
                e.preventDefault();
                user.username = document.getElementById('editUsername').value;
                user.reputation = parseInt(document.getElementById('editReputation').value, 10);
                populateUserTable(mockUsers);
                closeModal('editModal');
            };

            document.getElementById('editModal').style.display = 'block';
        } else {
            alert('User not found!');
        }
    }

    // Function to ban a user
    function banUser(id) {
        const user = mockUsers.find((u) => u.id === id);
        if (user) {
            user.isActive = false; // Mark as banned (inactive)
            alert(`User "${user.username}" has been banned!`);
            populateUserTable(mockUsers);
        } else {
            alert('User not found!');
        }
    }

    // Function to delete a user
    function deleteUser(id) {
        const userIndex = mockUsers.findIndex((u) => u.id === id);
        if (userIndex !== -1) {
            mockUsers.splice(userIndex, 1);
            alert('User has been deleted!');
            populateUserTable(mockUsers);
        } else {
            alert('User not found!');
        }
    }

    // Function to close modals
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Mock data load
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            populateUserTable(mockUsers);
        }, 500);
    });
</script>

<style>
    /* Simple modal styling */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
        padding-top: 60px;
    }

    .modal-content {
        background-color: #000;
        margin: 5% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 20%;
    }

    .close {
        color: #ff0000;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 30px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>