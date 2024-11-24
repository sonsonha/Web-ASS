<div id="manageContacts" class="content-section">
    <h2 class="mt-10">Manage Contacts</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="contactTableBody">
            <!-- Rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<script>
    // Mock Data for Contacts
    const mockContacts = [
        { id: 1, name: 'John Doe', email: 'johndoe@example.com', message: 'Need help with my account.', date: '2024-11-21' },
        { id: 2, name: 'Jane Smith', email: 'janesmith@example.com', message: 'I have a question about billing.', date: '2024-11-20' },
        { id: 3, name: 'Alice Brown', email: 'alicebrown@example.com', message: 'Can you reset my password?', date: '2024-11-19' },
    ];

    // Populate Contacts Table
    function populateContactTable(contacts) {
        const tbody = document.getElementById('contactTableBody');
        tbody.innerHTML = ''; // Clear existing rows

        contacts.forEach((contact) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${contact.id}</td>
                <td>${contact.name}</td>
                <td>${contact.email}</td>
                <td>${contact.message}</td>
                <td>${contact.date}</td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="replyToContact(${contact.id})">Reply</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteContact(${contact.id})">Delete</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Handle "Reply" Button Click
    function replyToContact(id) {
        const contact = mockContacts.find((c) => c.id === id);
        if (contact) {
            const replyMessage = prompt(`Reply to ${contact.name} (${contact.email}):`, '');
            if (replyMessage) {
                alert(`Your reply to ${contact.name}: "${replyMessage}" has been sent.`);
            }
        } else {
            alert('Contact not found!');
        }
    }

    // Handle "Delete" Button Click
    function deleteContact(id) {
        const contactIndex = mockContacts.findIndex((c) => c.id === id);
        if (contactIndex !== -1) {
            const confirmDelete = confirm(`Are you sure you want to delete the contact from ${mockContacts[contactIndex].name}?`);
            if (confirmDelete) {
                mockContacts.splice(contactIndex, 1); // Remove contact from mock data
                alert('Contact has been deleted.');
                populateContactTable(mockContacts); // Refresh the table
            }
        } else {
            alert('Contact not found!');
        }
    }

    // Simulate Fetching Data from Backend
    document.addEventListener('DOMContentLoaded', () => {
        // Simulate delay in loading data
        setTimeout(() => {
            populateContactTable(mockContacts);
        }, 500);
    });
</script>