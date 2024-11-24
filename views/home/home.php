<?php include(__DIR__ . '/../templates/header.php'); ?>

<div class="container mt-5">
    <form action="index.php" method="get" class="position-relative">
        <input type="hidden" name="page" value="search" />
        <input
            type="text"
            name="q"
            id="searchBox"
            class="form-control"
            placeholder="Search for a game..."
            autocomplete="off" />
        <div id="dropdownResults" class="dropdown-results"></div>
    </form>
</div>

<script>
    const searchBox = document.getElementById('searchBox');
    const dropdownResults = document.getElementById('dropdownResults');

    searchBox.addEventListener('input', function () {
        const query = this.value.trim();
        if (!query) {
            dropdownResults.style.display = 'none';
            return;
        }
        fetch(`index.php?page=search&q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                dropdownResults.innerHTML = '';
                dropdownResults.style.display = 'block';
                if (data.length > 0) {
                    data.forEach(game => {
                        const resultItem = document.createElement('div');
                        resultItem.classList.add('result-item');
                        resultItem.innerHTML = `
                            <img src="${game.image}" alt="${game.name}" style="width: 50px; height: 50px; margin-right: 10px;">
                            <span>${game.name}</span>
                        `;
                        resultItem.addEventListener('click', () => {
                            window.location.href = `index.php?page=item&id=${game.id}`;
                        });
                        dropdownResults.appendChild(resultItem);
                    });
                } else {
                    dropdownResults.innerHTML = '<div class="result-item">No results found.</div>';
                }
            })
            .catch(error => console.error('Error fetching search results:', error));
    });
</script>

