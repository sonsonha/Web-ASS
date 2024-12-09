<div id="manageUsers" class="content-section active">
    <h2 class="mt-10">Manage Users</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Reputation Points</th>
                <th>Actions</th>
                <th>Manage</th>
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
// Function to fetch users from the API
async function fetchUsers() {
    try {
        const response = await fetch('/../api/get_all_users.php');

        if (response.ok) {
            // Try to parse the response as JSON
            const data = await response.json();
            
            if (data.status === "success") {
                populateUserTable(data.data);
            } else {
                alert('Error fetching users: ' + data.message);
            }
        } else {
            alert('Failed to fetch users. Please try again later.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error fetching users. Please check your connection.');
    }
}

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
            <td>${user.reputation_points}</td>
            <td>${user.status ? 'Active' : 'Banned'}</td>
            <td>
                <button class="btn btn-info btn-sm" onclick="viewUser(${user.id})">View</button>
                <button class="btn btn-primary btn-sm" onclick="editUser(${user.id})">Edit</button>
                <button class="btn btn-danger btn-sm" id="banBtn_${user.id}" onclick="toggleBanUser('${user.username}')">
                    ${user.status ? 'Ban' : 'Unban'}
                </button>
                <button class="btn btn-secondary btn-sm" onclick="deleteUser(${user.id})">Delete</button>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Function to toggle ban/unban status of a user
async function toggleBanUser(username) {
    try {
        const response = await fetch('/../api/toggle_status_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                username: username,
            }),
        });

        const data = await response.json();
        if (data.status === 'success') {
            // Fetch the updated user list again after status toggle
            fetchUsers(); // This will refresh the users list after status change
            alert(`User status has been ${data.newStatus ? 'activated' : 'banned'}!`);
        } else {
            alert('Failed to toggle user status: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Error toggling user status. Please check your connection.');
    }
}


// Function to open the view modal
function viewUser(id) {
    const user = mockUsers.find((u) => u.id === id);
    if (user) {
        document.getElementById('viewUserDetails').innerText = `Username: ${user.username}\nEmail: ${user.email}\nReputation: ${user.reputation_points}\nActive: ${user.status ? 'Active' : 'Banned'}`;
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
        document.getElementById('editReputation').value = user.reputation_points;

        // Handle form submission
        document.getElementById('editUserForm').onsubmit = function (e) {
            e.preventDefault();
            user.username = document.getElementById('editUsername').value;
            user.reputation_points = parseInt(document.getElementById('editReputation').value, 10);
            populateUserTable(mockUsers);
            closeModal('editModal');
        };

        document.getElementById('editModal').style.display = 'block';
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
        fetchUsers();
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