<body>
    <div id="manageEvent" class="content-section">
        <h2 class="mt-10">Manage Article</h2>
        <button class="btn btn-success mb-3" onclick="openAddEventModal()">Add Article</button>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Article Name</th>
                    <th>Description</th>
                    <th>URL</th>
                </tr>
            </thead>
            <tbody id="eventTableBody">
                <!-- Rows will be dynamically populated here -->
            </tbody>
        </table>
    </div>

    <!-- Modal for Adding Article -->
    <div id="addEventModal">
        <h3 style="text-align: center;">Add Article</h3>
        <form id="addEventForm">
            <!-- Column 1 -->
            <div class="form-column">
                <label for="articleName">Article Name:</label>
                <input type="text" id="articleName" required>

                <label for="articleDescription">Description:</label>
                <textarea id="articleDescription" required></textarea>

                <label for="articleURL">Image URL:</label>
                <input type="url" id="articleURL" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn btn-success" onclick="saveArticle()">Save</button>
                <button type="button" class="btn btn-secondary" onclick="closeAddEventModal()">Cancel</button>
            </div>
        </form>
    </div>

    <div id="modalBackdrop"></div>

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

        .btn-success, .btn-primary, .btn-danger, .btn-secondary {
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

        input, select, textarea {
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
            padding: 10px;
        }

        .modal-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 10px;
        }

        .modal-buttons .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>

    <script>
        function openAddEventModal() {
            document.getElementById('addEventModal').style.display = 'block';
            document.getElementById('modalBackdrop').style.display = 'block';
            document.getElementById('addEventForm').reset(); // Reset form fields
        }

        function closeAddEventModal() {
            document.getElementById('addEventModal').style.display = 'none';
            document.getElementById('modalBackdrop').style.display = 'none';
        }

        async function saveArticle() {
            const articleData = {
                description: document.getElementById('articleDescription').value.trim(),
                image_url: document.getElementById('articleURL').value.trim(),
                title: document.getElementById('articleName').value.trim()
            };

            if (!articleData.description || !articleData.image_url || !articleData.title) {
                alert('Please fill out all required fields with valid data!');
                return;
            }

            try {
                const response = await fetch('/../api/add_article.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(articleData)
                });

                const result = await response.json();
                if (result.status === 'success') {
                    alert('Article added successfully!');
                    closeAddEventModal();
                    // Optionally refresh or update your articles table
                    // addRowToArticleTable(articleData); // You can implement a function to append rows dynamically
                } else {
                    alert('Error adding article: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('There was an error while adding the article.');
            }
        }

        // Optional: Implement a function to dynamically add a new row to the table
        function addRowToArticleTable(article) {
            const tbody = document.getElementById('eventTableBody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${article.id}</td>
                <td>${article.title}</td>
                <td>${article.description}</td>
                <td>${article.image_url}</td>
            `;
            tbody.appendChild(row);
        }
    </script>
</body>