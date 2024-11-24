<div id="manageProducts" class="content-section">
    <h2 class="mt-10">Manage Products</h2>
    <button class="btn btn-success mb-3" onclick="openAddModal()">Add Game</button>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Size</th>
                <th>Price</th>
                <th>Discount</th>
                <th>New Price</th>
                <th>Event</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ProductTableBody">
            <!-- Rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<!-- Modal for Adding/Editing -->
<div id="addGameModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: black; padding: 20px; border-radius: 10px; z-index: 1000; width: 90%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <h3 style="color: #fff; text-align: center;">Add/Edit Game</h3>
    <form id="addGameForm" style="display: flex; gap: 1%; color: #fff;">
        <!-- Column 1 -->
        <div style="flex: 1; border-right: 0.1px solid white; padding: 10px;">
            <label for="gameName">Game Name:</label>
            <input type="text" id="gameName" required>

            <label for="gameSize">Size (GB):</label>
            <input type="number" id="gameSize" required>

            <label for="gameContent">Content:</label>
            <textarea id="gameContent" required></textarea>

            <label for="isEvent">Event:</label>
            <input type="checkbox" id="isEvent">

        </div>

        <!-- Column 2 -->
        <div style="flex: 1; border-right: 0.1px solid white; padding: 10px;">
            <label for="gameImages">Images (Comma Separated URLs):</label>
            <input type="text" id="gameImages" required>

            <label for="gameVideo">Video URL:</label>
            <input type="text" id="gameVideo">

            <label for="downloadLink">Download Link:</label>
            <input type="text" id="downloadLink" required>
        </div>

        <!-- Column 3 -->
        <div style="flex: 1; padding: 10px;">
            <label for="gamePrice">Price:</label>
            <input type="number" id="gamePrice" required>

            <label for="discount">Discount (%):</label>
            <input type="number" id="discount" required>

            <div class="mt-3" style="display: flex; gap: 10px; justify-content: space-between;">
                <button type="button" class="btn btn-success" style="flex: 1;" onclick="saveGame()">Save</button>
                <button type="button" class="btn btn-secondary" style="flex: 1;" onclick="closeAddModal()">Cancel</button>
            </div>
        </div>
    </form>
</div>

<div id="modalBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999;"></div>

<style>
    #addGameModal {
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
        box-shadow: 0 0px 0px rgba(0, 0, 0, 0.2);
        border: 0.1px solid white;
        /* Thêm viền màu trắng */
    }

    #addGameModal label {
        display: block;
        margin-top: 10px;
        font-weight: bold;
    }

    #addGameModal input,
    #addGameModal textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #333;
        color: #fff;
    }

    #addGameModal textarea {
        resize: vertical;
        height: 80px;
    }

    #addGameModal button {
        margin-top: 10px;
    }


    #isEvent {
        margin: 0;
    }

    label {
        font-weight: bold;
    }

    #eventFields label {
        display: block;
        margin-top: 10px;
    }

    #eventFields input,
    #eventFields textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #333;
        color: #fff;
    }

    #eventFields textarea {
        resize: vertical;
        height: 80px;
    }
</style>


