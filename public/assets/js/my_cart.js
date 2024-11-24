document.addEventListener('DOMContentLoaded', async () => {
    const userId = 1; // Example user ID
    const cartContainer = document.getElementById('cart-items');
    const totalAmount = document.getElementById('total-amount');
    const toggleSelectAllButton = document.getElementById('toggle-select-all');
    const buyNowButton = document.getElementById('buy-now');
    const addCoinsButton = document.getElementById('add-coins');
    const userCoinsDisplay = document.getElementById('user-coins');

    let selectedGames = [];
    let cartItems = [];
    let userCoins = 0;

    await fetchUserProfile();
    await fetchCartItems();

    async function fetchUserProfile() {
        try {
            const response = await fetch('test_api/fetch_user_profile.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId }),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const userData = await response.json();
            if (userData.error) {
                alert(userData.error);
                return;
            }

            userCoins = userData.coins;
            userCoinsDisplay.textContent = userCoins.toFixed(2);
        } catch (error) {
            console.error('Error fetching user profile:', error);
        }
    }

    async function fetchCartItems() {
        try {
            const response = await fetch('test_api/fetch_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId }),
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            cartItems = await response.json();
            if (cartItems.error) {
                alert(cartItems.error);
                return;
            }

            renderCartItems(cartItems);
        } catch (error) {
            console.error('Error fetching cart:', error);
        }
    }

    function renderCartItems(items) {
        cartContainer.innerHTML = '';
        selectedGames = [];
        updateTotal();
    
        items.forEach((item) => {
            const cartItem = document.createElement('div');
            cartItem.className = 'row mb-4 align-items-center cart-item';
            cartItem.dataset.id = item.id;
            cartItem.dataset.price = item.price;
    
            cartItem.innerHTML = `
                <div class="col-md-1 text-center">
                    <input type="checkbox" class="select-item" data-id="${item.id}" data-price="${item.price}">
                </div>
                <div class="col-md-2">
                    <img src="${item.thumbnail}" class="img-fluid rounded game-image" alt="${item.title}" data-id="${item.id}">
                </div>
                <div class="col-md-6">
                    <h5 class="game-title" data-id="${item.id}">${item.title}</h5>
                </div>
                <div class="col-md-2">
                    <p class="text-success">$${item.price.toFixed(2)}</p>
                </div>
                <div class="col-md-1 text-center">
                    <button class="btn btn-danger btn-sm remove-item" data-id="${item.id}">Remove</button>
                </div>
            `;
    
            // Add event listener for clicking the image or title
            cartItem.querySelector('.game-image').addEventListener('click', (e) => {
                const gameId = e.target.dataset.id;
                window.location.href = `/app/views/games/detail.php?id=${gameId}`;
            });
    
            cartItem.querySelector('.game-title').addEventListener('click', (e) => {
                const gameId = e.target.dataset.id;
                window.location.href = `/app/views/games/detail.php?id=${gameId}`;
            });
    
            // Add event listener for toggling selection
            cartItem.addEventListener('click', (e) => {
                if (
                    e.target.tagName === 'INPUT' || 
                    e.target.classList.contains('remove-item') || 
                    e.target.classList.contains('game-image') || 
                    e.target.classList.contains('game-title')
                ) return;
    
                const checkbox = cartItem.querySelector('.select-item');
                checkbox.checked = !checkbox.checked;
    
                toggleSelection(checkbox);
            });
    
            // Add event listener for the checkbox itself
            cartItem.querySelector('.select-item').addEventListener('change', (e) => {
                toggleSelection(e.target);
            });
    
            // Add event listener for the remove button
            cartItem.querySelector('.remove-item').addEventListener('click', async (e) => {
                const gameId = parseInt(e.target.dataset.id);
                await removeItemFromCart(userId, gameId);
            });
    
            cartContainer.appendChild(cartItem);
        });
    }
    

    toggleSelectAllButton.addEventListener('click', () => {
        const checkboxes = document.querySelectorAll('.select-item');
        const allSelected = selectedGames.length === cartItems.length;

        if (allSelected) {
            selectedGames = [];
            checkboxes.forEach((checkbox) => (checkbox.checked = false));
            toggleSelectAllButton.textContent = 'Select All';
        } else {
            selectedGames = cartItems.map((item) => ({ id: item.id, price: item.price }));
            checkboxes.forEach((checkbox) => (checkbox.checked = true));
            toggleSelectAllButton.textContent = 'Deselect All';
        }

        updateTotal();
    });

    buyNowButton.addEventListener('click', () => {
        const total = selectedGames.reduce((sum, game) => sum + game.price, 0);
        if (userCoins < total) {
            alert('You do not have enough coins. Please add more coins.');
            addCoinsButton.classList.remove('d-none');
        } else {
            const newCoins = userCoins - total;
            const selectedGameIds = selectedGames.map((game) => game.id);

            fetch('test_api/confirm_purchase.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    user_id: userId,
                    new_coins: newCoins,
                    game_ids: selectedGameIds,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Purchase successful!');
                        userCoins = newCoins;
                        userCoinsDisplay.textContent = userCoins.toFixed(2);
                        location.reload();
                    } else {
                        alert('Purchase failed. Please try again.');
                    }
                })
                .catch((error) => console.error('Error confirming purchase:', error));
        }
    });

    addCoinsButton.addEventListener('click', () => {
        window.location.href = '/app/views/user/add_coins.php'; // Navigate to Add Coins page
    });

    function toggleSelection(checkbox) {
        const gameId = parseInt(checkbox.dataset.id);
        const gamePrice = parseFloat(checkbox.dataset.price);

        if (checkbox.checked) {
            selectedGames.push({ id: gameId, price: gamePrice });
        } else {
            selectedGames = selectedGames.filter((game) => game.id !== gameId);
        }

        updateTotal();
    }

    function updateTotal() {
        const total = selectedGames.reduce((sum, game) => sum + game.price, 0);
        totalAmount.textContent = `$${total.toFixed(2)}`;
        updateBuyNowState();
    }

    function updateBuyNowState() {
        const total = selectedGames.reduce((sum, game) => sum + game.price, 0);
        buyNowButton.disabled = total === 0; // Disable the Buy Now button if no games are selected
    }

    async function removeItemFromCart(userId, gameId) {
        try {
            const response = await fetch('test_api/remove_from_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId, game_id: gameId }),
            });

            const data = await response.json();

            if (response.ok && data.success) {
                alert('Item removed from the cart.');
                cartItems = cartItems.filter((item) => item.id !== gameId);
                renderCartItems(cartItems);
            } else {
                alert('Failed to remove item from the cart.');
            }
        } catch (error) {
            console.error('Error removing item from the cart:', error);
        }
    }
});
