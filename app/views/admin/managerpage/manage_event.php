<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background: #1a1a1a;
        color: #fff;
    }

    .content-section {
        margin: 20px;
    }

    .table-dark {
        color: #fff;
    }

    .btn-success,
    .btn-primary,
    .btn-danger,
    .btn-secondary {
        font-size: 14px;
    }

    #addEventModal {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: black;
        padding: 20px;
        border-radius: 10px;
        z-index: 1000;
        width: 90%;
        color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    #modalBackdrop {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    input,
    select,
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background: #333;
        color: white;
    }

    textarea {
        resize: vertical;
    }

    #addEventForm {
        display: flex;
        gap: 1%;
        color: #fff;
    }

    .form-column {
        flex: 1;
        border-right: 0.1px solid white;
        padding: 10px;
    }

    .form-column:last-child {
        border-right: none;
    }

    .modal-buttons {
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }
</style>
</head>

<body>
    <div id="manageEvent" class="content-section">
        <h2 class="mt-10">Manage Event</h2>
        <button class="btn btn-success mb-3" onclick="openAddEventModal()">Add Event</button>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Price</th>
                    <th>Discount (%)</th>
                    <th>Final Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="eventTableBody">
                <!-- Rows will be dynamically populated here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding Event -->
    <div id="addEventModal">
        <h3 style="text-align: center;">Add Event</h3>
        <form id="addEventForm">
            <!-- Column 1 -->
            <div class="form-column">
                <label for="eventName">Event Name:</label>
                <input type="text" id="eventName" required>

                <label for="eventPrice">Price:</label>
                <input type="number" id="eventPrice" required>

                <label for="eventDiscount">Discount (%):</label>
                <input type="number" id="eventDiscount" required>
            </div>

            <!-- Column 2 -->
            <div class="form-column">
                <label for="eventPicture">Picture URL:</label>
                <input type="text" id="eventPicture">

                <label for="eventVideo">Video URL:</label>
                <input type="text" id="eventVideo">

                <label for="eventGames">Games Associated (Comma-Separated):</label>
                <textarea id="eventGames" rows="3" placeholder="E.g., Game1, Game2"></textarea>
            </div>

            <!-- Column 3 -->
            <div class="form-column">
                <label for="eventStatus">Status:</label>
                <select id="eventStatus">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>

                <div class="modal-buttons">
                    <button type="button" class="btn btn-success" onclick="addEvent()">Add</button>
                    <button type="button" class="btn btn-secondary" onclick="closeAddEventModal()">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <div id="modalBackdrop"></div>

    <script>
        // Mock Data for Event
        const mockEvent = [{
                id: 1,
                name: 'Game Console Event',
                price: 299.99,
                discount: 10,
                finalPrice: 269.99,
                status: 'Active',
                picture: '',
                video: '',
                games: ''
            },
            {
                id: 2,
                name: 'Gaming Chair Giveaway',
                price: 0.00,
                discount: 0,
                finalPrice: 0.00,
                status: 'Inactive',
                picture: '',
                video: '',
                games: ''
            },
            {
                id: 3,
                name: 'Summer Gaming Sale',
                price: 49.99,
                discount: 20,
                finalPrice: 39.99,
                status: 'Active',
                picture: '',
                video: '',
                games: ''
            },
        ];

        // Populate Event Table
        function populateEventTable() {
            const tbody = document.getElementById('eventTableBody');
            tbody.innerHTML = ''; // Clear existing rows

            mockEvent.forEach((event) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${event.id}</td>
                    <td>${event.name}</td>
                    <td>$${event.price.toFixed(2)}</td>
                    <td>${event.discount}%</td>
                    <td>$${event.finalPrice.toFixed(2)}</td>
                    <td>${event.status}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="editEvent(${event.id})">Edit</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteEvent(${event.id})">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        // Add Event
        function addEvent() {
            const eventName = document.getElementById('eventName').value.trim();
            const eventPrice = parseFloat(document.getElementById('eventPrice').value.trim());
            const eventDiscount = parseFloat(document.getElementById('eventDiscount').value.trim());
            const eventStatus = document.getElementById('eventStatus').value;
            const eventPicture = document.getElementById('eventPicture').value.trim();
            const eventVideo = document.getElementById('eventVideo').value.trim();
            const eventGames = document.getElementById('eventGames').value.trim();

            if (!eventName || isNaN(eventPrice) || isNaN(eventDiscount) || eventDiscount < 0 || eventDiscount > 100 || !eventStatus) {
                alert('Please fill out all fields correctly!');
                return;
            }

            const finalPrice = eventPrice * (1 - eventDiscount / 100);

            const newEvent = {
                id: mockEvent.length > 0 ? mockEvent[mockEvent.length - 1].id + 1 : 1,
                name: eventName,
                price: eventPrice,
                discount: eventDiscount,
                finalPrice,
                status: eventStatus,
                picture: eventPicture,
                video: eventVideo,
                games: eventGames,
            };

            mockEvent.push(newEvent);
            populateEventTable();
            closeAddEventModal();
            alert('Event added successfully!');
        }

        // Edit Event
        function editEvent(id) {
            const event = mockEvent.find((e) => e.id === id);
            if (event) {
                const newName = prompt('Enter new event name:', event.name);
                const newPrice = prompt('Enter new event price:', event.price);
                const newDiscount = prompt('Enter new discount (%):', event.discount);
                const newStatus = prompt('Enter new status (Active/Inactive):', event.status);

                if (newName) event.name = newName;
                if (newPrice) event.price = parseFloat(newPrice);
                if (newDiscount) event.discount = parseFloat(newDiscount);
                if (newStatus) event.status = newStatus;

                event.finalPrice = event.price * (1 - event.discount / 100);

                alert(`Event "${event.name}" has been updated.`);
                populateEventTable();
            } else {
                alert('Event not found!');
            }
        }

        // Delete Event
        function deleteEvent(id) {
            const eventIndex = mockEvent.findIndex((e) => e.id === id);
            if (eventIndex !== -1) {
                const confirmDelete = confirm(`Are you sure you want to delete "${mockEvent[eventIndex].name}"?`);
                if (confirmDelete) {
                    mockEvent.splice(eventIndex, 1);
                    alert('Event has been deleted.');
                    populateEventTable();
                }
            } else {
                alert('Event not found!');
            }
        }

        // Modal Functions
        function openAddEventModal() {
            document.getElementById('addEventModal').style.display = 'block';
            document.getElementById('modalBackdrop').style.display = 'block';
        }

        function closeAddEventModal() {
            document.getElementById('addEventModal').style.display = 'none';
            document.getElementById('modalBackdrop').style.display = 'none';
        }

        // Initialize Table on Page Load
        document.addEventListener('DOMContentLoaded', populateEventTable);
    </script>
</body>