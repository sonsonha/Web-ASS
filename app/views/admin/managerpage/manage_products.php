<div id="manageProducts" class="content-section">
    <h2 class="mt-10">Manage Products</h2>
    <button class="btn btn-success mb-3" onclick="openAddModal()">Add Game</button>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Release Date</th>
                <th>Discount</th>
                <th>Actions</th> <!-- Edit or delete button -->
            </tr>
        </thead>
        <tbody id="ProductTableBody">
            <!-- Rows will be dynamically populated here -->
        </tbody>
    </table>
</div>

<!-- Add Game Modal -->
<div id="addGameModal" class="modal-overlay">
    <div class="modal-content">
        <h3>ADD GAME</h3>
        <form id="addGameForm" class="modal-form">
            <div class="form-group">
                <label for="gameName">Game Name:</label>
                <input type="text" id="gameName" required>
            </div>
            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" id="publisher" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" required>
            </div>
            <div class="form-group">
                <label for="releaseDate">Release Date:</label>
                <input type="date" id="releaseDate" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description"></textarea>
            </div>
            <div class="form-group">
                <label for="introduction">Introduction:</label>
                <textarea id="introduction"></textarea>
            </div>
            <div class="form-group">
                <label for="avt">Avatar (URL):</label>
                <input type="text" id="avt">
            </div>
            <div class="form-group">
                <label for="background">Background (URL):</label>
                <input type="text" id="background">
            </div>
            <div class="form-group">
                <label for="downloadLink">Download Link:</label>
                <input type="text" id="downloadLink" required>
            </div>
            <div class="form-group">
                <label for="gamePrice">Price:</label>
                <input type="number" id="gamePrice" required>
            </div>
            <div class="form-group">
                <label for="discount">Discount (%):</label>
                <input type="number" id="discount" value="0" required>
            </div>
            <div class="form-group">
                <label for="recOS">Recommended OS:</label>
                <input type="text" id="recOS">
            </div>
            <div class="form-group">
                <label for="recProcessor">Recommended Processor:</label>
                <input type="text" id="recProcessor">
            </div>
        </form>
        <div class="modal-actions">
            <button class="btn btn-success" onclick="saveGame()">Save</button>
            <button class="btn btn-secondary" onclick="closeAddModal()">Cancel</button>
        </div>
    </div>
</div>

<style>
    /* Add Game Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        overflow: auto;
    }

    .modal-content {
        background-color: #282c34;
        border-radius: 10px;
        width: 60%;
        max-width: 800px;
        margin: 100px auto;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #ffffff;
    }

    .modal-content h3 {
        margin-bottom: 20px;
        text-align: center;
    }

    .modal-form {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .form-group {
        flex: 1 1 48%;
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #333;
        color: #fff;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
        max-height: 200px;
    }

    .modal-actions {
        margin-top: 20px;
        text-align: center;
    }

    .modal-actions .btn {
        margin: 0 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-actions .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .modal-actions .btn-success:hover {
        background-color: #218838;
    }

    .modal-actions .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .modal-actions .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<style>
    /* Add Game Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1000;
        overflow: auto;
    }

    .modal-content {
        background-color: #282c34;
        border-radius: 10px;
        width: 60%;
        max-width: 800px;
        margin: 100px auto;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        color: #ffffff;
    }

    .modal-content h3 {
        margin-bottom: 20px;
        text-align: center;
    }

    .modal-form {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .form-group {
        flex: 1 1 48%;
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background: #333;
        color: #fff;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
        max-height: 200px;
    }

    .modal-actions {
        margin-top: 20px;
        text-align: center;
    }

    .modal-actions .btn {
        margin: 0 10px;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-actions .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .modal-actions .btn-success:hover {
        background-color: #218838;
    }

    .modal-actions .btn-secondary {
        background-color: #6c757d;
        color: #fff;
    }

    .modal-actions .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<script>
    function openAddModal() {
        document.getElementById('addGameModal').style.display = 'block';
        document.getElementById('modalBackdrop').style.display = 'block';
        
        // Reset form fields
        document.getElementById('addGameForm').reset();
        editingProductId = null;
    }

    function closeAddModal() {
        document.getElementById('addGameModal').style.display = 'none';
        document.getElementById('modalBackdrop').style.display = 'none';
    }

    async function saveGame() {
        const gameData = {
            game_name: document.getElementById('gameName').value.trim(),
            publisher: document.getElementById('publisher').value.trim(),
            genre: document.getElementById('genre').value.trim(),
            release_date: document.getElementById('releaseDate').value.trim(),
            description: document.getElementById('description').value.trim(),
            avt: document.getElementById('avt').value.trim(),
            background: document.getElementById('background').value.trim(),
            introduction: document.getElementById('introduction').value.trim(),
            download_link: document.getElementById('downloadLink').value.trim(),
            price: parseFloat(document.getElementById('gamePrice').value.trim()),
            discount: parseFloat(document.getElementById('discount').value.trim()),
            recOS: document.getElementById('recOS').value.trim(),
            recProcessor: document.getElementById('recProcessor').value.trim(),
        };

        // Basic validation
        if (!gameData.game_name || !gameData.publisher || !gameData.genre || gameData.price <= 0 || gameData.discount < 0 || gameData.discount > 100 || !gameData.release_date || !gameData.download_link) {
            alert('Please fill all required fields with valid values!');
            return;
        }

        try {
            const response = await fetch('/../api/add_game.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(gameData)
            });

            const result = await response.json();
            if (result.status === 'success') {
                alert('Game added successfully!');
                closeAddModal();
                // Optionally refresh or update your products table
                // mockProducts.push(gameData); // If you want to see instant changes for mock
                // populateProductTable(mockProducts);
            } else {
                alert('Error adding game: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('There was an error while adding the game.');
        }
    }
</script>