<script>
    // Mock Data for Games
    const mockProducts = [{
        id: 1,
        name: 'Game Console',
        size: 4.5,
        content: 'Great console game.',
        images: ['/assets/img/sample.jpg'],
        video: [],
        price: 299.99,
        discount: 10,
        newPrice: 269.99,
        isEvent: true,
        downloadLink: '/download/game-console',
    }, ];

    // Track if we are editing an existing product
    let editingProductId = null;

    // Function to Populate Table
    function populateProductTable(products) {
        const tbody = document.getElementById('ProductTableBody');
        tbody.innerHTML = ''; // Clear existing rows

        products.forEach((product) => {
            const row = document.createElement('tr');
            row.innerHTML = `
            <td>${product.id}</td>
            <td>${product.name}</td>
            <td>${product.size} GB</td>
            <td>${product.price.toFixed(2)} VND</td>
            <td>${product.discount} VND</td>
            <td>${product.newPrice.toFixed(2)} VND</td>
            <td>
                <input type="checkbox" class="event-checkbox" data-id="${product.id}" ${
            product.isEvent ? 'checked' : ''
        } onchange="toggleEvent(${product.id})">
            </td>
            <td>
                <button class="btn btn-primary btn-sm" onclick="editProduct(${product.id})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteProduct(${product.id})">Delete</button>
            </td>
        `;

            const descriptionRow = document.createElement('tr');
            descriptionRow.innerHTML = `
            <td colspan="8" style="text-align: left; font-style: italic; color: #ccc;">
                <strong>Description:</strong> ${product.content}
            </td>
        `;

            tbody.appendChild(row);
            tbody.appendChild(descriptionRow);
        });
    }

    // Function to Toggle Event Status
    function toggleEvent(id) {
        const product = mockProducts.find((r) => r.id === id);
        if (product) {
            product.isEvent = !product.isEvent; // Toggle the event state
            alert(`Event status for "${product.name}" updated to ${product.isEvent ? 'Active' : 'Inactive'}`);
            populateProductTable(mockProducts); // Refresh table
        }
    }

    // Function to Open Modal for Adding/Editing Game
    function openAddModal() {
        document.getElementById('addGameModal').style.display = 'block';
        document.getElementById('modalBackdrop').style.display = 'block';

        // Reset form fields
        document.getElementById('gameName').value = '';
        document.getElementById('gameSize').value = '';
        document.getElementById('gameContent').value = '';
        document.getElementById('gameImages').value = '';
        document.getElementById('gamePrice').value = '';
        document.getElementById('discount').value = '';
        document.getElementById('isEvent').checked = false;
        document.getElementById('downloadLink').value = '';
        editingProductId = null; // Reset editing ID
    }

    // Function to Close Modal
    function closeAddModal() {
        document.getElementById('addGameModal').style.display = 'none';
        document.getElementById('modalBackdrop').style.display = 'none';
    }

    // Function to Save Game
    function saveGame() {
        const gameName = document.getElementById('gameName').value.trim();
        const gameSize = parseFloat(document.getElementById('gameSize').value.trim());
        const gameContent = document.getElementById('gameContent').value.trim();
        const gameImages = document.getElementById('gameImages').value.trim().split(',');
        const gamePrice = parseFloat(document.getElementById('gamePrice').value.trim());
        const discount = parseFloat(document.getElementById('discount').value.trim());
        const isEvent = document.getElementById('isEvent').checked;
        const downloadLink = document.getElementById('downloadLink').value.trim();

        if (!gameName || gameSize <= 0 || gamePrice <= 0 || discount < 0 || discount > 100) {
            alert('Please enter valid inputs!');
            return;
        }

        const newPrice = gamePrice * (1 - discount / 100);

        if (editingProductId) {
            // Update existing product
            const product = mockProducts.find((p) => p.id === editingProductId);
            if (product) {
                product.name = gameName;
                product.size = gameSize;
                product.content = gameContent;
                product.images = gameImages;
                product.price = gamePrice;
                product.discount = discount;
                product.newPrice = newPrice;
                product.isEvent = isEvent;
                product.downloadLink = downloadLink;
            }
        } else {
            // Add new product
            const newGame = {
                id: mockProducts.length + 1,
                name: gameName,
                size: gameSize,
                content: gameContent,
                images: gameImages,
                price: gamePrice,
                discount,
                newPrice,
                isEvent,
                downloadLink,
            };
            mockProducts.push(newGame);
        }

        populateProductTable(mockProducts); // Update table
        closeAddModal();
        alert('Game saved successfully!');
    }

    // Function to Edit Game
    function editProduct(id) {
        const product = mockProducts.find((p) => p.id === id);
        if (product) {
            openAddModal();
            document.getElementById('gameName').value = product.name;
            document.getElementById('gameSize').value = product.size;
            document.getElementById('gameContent').value = product.content;
            document.getElementById('gameImages').value = product.images.join(',');
            document.getElementById('gamePrice').value = product.price;
            document.getElementById('discount').value = product.discount;
            document.getElementById('isEvent').checked = product.isEvent;
            document.getElementById('downloadLink').value = product.downloadLink;

            editingProductId = id; // Set editing ID
        }
    }

    // Function to Delete Product
    function deleteProduct(id) {
        const productIndex = mockProducts.findIndex((r) => r.id === id);
        if (productIndex !== -1) {
            const confirmDelete = confirm(`Are you sure you want to delete "${mockProducts[productIndex].name}"?`);
            if (confirmDelete) {
                mockProducts.splice(productIndex, 1); // Remove Product from mock data
                alert('Game has been deleted.');
                populateProductTable(mockProducts); // Refresh the table
            }
        } else {
            alert('Game not found!');
        }
    }

    // Initialize Table
    document.addEventListener('DOMContentLoaded', () => {
        populateProductTable(mockProducts);
    });
</script>